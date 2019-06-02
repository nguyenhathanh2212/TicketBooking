<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RouteService;

class RouteController extends BaseController
{
    protected $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }

    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
                'company_id'
            ]);
            
            $params['status'] = config('setting.status.active');

            $routes = $this->routeService->search($params);

            return $this->responseSuccess(compact('routes'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }
}
