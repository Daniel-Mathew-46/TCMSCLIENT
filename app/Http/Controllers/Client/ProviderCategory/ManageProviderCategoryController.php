<?php

namespace App\Http\Controllers\Client\ProviderCategory;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ManageProviderCategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {

        $provider_categories = [];

        try {

            $provider_categories = Http::post('http://localhost:8000/api/listProviderCategories')['providerCategories'];
            Log::info("Provider Categories Message::" . json_encode($provider_categories));
        } catch (\Exception $e) {
            log::channel('daily')->info("UtilityProviderException:" . $e->getMessage());
        }

        return view('provider_categories.index', compact('provider_categories'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider_categories.create');
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
            'prov_categ_name' => 'required',
            'prov_categ_code' => 'required',
        ]);

        Log::info("Inputs::" . json_encode($request->all()));

        $inputs = [
            'prov_categ_name' => $request->input('prov_categ_name'),
            'prov_categ_code' => $request->input('prov_categ_code'),
        ];

        $successStatus = 'Failed to create provider category';

        try {
            $message = Http::post('http://localhost:8000/api/registerProviderCategory', $inputs)['message'];
            Log::info("Utility Provider response message::" . json_encode($message));
            if ($message[0] == 'OK') $successStatus = 'Successfully created provider category!';
            else $successStatus = $message[0];
        } catch (\Exception $e) {
            Log::info("Provider Category Register Exception:" . $e->getMessage());
        }

        return redirect()->route('provider_categories.index')->with('success', $successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $providerCategoryId)
    {
        // $providerCode = $request->input('providerCode');

        $providerCategory = ['Something went wrong'];

        Log::info("Parameter::" . $providerCategoryId);

        try {

            $providerCategory = Http::post('http://localhost:8000/api/listProviderCategory', ['providerCategoryId' => $providerCategoryId])['providerCategory'];

            Log::info("Provider Category response message::" . json_encode($providerCategory));
        } catch (\Exception $e) {
            Log::info("Provider Category Show Exception:" . $e->getMessage());
        }
        return view('provider_categories.show', compact('providerCategory'));
    }
}
