<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusRouteService;
use App\Services\CompanyService;
use App\Services\TicketService;
use Auth;
use Exception;
Use App\Jobs\SendBookingEmail;
use App\Notifications\TicketNotify;
use DB;
use Pusher\Pusher;

class TicketController extends BaseController
{
    protected $busRouteService;
    protected $ticketService;
    protected $companyService;

    public function __construct(
        BusRouteService $busRouteService,
        TicketService $ticketService,
        CompanyService $companyService
    ) {
        $this->busRouteService = $busRouteService;
        $this->ticketService = $ticketService;
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $busRouteId = $request->id;
            $data = $request->only([
                'date_away',
                'start_place',
                'destination_place',
                'name',
                'phone',
                'email',
                'seat_number',
                'payment_method',
                'quantity',
                'sale_id',
            ]);
            DB::beginTransaction();
            $data['user_id'] = Auth::user()->id;
            $busRoute = $this->busRouteService->getBusRoute($busRouteId);
            $ticket = $this->ticketService->createTicket($busRoute, $data);
            $this->dispatch(new SendBookingEmail($ticket));
            $dataNotify = [
                'title' => 'Ticket',
                'content' => 'New ticket had booked',
                'ticket_id' => $ticket->id,
                'created_at' => $ticket->created_at->format('H:i:s ' . trans('main.date_format')),
            ];
            $userCompanies = $busRoute->route->company->userCompanies;

            foreach($userCompanies as $userCompany) {
                $user = $userCompany->user;
                $user->notify(new TicketNotify($dataNotify));
            }

            //notify realtime
            $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            );
    
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
    
            $pusher->trigger('Notify', 'send-message', $dataNotify);
            DB::commit();

            return $this->responseSuccess(compact('ticket'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage(), 400);
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
            $ticket = $this->ticketService->getTicket($id);

            return $this->responseSuccess(compact('ticket'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    public function getAuthBookings(Request $request)
    {
        try {
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
            ]);
            $params['user_id'] = Auth::user()->id;
            $tickets = $this->ticketService->search($params);

            return $this->responseSuccess(compact('tickets'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    public function cancel($id)
    {
        try {
            DB::beginTransaction();
            $ticket = $this->ticketService->cancelTicket($id);

            $dataNotify = [
                'title' => 'Ticket',
                'content' => 'Ticket had cancel',
                'ticket_id' => $ticket->id,
                'created_at' => $ticket->created_at->format('H:i:s ' . trans('main.date_format')),
            ];
            $userCompanies = $ticket->busRoute->route->company->userCompanies;

            foreach($userCompanies as $userCompany) {
                $user = $userCompany->user;
                $user->notify(new TicketNotify($dataNotify));
            }

            //notify realtime
            $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            );
    
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
    
            $pusher->trigger('Notify', 'send-message', $dataNotify);
            DB::commit();

            return $this->responseSuccess(compact('ticket'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }
}
