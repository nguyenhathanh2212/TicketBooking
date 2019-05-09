<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Station;

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
            $query = $query->whereIn('station_id', $stationsID);
        }

        if (!empty($params['station'])) {
            $query = $query->where('station_id', $params['station']);
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
        return $this->model->with(['images', 'routes'])->withCount(['routes', 'ratings'])->find($id);
    }
}
