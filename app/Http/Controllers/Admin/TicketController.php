<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TicketService;
use App\Services\CompanyService;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;
use Auth;

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
            if (empty($request->company_id)) {
                throw new Exception("Not found", 404);
            }

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

            $company = $this->companyService->getCompany($params['company_id']);
            $busLisenses = $company->buses()->pluck('lisense_plate', 'id')->all();
            $busLisenses = [0 => trans('main.all_bus')] + $busLisenses;
            $tickets = $this->ticketService->search($params);
            $statuses = $this->ticketService->getTicketStatuses();
            $routes = $company->routes->pluck('name_route', 'id')->all();
            $routes = [0 => trans('main.all_route')] + $routes;

            return view('admin.ticket.index', compact('tickets', 'statuses', 'busLisenses', 'routes'));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }

    public function export(Request $request)
    {
        try {
            $params = $request->all();
            $params['export'] =  true;
            $tickets = $this->ticketService->search($params);

            return Excel::download(new TicketsExport($tickets), 'tickets.xls');
        } catch (Exception $e) {
            report($e);
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
    public function show(Request $request, $id)
    {
        try {
            $ticket = $this->ticketService->getTicket($id);

            if (isset($request->notification)) {
                Auth::user()->unreadNotifications->where('id', $request->notification)->markAsRead();
            }

            return view('admin.ticket.show', compact('ticket'));
        } catch (Exception $e) {
            report($e);
            abort(404);
        }
    }
}
