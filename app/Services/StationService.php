<?php

namespace App\Services;

use App\Models\Station;
use Exception;

class StationService extends BaseService {
    /**
     * CompanyService constructor.
     * @param Station $busStation
     */
    public function __construct(Station $busStation)
    {
        $this->model = $busStation;
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
                $subQuery->orWhere('name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('address', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('phone', 'like', '%' . $params['keyword'] . '%');
            });
        }

        if (!empty($params['provincial_id'])) {
            $query->where('provincial_id', $params['provincial_id']);
        }

        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }

        $query->with('provincial')->withCount('companies');

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function getStation($id)
    {
        $station = $this->model->withCount('companies')->find($id);

        if (!$station) {
            throw new Exception("Model not found", 1);
        }

        return $station;
    }

    public function getAll()
    {
        $stations = $this->model->all();

        if (!$stations) {
            throw new Exception("Model not found", 1);
        }

        return $stations;
    }

    public function createStation($data)
    {
        return $this->model->create($data);
    }

    public function updateStation($id, $data)
    {
        $station = $this->model->find($id);
        $station->update($data);
        
        return $station;
    }
}
