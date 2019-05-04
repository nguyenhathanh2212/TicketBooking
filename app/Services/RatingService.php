<?php

namespace App\Services;

use App\Models\Rating;

class RatingService extends BaseService
{
    /**
     * CompanyService constructor.
     * @param Company $company
     */
    public function __construct(Rating $rating)
    {
        $this->model = $rating;
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
     * @param $modelMorph
     * @param array $params
     * @return mixed
     */
    public function search($modelMorph, $params = [])
    {
        $params = $this->setParams($params);
        $query = $modelMorph->ratings();
        $query = $query->with('user');

        return $query->orderBy($params['sort_field'], $params['sort_type'])->paginate($params['size']);
    }

    public function createRating($modelMorph, $data)
    {
        return $modelMorph->ratings()->create($data);
    }
}
