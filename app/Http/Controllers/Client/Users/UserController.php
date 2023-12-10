<?php

namespace App\Http\Controllers\Client\Users;

use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-show', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = Http::post('http://localhost:8000/api/users')['users'];

        return view('users.index', compact('data'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $utility_providers = [];
        try {
            $utility_providers = Http::post('http://127.0.0.1:8000/api/utilityProvidersWithNoUsers')['providers'];
        } catch (\Exception $e) {
            Log::error("UP User Create Exception:" . $e->getMessage());
        }
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles', 'utility_providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:10|max:11',
            'password' => 'required|same:confirm-password',
            'confirm-password' => 'required',
            'roles' => 'required'
        ]);

        if ($request->input('roles') == 'utility provider')
            $this->validate($request, ['utility_provider' => 'required']);

        $inputs = [
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'password' => Hash::make($request->input('password')),
            'utility_provider_id' => $request->input('utility_provider'),
            'roles' => [$request->input('roles')]
        ];

        $message = ['Failed to create UP User!'];

        try {
            $message = Http::post('http://localhost:8000/api/user/create', $inputs)['message'];
        } catch (\Exception $e) {
            Log::error("UP User Create Exception:" . $e->getMessage());
        }
        if ($message[0] == 'OK') return redirect()->route('users.index')->with('success', 'User created successfully!');
        else return redirect()->route('users.index')->with('error', $message[0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId): View
    {
        $user = ['Something went wrong'];

        try {
            $user = Http::post('http://localhost:8000/api/user/show', ['userId' => $userId])['user'];
            if (is_null($user)) {
                $user = ['Something went wrong'];
            }
        } catch (\Exception $e) {
            Log::error("User Show Exception:" . $e->getMessage());
        }
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($userId): View
    {
        $user = [];
        $utility_providers = [];
        try {
            $user = Http::post('http://localhost:8000/api/user/show', ['userId' => $userId])['user'];
            $utility_providers = Http::post('http://127.0.0.1:8000/api/utilityProvidersWithNoUsers')['providers'];
        } catch (\Exception $e) {
            Log::error("User Show Exception:" . $e->getMessage());
        }

        $roles = Role::pluck('name', 'name')->all();

        $userRole = isset($user['roles']) ? $user['roles'] : null;

        $userUtilityProviderId = $user['utility_provider_id'] !== null ? $user['utility_provider_id'] : "";

        $userUtilityProvider = $user['utility_provider'] !== "None" ? [$user['utility_provider']] : null;

        $pluckedArray = [];
        if (count($utility_providers) > 0 && $userUtilityProviderId && $userUtilityProvider[0]) {
            foreach ($utility_providers as $item) {
                $pluckedArray[$item['id']] = $item['provider_name'];
            }
            $pluckedArray[$userUtilityProviderId] = $userUtilityProvider[0];
            $utility_providers =$pluckedArray;
        } else {
            $utility_providers =collect($utility_providers)->pluck('provider_name', 'id');
        }

        if (!blank($user)) return view('users.edit', compact('user', 'roles', 'userRole', 'utility_providers', 'userUtilityProvider'));

        return view('users.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId): RedirectResponse
    {
        // $userId = $request->input('userId');
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone_number' => 'required|min:10|max:11',
            'roles' => 'required'
        ]);

        if (!empty($request->input('password'))) {
            $this->validate($request, [
                'password' => 'same:confirm-password',
                'confirm-password' => 'required',
            ]);
        }

        if ($request->input('roles') === 'utility provider'){
            $this->validate($request, [
                'utility_provider' => 'required',
            ]);
        }

        $inputs = [
            'id' => intval($userId),
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'password' => $request->input('password'),
            'utility_provider_id' => $request->input('roles') !== 'Admin' ? $request->input('utility_provider') : null,
            'roles' =>  $request->input('roles'),
        ];

        if (!empty($inputs['password'])) {
            $inputs['password'] = Hash::make($inputs['password']);
        } else {
            $inputs = Arr::except($inputs, array('password'));
        }


        $message = ['Failed to update UP User!'];

        try {
            $message = Http::post('http://localhost:8000/api/user/update', $inputs)['message'];
        } catch (\Exception $e) {
            Log::error("UP User Update Exception:" . $e->getMessage());
        }

        if ($message[0] == 'OK') return redirect()->route('users.index')->with('success', 'User updated successfully!');
        else return redirect()->route('users.index')->with('error', $message[0]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'same:password_confirm',
            'password_confirm' => 'required',
        ]);

        $inputs = [
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ];

        $message = ['Failed to update password'];

        try {
            $message = Http::patch('http://localhost:8000/api/user/updatepassword', $inputs)['message'];
        }catch (\Exception $e) {
            Log::error("password Update Exception:" . $e->getMessage());
        }


        if ($message[0] == 'OK')  return redirect('/login')->with('success', 'Password reset successfully. Please log in.');
        else return redirect()->route('/login')->with('error', 'Password reset Failed');
    }
}
