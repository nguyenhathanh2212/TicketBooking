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

        if (!empty($params['user_id'])) {
            $userId = $params['user_id'];

            $query->whereHas ('userCompanies', function($q) use($userId) {
                $q->where('user_id', $userId);
            });
        }

        $query->with(['images', 'ratings'])->withCount(['routes', 'ratings']);

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    /**
     * get company
     *
     * @param string $id
     */
    public function getCompany($id, $status = null)
    {
        $company = $this->model->with(['images', 'routes'])->withCount(['routes', 'ratings'])->find($id);
        
        if (!$company || (!empty($status) && $company->status != $status)) {
            throw new Exception("Model not found", 1);
        }

        return $company;
    }

    public function getAll()
    {
        $companies = $this->model->all();

        if (!$companies) {
            throw new Exception("Model not found", 1);
        }

        return $companies;
    }

    public function createCompany($data)
    {
        $company = $this->model->create($data);
        $company->userCompanies()->create([
            'user_id' => $data['super_manager'],
            'role' => config('setting.user.role_company.super_manager'),
        ]);

        $dataEmployee = [];

        foreach($data['employee'] as $id) {
            $dataEmployee[] = [
                'role' => config('setting.user.role_company.manager'),
                'user_id' => $id,
            ];
        }

        $company->userCompanies()->createMany($dataEmployee);

        return $company;
    }
    
    public function updateCompany($id, $data)
    {
        $company = $this->model->find($id);
        $company->update($data);

        if ($company->userCompanies()->where('role', config('setting.user.role_company.super_manager'))->count()) {
            $company->userCompanies()->where('role', config('setting.user.role_company.super_manager'))->update([
                'user_id' => $data['super_manager'],
            ]);
        } else {
            $company->userCompanies()->create([
                'user_id' => $data['super_manager'],
                'role' => config('setting.user.role_company.super_manager'),
            ]);
        }

        $companyManagerId = $company->userCompanies()->where('role', config('setting.user.role_company.manager'))->pluck('user_id')->all();
        $deleteIds = array_diff($companyManagerId, $data['employee']);
        $createIds = array_diff($data['employee'], $companyManagerId);
        $company->userCompanies()->whereIn('user_id', $deleteIds)->delete();

        foreach($createIds as $id) {
            $company->userCompanies()->create([
                'user_id' => $id,
                'role' => config('setting.user.role_company.manager'),
            ]);
        }

        return $company;
    }
}
