<?php

namespace App\Http\Controllers;

use App\Charts\ExpensesChart;
use App\Charts\UsersChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ExpensesChart $expenceChart, UsersChart $usersChart)
    {
        //Call to fetch api's
        $userId = Auth::user()->id;
        $dashboardData = Http::post('http://127.0.0.1:8000/api/dashboardData')['Full Fetched data'];
        $user = Http::post('http://localhost:8000/api/user/show', ['userId' => $userId])['user'];
        $userRole = $user['roles'][0];
        $isAdmin = false;
        $chart = $expenceChart->build();
        // $chart = $usersChart->build();
        if ($userRole === "utility provider") {
            $dashboardDataUtilityProvider = [
                "customers" => $dashboardData['customersNo'],
                "customersList" => $dashboardData['customersList'],
                'numberOfTokens' => $dashboardData['numberOfTokens'],
                'totalDebtAmount' => $dashboardData['totalDebtAmount']
            ];
            return view('tailhome', compact('dashboardDataUtilityProvider', 'chart'));
        } else {
            $dashboardDataAdmin = [
                "providerCategory" => $dashboardData['providerCategoryNo'],
                "utilityProvider" => $dashboardData['utilityProviderNo'],
                "utilityProviderList" => $dashboardData['utilityProviderList'],
            ];
            return view('tailhome', compact('dashboardDataAdmin', 'chart'));
        }
    }
}
