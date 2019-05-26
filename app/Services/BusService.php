<?php

namespace App\Services;

use App\Models\Bus;
use Exception;

class BusService extends BaseService {
    /**
     * CompanyService constructor.
     * @param BusRoute $busRoute
     * @param Route $routeModel
     */
    public function __construct(Bus $bus) {
        $this->model = $bus;
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

        if (!empty($params['keyword'])) {
            $query->where(function($subQuery) use ($params) {
                $subQuery->orWhere('lisense_plate', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('driver_name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('number_of_seats', 'like', '%' . $params['keyword'] . '%');
            });
        }
        
        if (!empty($params['company_id'])) {
            $query->where('company_id', $params['company_id']);
        }

        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function getBus($id)
    {
        $bus = $this->model->find($id);

        if (!$bus) {
            throw new Exception("Moldel not found", 1);
        }

        return $bus;
    }

    public function updateBus($id, $data)
    {
        $bus = $this->model->find($id);
        $bus->update($data);
        
        return $bus;
    }
}
