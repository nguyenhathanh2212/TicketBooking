<?php

namespace App\Services;

use App\Models\Route;
use Exception;

class RouteService extends BaseService {
    /**
     * CompanyService constructor.
     * @param BusRoute $busRoute
     * @param Route $routeModel
     */
    public function __construct(Route $route) {
        $this->model = $route;
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

        if (!empty($params['company_id'])) {
            $query = $query->where('company_id', $params['company_id']);
        }

        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function getRoute($id)
    {
        $route = $this->model->find($id);

        if (!$route) {
            throw new Exception("Moldel not found", 1);
        }

        return $route;
    }

    public function getAllRouteByStationId($id)
    {
        return $this->model->whereIn('start_station_id', array_wrap($id))->orWhere('destination_station_id', array_wrap($id))->get();
    }

    public function processData($data)
    {
        $data['direct_payment'] = isset($data['direct_payment']) ? config('setting.direct_payment.allow') : config('setting.direct_payment.disallow');
        $data['reservation'] = isset($data['reservation']) ? config('setting.reservation.allow') : config('setting.reservation.disallow');
        
        return $data;
    }

    public function updateRoute($id, $data)
    {
        $data = $this->processData($data);
        $route = $this->model->find($id);
        $route->update($data);
        
        return $route;
    }

    public function createRoute($data)
    {
        $data = $this->processData($data);
        
        return $this->model->create($data);
    }
}
