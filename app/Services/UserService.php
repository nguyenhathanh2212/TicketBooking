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
}
