<?php

namespace App\Http\Controllers\Client\Tariffs;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ManageTariffsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

        $tariffs = [];

        try {

            $tariffs = Http::post('http://localhost:8000/api/tariffs')['tariffs'];
            Log::info("Tarrifs Message::" . json_encode($tariffs));
        } catch (\Exception $e) {
            log::channel('daily')->info("Tariffs Exception:" . $e->getMessage());
        }

        return view('tariffs.index', compact('tariffs'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providerCategories = [];

        return view('tariffs.create');
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
            'code' => 'required',
            'percentageAmount' => 'required',
            "value" => 'required'
        ]);

        Log::info("Inputs::" . json_encode($request->all()));

        $inputs = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'percentageAmount' => $request->input('percentageAmount'),
            "value" => $request->input('value')
        ];

        $successStatus = 'Failed to create tariff';

        try {
            $message = Http::post('http://localhost:8000/api/tariff', $inputs)['message'];
            Log::info("Tariff response message::" . json_encode($message));
            if ($message[0] == 'OK') $successStatus = 'Successfully created tariff!';
            else $successStatus = $message[0];
        } catch (\Exception $e) {
            Log::info("Tariff Register Exception:" . $e->getMessage());
        }

        return redirect()->route('tariffs.index')->with('success', $successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $tariffId)
    {
        // $providerCode = $request->input('providerCode');

        $tariff = ['Something went wrong'];

        Log::info("Parameter::" . $tariffId);

        try {

            $tariff = Http::post('http://localhost:8000/api/tariffById', ['id' => $tariffId])['Tariff'];

            Log::info("Utility Provider response message::" . json_encode($tariff));
        } catch (\Exception $e) {
            Log::info("Utility Provider Show Exception:" . $e->getMessage());
        }
        return view('tariffs.show', compact('tariff'));
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

