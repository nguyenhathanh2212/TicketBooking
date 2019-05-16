<?php

namespace App\Services;

use App\Models\BusRoute;
use App\Models\Station;
use App\Models\Route;
use Carbon\Carbon;

class BusRouteService extends BaseService {
    protected $routeModel;

    /**
     * CompanyService constructor.
     * @param BusRoute $busRoute
     * @param Route $routeModel
     */
    public function __construct(
        BusRoute $busRoute,
        Route $routeModel
    ) {
        $this->model = $busRoute;
        $this->routeModel = $routeModel;
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

        $routesQuery = $this->routeModel->newQuery();

        if (!empty($params['provincial_start'])) {
            $stationIds = Station::where('provincial_id', $params['provincial_start'])->pluck('id')->all();
            $routesQuery = $routesQuery->whereIn('start_station_id', $stationIds);
        }

        if (!empty($params['provincial_destination'])) {
            $stationIds = Station::where('provincial_id', $params['provincial_destination'])->pluck('id')->all();
            $routesQuery = $routesQuery->whereIn('destination_station_id', $stationIds);
        }

        if (!empty($params['date_away'])) {
            $now = Carbon::now();
            $numberPresetDate = $now->diffInDays($params['date_away'], false);

            if ($numberPresetDate > 0) {
                $routesQuery = $routesQuery->where('number_preset_date', '>=', $numberPresetDate);
            } else if ($numberPresetDate == 0) {
                $now->addHour(config('setting.number_hours_preset'));
                $routesQuery = $routesQuery->whereTime('start_time', '>=', $now->format('H:i:m'));
            } else {
                $routesQuery->whereNull('number_preset_date');
            }
        }

        if (!empty($params['route'])) {
            $query = $query->where('route_id', $params['route']);
        }

        $query = $query->whereIn('route_id', $routesQuery->pluck('id')->all());
        $query->with(['route', 'bus', 'ratings', 'tickets']);

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function getBusRoute($id)
    {
        $busRoute = $this->model->with(['route', 'bus', 'ratings', 'tickets'])->find($id);

        if (!$busRoute) {
            throw new Exception("Moldel not found", 1);
        }

        return $busRoute;
    }
}
