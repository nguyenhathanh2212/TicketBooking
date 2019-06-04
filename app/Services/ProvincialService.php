<?php

namespace App\Services;

use App\Models\Provincial;

class ProvincialService extends BaseService {
    /**
     * CompanyService constructor.
     * @param Station $busStation
     */
    public function __construct(Provincial $provincial)
    {
        $this->model = $provincial;
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
                $subQuery->orWhere('name', 'like', '%' . $params['keyword'] . '%');
            });
        }
        if
         (!empty($status)) {
            $query->where('status', $params['status']);
        }

        $query->withCount('stations');

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function getAll($status = null)
    {
        $query = $this->model->newQuery();
        
        if (!empty($status)) {
            $query->where('status', $status);
        }

        $provincials = $query->get();

        if (!$provincials) {
            throw new Exception("Model not found", 1);
        }

        return $provincials;
    }

    public function getPopulars($status = null)
    {
        $query = $this->model->newQuery();
        
        if (!empty($status)) {
            $query->where('status', $status);
        }

        return $query->withCount('companies')->orderBy('companies_count', 'desc')->limit(8)->get();
    }
}
