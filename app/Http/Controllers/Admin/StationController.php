<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StationService;
use App\Services\ProvincialService;
use App\Services\CompanyService;
use App\Services\UserService;
use App\Services\BusService;
use App\Services\RouteService;
use App\Services\BusRouteService;
use App\Services\ImageService;
use App\Services\TicketService;
use Exception;
use DB;
use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Requests\StationRequest;
use App\Models\Station;

class StationController extends Controller
{
    protected $stationService;
    protected $provincialService;
    protected $companyService;
    protected $busService;
    protected $routeService;
    protected $busBookingService;
    protected $userService;
    protected $imageService;
    protected $ticketService;

    public function __construct(
        StationService $stationService,
        ProvincialService $provincialService,
        CompanyService $companyService,
        BusService $busService,
        RouteService $routeService,
        BusRouteService $busRouteService,
        UserService $userService,
        ImageService $imageService,
        TicketService $ticketService
    ) {
        $this->stationService = $stationService;
        $this->provincialService = $provincialService;
        $this->companyService = $companyService;
        $this->busService = $busService;
        $this->routeService = $routeService;
        $this->busRouteService = $busRouteService;
        $this->userService = $userService;
        $this->imageService = $imageService;
        $this->ticketService = $ticketService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $this->authorize('viewList', Station::class);
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
                'keyword',
                'provincial_id',
                'status',
            ]);
            $stations = $this->stationService->search($params);
            $statuses = $this->stationService->getListStatuses();

            return view('admin.station.index', compact('stations', 'statuses'));
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
            $this->authorize('viewList', Station::class);
            $provincials = $this->provincialService->getAll();
            $statuses = $this->stationService->getListStatuses();
            unset($statuses[0]);

            return view('admin.station.create', compact('provincials', 'statuses'));
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
    public function store(StationRequest $request)
    {
        try {
            $this->authorize('viewList', Station::class);
            $data = $request->only([
                'provincial_id',
                'name',
                'address',
                'phone',
                'status',
            ]);

            $address = urlencode($request->get('address'));
            $client = new Client();
            $result = (string) $client->post("https://maps.googleapis.com/maps/api/geocode/json?address=$address,+CA&key=AIzaSyBXTnVjJyaI2nsAVV9pBpW2pF5YfQn76JY")->getBody();
            $json = json_decode($result);
            $data['latitude'] = !empty($json->results) ? $json->results[0]->geometry->location->lat : 0;
            $data['longitude'] = !empty($json->results) ? $json->results[0]->geometry->location->lng : 0;
            DB::beginTransaction();

            $station = $this->stationService->createStation($data);

            if ($request->hasFile('images')) {
                $this->imageService->createImage($station, $request->images);
            }

            DB::commit();
            
            return redirect()->route('station.show', ['id' => $station->id])->with('messageSuccess', trans('message.create_successfully'));
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
            $this->authorize('viewList', Station::class);
            $station = $this->stationService->getStation($id);
            $provincials = $this->provincialService->getAll();
            $statuses = $this->stationService->getListStatuses();
            unset($statuses[0]);

            return view('admin.station.show', compact('station', 'provincials', 'statuses'));
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
    public function update(StationRequest $request, $id)
    {
        try {
            $this->authorize('viewList', Station::class);
            $data = $request->only([
                'station_id',
                'name',
                'address',
                'phone',
                'status',
                'old_image',
            ]);
            $data['old_image'] = json_decode($data['old_image']);
            DB::beginTransaction();
            $station = $this->stationService->updateStation($id, $data);

            if ($data['old_image']) {
                $this->imageService->deleteImageExcept($station, $data['old_image']);
            }

            if ($request->hasFile('images')) {
                $this->imageService->createImage($station, $request->images);
            }
            DB::commit();
            
            return redirect()->route('station.show', ['id' => $station->id])->with('messageSuccess', trans('message.update_successfully'));
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
            $this->authorize('viewList', Station::class);
            $data = json_decode($request->data);
            DB::beginTransaction();

            foreach ($data as $item) {
                $station = $this->stationService->getStation($item->id);
                $this->stationService->updateMultyStatus($item->id, $item->status);
                $companyIds = $station->companies->pluck('id')->all();
                $this->companyService->updateMultyStatus($companyIds, $item->status);
                $routeIds = $this->routeService->whereInService('company_id', $companyIds)->pluck('id')->all();
                $routeIdsByStation = $this->routeService->getAllRouteByStationId($item->id)->pluck('id')->all();
                $routeIds = array_merge($routeIds, $routeIdsByStation);
                $busIds = $this->busService->whereInService('company_id', $companyIds)->pluck('id')->all();
                $this->busService->updateMultyStatus($busIds, $item->status);
                $this->routeService->updateMultyStatus($routeIds, $item->status);
                $busRouteIds = $this->busRouteService->whereInService('route_id', $routeIds)->pluck('id')->all();
                $this->busRouteService->updateMultyStatus($busRouteIds, $item->status);
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
            $this->authorize('viewList', Station::class);
            $dataId = json_decode($request->data);
            DB::beginTransaction();
            $this->stationService->deleteMulty($dataId);
            $companyIds = $this->companyService->whereInService('station_id', $dataId)->pluck('id')->all();
            $this->companyService->deleteMulty($companyIds);
            $busIds = $this->busService->whereInService('company_id', $companyIds)->pluck('id')->all();
            $this->busService->deleteMulty($busIds);
            $routeIds = $this->routeService->whereInService('company_id', $companyIds)->pluck('id')->all();
            $routeIdsByStation = $this->routeService->getAllRouteByStationId($dataId)->pluck('id')->all();
            $routeIds = array_merge($routeIds, $routeIdsByStation);
            $this->routeService->deleteMulty($routeIds);
            $busRouteIds = $this->busRouteService->whereInService('route_id', $routeIds)->pluck('id')->all();
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
