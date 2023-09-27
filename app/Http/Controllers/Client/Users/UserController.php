<?php

namespace App\Http\Controllers\Client\Users;

use DB;
use App\Models\User;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = Http::post('http://localhost:8000/api/users')['users'];

        Log::info('Users Fetched: '.json_encode($data));

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
        //utility providers
        $providers = [];

        try {
            $providers = Http::post('http://localhost:8000/api/utilityProviders')['providers'];
            Log::info("Providers Message::" . json_encode($providers));
        } catch (\Exception $e) {
            log::channel('daily')->info("UtilityProviderException:" . $e->getMessage());
        }
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles', 'providers'));
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
            'password' => 'required|same:confirm-password',
            'utility_provider_id' => 'required',
            'roles' => 'required'
        ]);

        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);

        // $user = User::create($input);
        // $user->assignRole($request->input('roles'));
        Log::info("Inputs::" . json_encode($request->all()));

        $inputs = [
            'full_name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'utility_provider_id' => $request->input('utility_provider_id'),
            'roles' => $request->input('roles')
        ];

        $successStatus = 'Failed to create UP User!';

        try {
            $message = Http::post('http://localhost:8000/api/user/create', $request)['message'];
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
    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete(); //We delete previously assigned roles ready to save new roles updated.

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
