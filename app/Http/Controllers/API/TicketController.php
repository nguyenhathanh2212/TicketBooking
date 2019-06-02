<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BusRouteService;
use App\Services\TicketService;
use Auth;
use Exception;
Use App\Jobs\SendBookingEmail;

class TicketController extends BaseController
{
    protected $busRouteService;
    protected $ticketService;

    public function __construct(
        BusRouteService $busRouteService,
        TicketService $ticketService
    ) {
        $this->busRouteService = $busRouteService;
        $this->ticketService = $ticketService;
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
            ]);
            $data['user_id'] = Auth::user()->id;
            $busRoute = $this->busRouteService->getBusRoute($busRouteId);
            $ticket = $this->ticketService->createTicket($busRoute, $data);
            $this->dispatch(new SendBookingEmail($ticket));

            return $this->responseSuccess(compact('ticket'));
        } catch (Exception $e) {
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
}
