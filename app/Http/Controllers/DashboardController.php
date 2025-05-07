<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\LoadRevenueData;
use App\Services\DashboardService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;
    public function __construct()
    {
        $this->dashboardService = app(DashboardService::class);
    }

    public function index()
    {
        return view('pages.dashboard.index');
    }

    public function loadRevenueData(LoadRevenueData $request)
    {
        return $this->catchAPI(function () use ($request) {
            return response()->json(
                ['data' => $this->dashboardService->loadRevenueData($request->validated())],
                200
            );
        });
    }
}
