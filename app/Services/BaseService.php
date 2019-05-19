<?php

namespace App\Services;

class BaseService {
    protected $model;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        //
    }

    public function getListStatuses()
    {
        return array_combine(config('setting.status'), trans('main.status_value'));
    }

    public function updateMultyStatus($ids, $status)
    {
        return $this->model->whereIn('id', array_wrap($ids))->update(['status' => $status]);
    }

    public function deleteMulty($ids)
    {
        return $this->model->whereIn('id', array_wrap($ids))->delete();
    }

    public function whereInService($field, $value)
    {
        return $this->model->whereIn($field, $value);
    }
}
