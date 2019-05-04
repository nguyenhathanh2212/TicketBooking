<?php

namespace App\Services;

use App\Models\User;

class UserService extends BaseService {
    /**
     * CompanyService constructor.
     * @param Company $company
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function createUser($data)
    {
        return $this->model->create($data);
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

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }
}
