<?php

namespace App\Http\Controllers\Client\ProviderCategory;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ManageProviderCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:provcateg-list|provcateg-create|provcateg-edit|provcateg-show', ['only' => ['index','store']]);
        $this->middleware('permission:provcateg-create', ['only' => ['create','store']]);
        $this->middleware('permission:provcateg-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:provcateg-show', ['only' => ['show']]);
    }
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
            
        } catch (\Exception $e) {

            log::channel('daily')->info("ProviderCategories Client Exception:" . $e->getMessage());
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
        ]);

        $inputs = [
            'prov_categ_name' => $request->input('prov_categ_name'),
        ];

        $message = ['Failed to create provider category.'];

        try {
            $message = Http::post('http://localhost:8000/api/registerProviderCategory', $inputs)['message'];
        } catch (\Exception $e) {
            Log::info("Provider Category Register Exception:" . $e->getMessage());
        }
        if ($message[0] == 'OK') return redirect()->route('provider_categories.index')->with('success', 'Provider Category created successfully!');
        else return redirect()->route('provider_categories.index')->with('error', $message[0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $providerCategoryId)
    {

        $providerCategory = ['Something went wrong'];

        try {
            $providerCategory = Http::post('http://localhost:8000/api/listProviderCategory', ['providerCategoryId' => $providerCategoryId])['providerCategory'];
        } catch (\Exception $e) {
            Log::error("Provider Category Show Exception:" . $e->getMessage());
        }
        return view('provider_categories.show', compact('providerCategory'));
    }
}
