<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use App\Services\StationService;
use App\Services\BusService;
use App\Services\RouteService;
use App\Services\BusRouteService;
use Exception;
use DB;

class CompanyController extends Controller
{
    protected $companyService;
    protected $stationService;
    protected $busService;
    protected $routeService;
    protected $busBookingService;

    /**
     * CompanyController constructor.
     * @param CompanyService $companyService
     * @param RatingService $ratingService
     */
    public function __construct(
        CompanyService $companyService,
        StationService $stationService,
        BusService $busService,
        RouteService $routeService,
        BusRouteService $busRouteService
    ) {
        $this->companyService = $companyService;
        $this->stationService = $stationService;
        $this->busService = $busService;
        $this->routeService = $routeService;
        $this->busRouteService = $busRouteService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
                'keyword',
                'station_id',
                'status',
            ]);
            $statuses = $this->companyService->getListStatuses();
            $companies = $this->companyService->search($params);

            return view('admin.company.index', compact('companies', 'statuses'));
        } catch (Exception $e) {
            dd($e);
            report($e);
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $statuses = $this->companyService->getListStatuses();
            $stations = $this->stationService->getAll();
            unset($stations[0]);
            
            return view('admin.company.create', compact('statuses',
                'stations'
            ));;
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $company = $this->companyService->getCompany($id);
            $statuses = $this->companyService->getListStatuses();
            $stations = $this->stationService->getAll();
            unset($stations[0]);

            return view('admin.company.show', compact('company',
                'statuses',
                'stations'
            ));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateMultyStatus(Request $request)
    {
        try {
            $data = json_decode($request->data);
            DB::beginTransaction();

            foreach ($data as $item) {
                $company = $this->companyService->getCompany($item->id);
                $this->companyService->updateMultyStatus($item->id, $item->status);
                $this->busService->updateMultyStatus($company->buses->pluck('id')->all(), $item->status);
                $this->routeService->updateMultyStatus($company->routes->pluck('id')->all(), $item->status);
                $busRouteId = $this->busRouteService->whereInService('id', $company->buses->pluck('id')->all())->pluck('id')->all();
                $this->busRouteService->updateMultyStatus($busRouteId, $item->status);
            }
            
            DB::commit();

            return back()->with('messageSuccess', trans('message.change_status_success'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return back()->with('messageError', trans('message.change_status_fail'));
        }
    }

    public function deleteMulty(Request $request)
    {
        try {
            $dataId = json_decode($request->data);
            DB::beginTransaction();

            $this->companyService->deleteMulty($dataId);
            $busesID = $this->busService->whereInService('company_id', $dataId)->pluck('id')->all();
            $this->busService->deleteMulty($busesID);
            $routeID = $this->routeService->whereInService('company_id', $dataId)->pluck('id')->all();
            $this->routeService->deleteMulty($routeID);
            $busRouteId = $this->busRouteService->whereInService('bus_id', $busesID)->pluck('id')->all();
            $this->busRouteService->deleteMulty($busRouteId);
            
            DB::commit();

            return back()->with('messageSuccess', trans('message.delete_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return back()->with('messageError', trans('message.delete_fail'));
        }
    }
}
