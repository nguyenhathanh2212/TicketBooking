<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RouteService;
use App\Services\BusRouteService;
use App\Services\TicketService;
use App\Services\CompanyService;
use App\Services\StationService;
use App\Models\Route;
use Exception;
use DB;
use App\Http\Requests\RouteRequest;

class RouteController extends Controller
{
    protected $routeService;
    protected $busRouteService;
    protected $ticketService;
    protected $companyService;
    protected $stationService;

    public function __construct(
        RouteService $routeService,
        BusRouteService $busRouteService,
        TicketService $ticketService,
        CompanyService $companyService,
        StationService $stationService
    ) {
        $this->routeService = $routeService;
        $this->busRouteService = $busRouteService;
        $this->ticketService = $ticketService;
        $this->companyService = $companyService;
        $this->stationService = $stationService;
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
                'company_id',
                'status',
            ]);

            if (!empty($params['company_id'])) {
                $company = $this->companyService->getCompany($params['company_id']);
                $this->authorize('view', $company);
            } else {
                $this->authorize('view-all-routes');
            }

            $listCompanies = $this->companyService->getAll()->pluck('name', 'id')->all();
            $listCompanies = [0 => trans('main.companies')] + $listCompanies;
            $routes = $this->routeService->search($params);
            $statuses = $this->routeService->getListStatuses();

            return view('admin.route.index', compact('routes', 'statuses', 'listCompanies'));
        } catch (Exception $e) {
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
            $this->authorize('create', Route::class);
            $stations = $this->stationService->getAll();
            $statuses = $this->stationService->getListStatuses();
            $companies = $this->companyService->getAll();
            unset($statuses[0]);

            return view('admin.route.create', compact('stations', 'statuses', 'companies'));
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
    public function store(RouteRequest $request)
    {
        try {
            $this->authorize('create', Route::class);
            $data = $request->only([
                'company_id',
                'start_station_id',
                'destination_station_id',
                'start_time',
                'destination_time',
                'number_preset_date',
                'phone',
                'reservation',
                'status',
                'direct_payment'
            ]);
            DB::beginTransaction();

            $route = $this->routeService->createRoute($data);

            DB::commit();
            
            return redirect()->route('route.show', ['id' => $route->id])->with('messageSuccess', trans('message.create_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return back()->with('messageError', trans('message.create_fail'));
        }
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
            $route = $this->routeService->getRoute($id);
            $this->authorize('view', $route);
            $companies = $this->companyService->getAll();
            $statuses = $this->routeService->getListStatuses();
            $stations = $this->stationService->getAll();
            $buses = $route->company->buses->pluck('lisense_plate', 'id')->all();
            unset($statuses[0]);

            return view('admin.route.show', compact('route',
                'stations',
                'companies',
                'statuses',
                'buses'
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
    public function update(RouteRequest $request, $id)
    {
        try {
            $data = $request->only([
                'company_id',
                'start_station_id',
                'destination_station_id',
                'start_time',
                'destination_time',
                'number_preset_date',
                'phone',
                'reservation',
                'status',
                'direct_payment'
            ]);
            
            $this->authorize('update', $this->routeService->getRoute($id));
            DB::beginTransaction();
            $route = $this->routeService->updateRoute($id, $data);
            DB::commit();
            
            return redirect()->route('route.show', ['id' => $route->id])->with('messageSuccess', trans('message.update_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return back()->with('messageError', trans('message.update_fail'));
        }
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
                $route = $this->routeService->getRoute($item->id);
                $this->authorize('update', $route);
                $this->routeService->updateMultyStatus($item->id, $item->status);
                $this->busRouteService->updateMultyStatus($route->busRoutes->pluck('id')->all(), $item->status);
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
            $this->routeService->deleteMulty($dataId);
            $busRouteIds = $this->busRouteService->whereInService('route_id', $dataId)->pluck('id')->all();
            $this->busRouteService->deleteMulty($busRouteIds);
            $ticketIds = $this->ticketService->whereInService('bus_route_id', $busRouteIds)->pluck('id')->all();
            $this->ticketService->deleteMulty($ticketIds);
            DB::commit();

            return back()->with('messageSuccess', trans('message.delete_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return back()->with('messageError', trans('message.delete_fail'));
        }
    }
}
