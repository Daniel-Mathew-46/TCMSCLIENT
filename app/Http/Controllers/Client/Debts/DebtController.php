<?php

namespace App\Http\Controllers\Client\Debts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DebtController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer-assigndebt', ['only' => ['show','store', 'edit']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'meters_id' => 'required',
            'description' => 'required|string',
            'amount' => 'required|int',
            'reductionRate' => 'required|int'
        ]);

        $inputs = [
            'meters_id' => $request->input('meters_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'reductionRate' => $request->input('reductionRate')
        ];

        $successStatus = 'Failed to assign debts.';

        try {
            $debtResponse = Http::post('http://127.0.0.1:8000/api/assigndebt', $inputs);
            //['message'];
            $debtsArray = json_decode($debtResponse, true);

            if (array_key_exists('message', $debtsArray)){
                $successStatus = $debtResponse['message'][0];
            } else {
                $successStatus = 'Successfully assigned debt.';
            }
        } catch (\Exception $e) {
            Log::error("Debt Assign Exception:" . $e->getMessage());
        }

        return redirect()->route('customers.index')->with('success', $successStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $meterId)
    {
        $successStatus = 'Failed to fetch debts!';

        $debts = [];

        try {
            $debts = Http::post('http://127.0.0.1:8000/api/meterdebt', ['meterId' => $meterId])['debt'];
            Log::info("Debt fetch response::" . json_encode($debts));
        } catch (\Exception $e) {
            Log::error("Debt fetch Exception:" . $e->getMessage());
        }

        return view('debts.index', compact('debts'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function edit(string $customerId)
    {
        $customer = ['Something went wrong'];

        Log::info("Parameter::" . $customerId);

        try {

            $customer = Http::post('http://127.0.0.1:8000/api/customerById', ['customerId' => $customerId])['Customer'];
            $meters = $customer['meters'];
        } catch (\Exception $e) {
            Log::error("Customer Debt Show Exception:" . $e->getMessage());
        }
        return view('debts.edit', compact('customer', 'meters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $customerId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
