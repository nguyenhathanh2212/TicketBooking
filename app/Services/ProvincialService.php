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
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
