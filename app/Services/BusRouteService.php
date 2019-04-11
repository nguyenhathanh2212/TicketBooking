<?php

namespace App\Services;

use App\Models\BusRoute;
use App\Models\Station;
use App\Models\Route;
use Carbon\Carbon;

class BusRouteService extends BaseService {
    /**
     * CompanyService constructor.
     * @param BusRoute $busRoute
     */
    public function __construct(BusRoute $busRoute)
    {
        $this->model = $busRoute;
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
        $routeIds = [];

//        if (!empty($params['provincial_start'])) {
//            $stationIds = Station::where('provincial_id', $params['provincial_start'])->pluck('id')->all();
//            $routeIds = array_merge($routeIds, Route::whereIn('start_station_id', $stationIds)->pluck('id')->all());
//        }
//
//        if (!empty($params['provincial_destination'])) {
//            $stationIds = Station::where('provincial_id', $params['provincial_destination'])->pluck('id')->all();
//            $routeIds = array_merge($routeIds, Route::whereIn('destination_station_id', $stationIds)->pluck('id')->all());
//        }
//
//        if (!empty($params['date_away'])) {
//            $routeIds = array_merge($routeIds, Route::where('start_time', $params['date_away'])->pluck('id')->all());
//        }
        
        if ($routeIds) {
            $query = $query->whereIn('route_id', $routeIds);
        }
        
        $query->with(['route', 'bus', 'ratings', 'tickets']);

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function getBusRoute($id)
    {
        return $this->model->with(['route', 'bus', 'ratings', 'tickets'])->find($id);
    }
}
