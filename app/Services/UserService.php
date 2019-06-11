<?php

namespace App\Services;

use App\Models\User;
use Exception;

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

        if (!empty($params['role']) && $params['role']) {
            $query->where('role', $params['role']);
        }

        if (!empty($params['keyword'])) {
            $query->where(function($subQuery) use ($params) {
                $subQuery->orWhere('first_name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('last_name', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('email', 'like', '%' . $params['keyword'] . '%');
            });
        }

        if (!empty($params['type_user']) && $params['type_user']) {
            if ($params['type_user'] == config('setting.type_user.user')) {
                $query->where('role', config('setting.user.role.user'))->whereDoesntHave('userCompanies');
            } else if ($params['type_user'] == config('setting.type_user.company_admin')) {
                $query->where('role', config('setting.user.role.user'))->whereHas('userCompanies');
            } else {
                $query->whereIn('role', [config('setting.user.role.super_admin'), config('setting.user.role.admin')]);
            }
        }

        if (!empty($params['filter_id'])) {
            $query->whereNotIn('id', $params['filter_id']);
        }

        if (isset($params['search_ajax']) && $params['search_ajax']) {
            $query->where('password', '!=', '');
        }

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function getListRoleStrs()
    {
        return array_combine(config('setting.type_user'), trans('user.type_user'));
    }

    public function getListRoles()
    {
        return array_combine(config('setting.user.role'), trans('user.role_value'));
    }

    public function getUser($id)
    {
        $user = $this->model->find($id);

        if (!$user) {
            throw new Exception("Model not found", 1);
        }

        return $user;
    }

    public function updateUser($id, $data)
    {
        $user = $this->model->find($id);
        $user->update($data);
        
        return $user;
    }
}
