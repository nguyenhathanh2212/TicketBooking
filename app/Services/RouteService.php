<?php

namespace App\Services;

use App\Models\Route;

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

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }
}
