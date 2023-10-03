<?php

namespace App\Http\Controllers\Client\Customers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use Illuminate\Support\Facades\Http;

class ManageCustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = [];

        try {
            $customers = Http::post('http://localhost:8000/api/customers'  )['customers'];
            Log::info("Customers Message::" . json_encode($customers));
        } catch (\Exception $e) {
            log::channel('daily')->info("CustomerException:" . $e->getMessage());
        }
        
        return view('customer.index', compact('customers'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Create a resource to storage.
     */
    public function create()
    {
        return view('customer.register');
    }

    /**
     * Create a payment resource in storage.
     */
    public function create_payment($customerId)
    {
        return view('customer.payment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'phone' => 'required|min:10|max:11',
            'address' => 'required'
        ]);

        Log::info("Inputs::" . json_encode($request->all()));

        $inputs = [
            'full_name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ];

        $successStatus = 'Failed to register customer!';

        try {
            $message = Http::post('http://127.0.0.1:8000/api/customer/create', $inputs)['message'];
            Log::info("Customer Register response message::" . json_encode($message));
            if ($message[0] == 'OK') $successStatus = 'Successfully registered customer!';
            else $successStatus = $message[0];
        } catch (\Exception $e) {
            Log::info("Customer Register Exception:" . $e->getMessage());
        }

        return redirect()->route('customers.index')->with('success', $successStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show($customerId)
    {
        $customer = ['Something went wrong'];

        Log::info("Parameter::" . $customerId);

        try {

            $customer = Http::post('http://127.0.0.1:8000/api/customerById', ['customerId' => $customerId])['Customer'];

        } catch (\Exception $e) {

            Log::info("Customer Show Exception:" . $e->getMessage());
        }
        return view('customer.show', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
