<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Models\User;
use Exception;

class HomeController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->authorize('viewList', User::class);
            $data = $this->dashboardService->getStatistic();

            return view('admin.dashboard.index' , compact('data'));
        } catch (Exception $e) {
            return redirect()->route('company.index');
        }
    }
}
