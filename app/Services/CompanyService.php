<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Station;
use Exception;

class CompanyService extends BaseService {
    /**
     * CompanyService constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function setParams($params)
    {
        $params['size'] = $params['size'] ?? config('setting.filter.size');
        $params['sort_field'] = $params['sort_field'] ?? config('setting.filter.sort_field');
        $params['sort_type'] = $params['sort_type'] ?? config('setting.filter.sort_type');

        return $params;
    }

    /**
     * search
     *
     * @param array $params
     */
    public function search($params = [])
    {
        $params = $this->setParams($params);
        $query = $this->model->newQuery();

        if (!empty($params['provincial'])) {
            $stationsID = Station::where('provincial_id', $params['provincial'])->pluck('id');
            $query->whereIn('station_id', $stationsID);
        }

        if (!empty($params['station'])) {
            $query->where('station_id', $params['station']);
        }

        if (!empty($params['keyword'])) {
            $query->where(function($subQuery) use ($params) {
                $subQuery->orWhere('name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('address', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('phone', 'like', '%' . $params['keyword'] . '%');
            });
        }

        if (!empty($params['station_id'])) {
            $query->where('station_id', $params['station_id']);
        }

        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }

        $query->with(['images', 'ratings'])->withCount(['routes', 'ratings']);

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    /**
     * get company
     *
     * @param string $id
     */
    public function getCompany($id)
    {
        $company = $this->model->with(['images', 'routes'])->withCount(['routes', 'ratings'])->find($id);

        if (!$company) {
            throw new Exception("Moldel not found", 1);
        }

        return $company;
    }
}
