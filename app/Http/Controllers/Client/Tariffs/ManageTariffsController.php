<?php

namespace App\Http\Controllers\Client\Tariffs;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ManageTariffsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tariff-list|tariff-create|tariff-edit|tariff-show', ['only' => ['index','store']]);
        $this->middleware('permission:tariff-create', ['only' => ['create','store']]);
        $this->middleware('permission:tariff-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tariff-show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        // Request $request; 
        $tariffs = [];
        try {
            $tariffsData = Http::post('http://127.0.0.1:8000/api/tariffsByUtilityProvider', ["utility_provider_id" => Auth::user()->utility_provider_id])['Tariffs'];
            $tariffs = $tariffsData[0]['tariffs'];
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
            'percentageAmount' => 'required',
            "value" => 'required'
        ]);

        Log::info("Inputs::" . json_encode($request->all()));

        $inputs = [
            'name' => $request->input('name'),
            'percentageAmount' => $request->input('percentageAmount'),
            "value" => $request->input('value'),
            "utility_provider_id" => Auth::user()->utility_provider_id
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
    public function edit($tariffId)
    {
        $tariff = ['Something went wrong'];

        Log::info("Parameter::" . $tariffId);

        try {
            $tariff = Http::post('http://localhost:8000/api/tariffById', ['id' => $tariffId])['Tariff'];
        } catch (\Exception $e) {
            Log::info("Utility Provider Show Exception:" . $e->getMessage());
        }
        return view('tariffs.edit', compact('tariff'));
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
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'percentageAmount' => 'required',
            "value" => 'required'
        ]);

        $inputs = [
            'id' => $id,
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'percentageAmount' => $request->input('percentageAmount'),
            "value" => $request->input('value')
        ];

        Log::info("Inputs::" . json_encode($inputs));

        $successStatus = 'Failed to update tariff';

        try {
            $message = Http::patch('http://localhost:8000/api/tariff', $inputs)['message'];
            Log::info("Tariff response message::" . json_encode($message));
            if ($message[0] == 'OK') $successStatus = 'Successfully updated tariff!';
            else $successStatus = $message[0];
        } catch (\Exception $e) {
            Log::info("Tariff Update Exception:" . $e->getMessage());
        }

        return redirect()->route('tariffs.index')->with('success', $successStatus);
    }
}

