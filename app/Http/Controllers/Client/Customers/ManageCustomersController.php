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
        $customers = [[
            "id" => 1,
            "utilityProvider" => "Tanesco",
            "name" => "Daniel Mathew",
            "mobile" => "0755664536",
            "address" => "Dodoma",
            "meterNumber" => 11899486758
        ],
        [
            "id" => 2,
            "utilityProvider" => "Tanesco",
            "name" => "John Mocco",
            "mobile" => "0755443536",
            "address" => "Dodoma",
            "meterNumber" => 118553016758
        ],
        [
            "id" => 3,
            "utilityProvider" => "Duwasa",
            "name" => "Anne Marie",
            "mobile" => "0755443536",
            "address" => "Arusha",
            "meterNumber" => 110043016758
        ]];
        return view('customer.index', compact('customers'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Create a resource to storage.
     */
    public function create()
    {
        $providers = [];

        try {
            $providers = Http::post('http://localhost:8000/api/utilityProviders'  )['providers'];
            Log::info("Providers Message::" . json_encode($providers));
        } catch (\Exception $e) {
            log::channel('daily')->info("UtilityProviderException:" . $e->getMessage());
        }
        return view('customer.register', compact('providers'));
    }

    /**
     * Create a payment resource in storage.
     */
    public function create_payment(Request $request)
    {
        return view('customer.payment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRegisterRequest $request)
    {
        // $request->validate();
        $successStatus = "Successfully registered!";
        return redirect()->route('customers.index')->with('success', $successStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = [
            "id" => 1,
            "utilityProvider" => "Tanesco",
            "name" => "Daniel Mathew",
            "mobile" => "0755664536",
            "address" => "Dodoma",
            "meterNumber" => 11899486758
        ];
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
