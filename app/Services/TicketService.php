<?php

namespace App\Services;

use App\Models\Ticket;
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

        $query->with(['busRoute.route']);

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function createTicket($busRoute, $data)
    {
        $data['quantity'] = count($data['seat_number']);
        $data['status'] = config('setting.ticket.status.active');
        $data['date_away'] = Carbon::createFromFormat(trans('main.date_format'), $data['date_away']);
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
}
