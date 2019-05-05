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

    public function getAll()
    {
        return $this->model->all();
    }

    public function getPopulars()
    {
        return $this->model
            ->withCount('companies')->orderBy('companies_count', 'desc')->limit(8)->get();
    }
}
