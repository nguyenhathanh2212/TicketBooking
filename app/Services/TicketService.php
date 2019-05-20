<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Company;
use App\Models\Route;
use App\Models\BusRoute;
use Carbon\Carbon;
use Exception;

class TicketService extends BaseService {
    /**
     * CompanyService constructor.
     * @param Station $busStation
     */
    public function __construct(Ticket $ticket)
    {
        $this->model = $ticket;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function setParams($params)
    {
        $params['size'] = $params['size'] ?? config('setting.filter.size');
        $params['sort_field'] = $params['sort_field'] ?? config('setting.filter.sort_field');
        $params['sort_type'] = $params['sort_type'] ?? config('setting.filter.sort_type');
        $params['date_away'] = !empty($params['date_away']) ? Carbon::createFromFormat(trans('main.date_format'), $params['date_away']) : '';

        return $params;
    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($params = [])
    {
        $params = $this->setParams($params);
        $query = $this->model->newQuery();

        if (!empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (!empty($params['date_away'])) {
            $query->whereDate('date_away', $params['date_away']);
        }

        if (!empty($params['status'])) {
            if ($params['status'] == config('setting.ticket.status.finish')) {
                $query->where('status', config('setting.ticket.status.active'));
                $query->whereDate('date_away', '<', Carbon::now());
            } else if ($params['status'] == config('setting.ticket.status.active')) {
                $query->where('status', config('setting.ticket.status.active'));
                $query->whereDate('date_away', '>=', Carbon::now());
            } else {
                $query->where('status', $params['status']);
            }
        }
        
        if (!empty($params['keyword'])) {
            $query->where(function($subQuery) use ($params) {
                $subQuery->orWhere('name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('email', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('phone', 'like', '%' . $params['keyword'] . '%');
            });
        }

        if (!empty($params['company_id'])) {
            $companyId = Company::find($params['company_id'])->id;
            $routesId = Route::where('company_id', $companyId)->pluck('id')->all();
            $busRoutesId = BusRoute::whereIn('route_id', $routesId)->pluck('id')->all();
            $query->whereIn('bus_route_id', $busRoutesId);
        }

        if (!empty($params['route_id'])) {
            $busRoutesId = BusRoute::where('route_id', $params['route_id'])->pluck('id')->all();
            $query->whereIn('bus_route_id', $busRoutesId);
        }

        if (!empty($params['bus_id'])) {
            $busRoutesId = BusRoute::where('bus_id', $params['bus_id'])->pluck('id')->all();
            $query->whereIn('bus_route_id', $busRoutesId);
        }

        $query->with(['busRoute.route']);

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function createTicket($busRoute, $data)
    {
        $startTime = $busRoute->route->start_time;
        $data['quantity'] = count($data['seat_number']);
        $data['status'] = config('setting.ticket.status.active');
        $data['date_away'] = Carbon::createFromFormat(trans('main.date_format') . ' H:i:s', "{$data['date_away']} {$startTime}");
        $data['total_price'] = $busRoute->price * $data['quantity'];
        $checkSeat = true;
        $ticketSeat = $busRoute->tickets()->whereDay('date_away', $data['date_away'])->pluck('seat_number')->all();

        foreach($ticketSeat as $seats) {
            $seats = json_decode($seats);

            if (count(array_unique(array_merge($seats, $data['seat_number']))) < count($data['seat_number']) + count($seats)) {
                $checkSeat = false;
                break;
            }
        }

        if (!$checkSeat) {
            throw new Exception("Seat is ordered!", 1000);
        }

        $data['seat_number'] = json_encode($data['seat_number']);

        return $busRoute->tickets()->create($data);
    }

    public function getTicket($id)
    {
        $ticket = $this->model->with(['busRoute.route'])->find($id);

        if (!$ticket) {
            throw new Exception("Moldel not found", 1);
        }

        return $ticket;
    }

    public function getTicketStatuses()
    {
        return array_combine(config('setting.ticket.status'), trans('ticket.status'));
    }
}
