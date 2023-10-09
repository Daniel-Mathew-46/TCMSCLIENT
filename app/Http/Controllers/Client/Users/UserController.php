<?php

namespace App\Http\Controllers\Client\Users;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $this->middleware('permission:user-list|user-create|user-edit|user-show', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
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
            ->with('i', ($request->input('page', 1) - 1) * 5);
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
            Log::info("providers fetch for users".json_encode($utility_providers));
        } catch (\Exception $e) {
            Log::info("UP User Create Exception:" . $e->getMessage());
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:10|max:11',
            'password' => 'required|same:confirm-password',
            'confirm-password' => 'required',
            'role' => 'required'
        ]);

        if ($request->input('role') == 'utility provider')
            $this->validate($request, ['utility_provider_id' => 'required']);

        $inputs = [
            'full_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'password' => Hash::make($request->input('password')),
            'utility_provider_id' => $request->input('utility_provider_id'),
            'roles' => [$request->input('role')]
        ];

        Log::info("Inputs::" . json_encode($inputs));

        $successStatus = 'Failed to create UP User!';

        try {
            $message = Http::post('http://localhost:8000/api/user/create', $inputs)['message'];
            Log::info("User response message::" . json_encode($message));
            if ($message[0] == 'OK') $successStatus = 'User created successfully!';
            else $successStatus = $message[0];
        } catch (\Exception $e) {
            Log::info("UP User Create Exception:" . $e->getMessage());
        }

        return redirect()->route('users.index')->with('success', $successStatus);
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

        Log::info("Parameter::" . $userId);

        try {
            $user = Http::post('http://localhost:8000/api/user/show', ['userId' => $userId])['user'];
            if(is_null($user)){
                $user = ['Something went wrong'];
            }

        } catch (\Exception $e) {
            Log::info("User Show Exception:" . $e->getMessage());
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

        if(!blank($user)) return view('users.edit', compact('user', 'roles', 'userRole'));

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
        $this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId,
            'phone_number' => 'required|min:10|max:11',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $inputs = [
            'id' => intval($userId),
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'password' => $request->input('password'),
            'roles' => $request->input('roles')
        ];

        if (!empty($inputs['password'])) {
            $inputs['password'] = Hash::make($inputs['password']);
        } else {
            $inputs = Arr::except($inputs, array('password'));
        }
        
        $successStatus = 'Failed to update UP User!';

        try {
            $message = Http::post('http://localhost:8000/api/user/update', $inputs)['message'];
            Log::info("User Update response message::" . json_encode($message));
            if ($message[0] == 'OK') $successStatus = 'User updated successfully!';
            else $successStatus = $message[0];
        } catch (\Exception $e) {
            Log::info("UP User Update Exception:" . $e->getMessage());
        }

        return redirect()->route('users.index')->with('success', $successStatus);
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
}
