<?php

namespace App\Http\Controllers\Client\Debts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DebtController extends Controller
{
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

        Log::info("Inputs::" . json_encode($request->all()));

        $inputs = [
            'meters_id' => $request->input('meters_id'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'reductionRate' => $request->input('reductionRate')
        ];

        $successStatus = 'Failed to register customer!';

        try {
            $message = Http::post('http://127.0.0.1:8000/api/assignDebt', $inputs)['message'];
            Log::info("Debt Assign response message::" . json_encode($message));
            if ($message[0] == 'OK') $successStatus = 'Successfully assigned debt!';
            else $successStatus = $message[0];
        } catch (\Exception $e) {
            Log::info("Debt Assign Exception:" . $e->getMessage());
        }

        return redirect()->route('customers.index')->with('success', $successStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $customerId)
    {
        $customer = ['Something went wrong'];

        Log::info("Parameter::" . $customerId);

        try {

            $customer = Http::post('http://127.0.0.1:8000/api/customerById', ['customerId' => $customerId])['Customer'];
            $meters = $customer['meters'];
        } catch (\Exception $e) {
            Log::info("Customer Debt Show Exception:" . $e->getMessage());
        }
        return view('debts.edit', compact('customer', 'meters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
