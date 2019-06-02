<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TicketService;
use App\Services\CompanyService;

class TicketController extends Controller
{
    protected $ticketService;
    protected $companyService;

    /**
     * CompanyController constructor.
     * @param CompanyService $companyService
     * @param RatingService $ratingService
     */
    public function __construct(
        TicketService $ticketService,
        CompanyService $companyService
    ) {
        $this->ticketService = $ticketService;
        $this->companyService = $companyService;
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
                'date_away',
                'bus_id',
                'route_id'
            ]);
            $params['company_id'] = 1;
            $company = $this->companyService->getCompany($params['company_id']);
            $busLisenses = $company->buses()->pluck('lisense_plate', 'id')->all();
            $busLisenses = [0 => trans('main.bus')] + $busLisenses;
            $tickets = $this->ticketService->search($params);
            $statuses = $this->ticketService->getTicketStatuses();
            $routes = $company->routes->pluck('name_route', 'id')->all();
            $routes = [0 => trans('main.route')] + $routes;

            return view('admin.ticket.index', compact('tickets', 'statuses', 'busLisenses', 'routes'));
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
        try {
            $ticket = $this->ticketService->getTicket($id);

            return view('admin.ticket.show', compact('ticket'));
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
}
