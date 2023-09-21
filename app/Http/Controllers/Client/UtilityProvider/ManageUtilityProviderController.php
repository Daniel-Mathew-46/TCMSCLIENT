<?php

namespace App\Http\Controllers\Client\UtilityProvider;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ManageUtilityProviderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

        $providers = [];

        try {

            $providers = Http::get('http://localhost:8000/api/utilityProviders')['providers'];
            Log::info("Providers Message::" . json_encode($providers));
        } catch (\Exception $e) {
            log::channel('daily')->info("UtilityProviderException:" . $e->getMessage());
        }

        return view('utility_provider.index', compact('providers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check for some provider categories
        $providerCategories = [];

        try {

            $providerCategories = Http::get('http://localhost:8000/api/listsProviderCategories')['providerCategories'];
            Log::info("Provider Categories::" . json_encode($providerCategories));
        } catch (\Exception $e) {
            Log::info("Provider Categories Exception:" . $e->getMessage());
        }
        return view('utility_provider.create', compact('providerCategories'));
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
            'provider_name' => 'required',
            'provider_code' => 'required',
            'provider_status' => 'required',
        ]);

        Log::info("Inputs::" . json_encode($request->all()));

        $inputs = $request->all();
        $successStatus = 'Failed to create utility service provider';

        try {
            $message = Http::post('http://localhost:8000/api/utilityProvider', $inputs);
            Log::info("Provider Categories::" . json_encode($message));
            $successStatus = 'Successfully created utility service provider!';
        } catch (\Exception $e) {
            Log::info("Provider Categories Exception:" . $e->getMessage());
        }

        return redirect()->route('utility_providers.index')->with('success', $successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::find($id);
        // return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $user = User::find($id);
        // $roles = Role::pluck('name', 'name')->all();
        // $userRole = $user->roles->pluck('name', 'name')->all();

        // return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,' . $id,
        //     'password' => 'same:confirm-password',
        //     'roles' => 'required'
        // ]);

        // $input = $request->all();
        // if (!empty($input['password'])) {
        //     $input['password'] = Hash::make($input['password']);
        // } else {
        //     $input = Arr::except($input, array('password'));
        // }

        // $user = User::find($id);
        // $user->update($input);
        // DB::table('model_has_roles')->where('model_id', $id)->delete(); //We delete previously assigned roles ready to save new roles updated.

        // $user->assignRole($request->input('roles'));

        // return redirect()->route('users.index')
        //     ->with('success', 'User updated successfully');
    }
}
