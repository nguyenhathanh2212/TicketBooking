<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use App\Services\StationService;
use App\Services\UserService;
use App\Services\BusService;
use App\Services\RouteService;
use App\Services\BusRouteService;
use App\Services\ImageService;
use App\Services\TicketService;
use Exception;
use DB;
use Auth;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    protected $companyService;
    protected $stationService;
    protected $busService;
    protected $routeService;
    protected $busBookingService;
    protected $userService;
    protected $imageService;
    protected $ticketService;

    public function __construct(
        CompanyService $companyService,
        StationService $stationService,
        BusService $busService,
        RouteService $routeService,
        BusRouteService $busRouteService,
        UserService $userService,
        ImageService $imageService,
        TicketService $ticketService
    ) {
        $this->companyService = $companyService;
        $this->stationService = $stationService;
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

            if (Auth::user()->cannot('viewList', Company::class)) {
                $params['user_id'] = Auth::user()->id;
            }

            $statuses = $this->companyService->getListStatuses();
            $companies = $this->companyService->search($params);

            return view('admin.company.index', compact('companies', 'statuses'));
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
            $statuses = $this->companyService->getListStatuses();
            $stations = $this->stationService->getAll();
            unset($statuses[0]);
            
            return view('admin.company.create', compact('statuses',
                'stations'
            ));
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
    public function store(CompanyRequest $request)
    {
        try {
            $data = $request->only([
                'station_id',
                'name',
                'address',
                'phone',
                'status',
                'description',
                'super_manager',
                'employee'
            ]);
            $data['employee'] = json_decode($data['employee']);
            DB::beginTransaction();
            $company = $this->companyService->createCompany($data);

            if ($request->hasFile('images')) {
                $this->imageService->createImage($company, $request->images);
            }
            DB::commit();
            
            return redirect()->route('company.show', ['id' => $company->id])->with('messageSuccess', trans('message.create_successfully'));
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
            $company = $this->companyService->getCompany($id);
            $this->authorize('view', $company);
            $statuses = $this->companyService->getListStatuses();
            $stations = $this->stationService->getAll();
            unset($statuses[0]);

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
    public function update(CompanyRequest $request, $id)
    {
        try {
            $data = $request->only([
                'station_id',
                'name',
                'address',
                'phone',
                'status',
                'description',
                'super_manager',
                'employee',
                'old_image',
            ]);
            $data['employee'] = json_decode($data['employee']);
            $data['old_image'] = json_decode($data['old_image']);
            DB::beginTransaction();
            $company = $this->companyService->updateCompany($id, $data);

            if ($data['old_image']) {
                $this->imageService->deleteImageExcept($company, $data['old_image']);
            }

            if ($request->hasFile('images')) {
                $this->imageService->createImage($company, $request->images);
            }
            DB::commit();
            
            return redirect()->route('company.show', ['id' => $company->id])->with('messageSuccess', trans('message.update_successfully'));
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
                $company = $this->companyService->getCompany($item->id);
                $this->companyService->updateMultyStatus($item->id, $item->status);
                $this->busService->updateMultyStatus($company->buses->pluck('id')->all(), $item->status);
                $this->routeService->updateMultyStatus($company->routes->pluck('id')->all(), $item->status);
                $busRouteIds = $this->busRouteService->whereInService('bus_id', $company->buses->pluck('id')->all())->pluck('id')->all();
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
            $dataId = json_decode($request->data);
            DB::beginTransaction();

            $this->companyService->deleteMulty($dataId);
            $busesID = $this->busService->whereInService('company_id', $dataId)->pluck('id')->all();
            $this->busService->deleteMulty($busesID);
            $routeID = $this->routeService->whereInService('company_id', $dataId)->pluck('id')->all();
            $this->routeService->deleteMulty($routeID);
            $busRouteIds = $this->busRouteService->whereInService('bus_id', $busesID)->pluck('id')->all();
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

    public function manage()
    {
        return redirect()->action(
            'Admin\CompanyController@show', ['id' => Auth::user()->userCompanies->first()->company_id]
        );
    }
}
