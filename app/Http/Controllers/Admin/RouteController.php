<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RouteService;
use App\Services\BusRouteService;
use App\Services\TicketService;
use Exception;
use DB;

class RouteController extends Controller
{
    protected $routeService;
    protected $busRouteService;
    protected $ticketService;

    public function __construct(
        RouteService $routeService,
        BusRouteService $busRouteService,
        TicketService $ticketService
    ) {
        $this->routeService = $routeService;
        $this->busRouteService = $busRouteService;
        $this->ticketService = $ticketService;
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
                'company_id',
                'status',
            ]);
            $routes = $this->routeService->search($params);
            $statuses = $this->routeService->getListStatuses();

            return view('admin.route.index', compact('routes', 'statuses'));
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
        //
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
        //
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
                $route = $this->routeService->getRoute($item->id);
                $this->routeService->updateMultyStatus($item->id, $item->status);
                $this->busRouteService->updateMultyStatus($route->busRoutes->pluck('id'), $item->status);
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
