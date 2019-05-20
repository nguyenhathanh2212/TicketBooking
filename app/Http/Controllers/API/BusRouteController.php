<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Exception;
use App\Services\BusRouteService;
use App\Services\RatingService;
use Auth;
use Illuminate\Support\Arr;

class BusRouteController extends BaseController
{
    protected $busRouteService;
    protected $ratingService;

    public function __construct(
        BusRouteService $busRouteService,
        RatingService $ratingService
    ) {
        $this->busRouteService = $busRouteService;
        $this->ratingService = $ratingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
                'date_away',
                'provincial_start',
                'provincial_destination',
                'route'
            ]);

            $busRoutes = $this->busRouteService->search($params);

            return $this->responseSuccess(compact('busRoutes'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $busRoute = $this->busRouteService->getBusRoute($id);

            return $this->responseSuccess(compact('busRoute'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRatings(Request $request, $id)
    {
        try {
            $busRoute = $this->busRouteService->getBusRoute($id);
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
            ]);

            $ratings = $this->ratingService->search($busRoute, $params);

            return $this->responseSuccess(compact('ratings'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }

    public function rate(Request $request, $id)
    {
        try {
            $data = $request->only([
                'rating',
                'comment'
            ]);
            $data['user_id'] = Auth::user()->id;
            $busRoute = $this->busRouteService->getBusRoute($id);
            $rating = $this->ratingService->createRating($busRoute, $data);

            return $this->responseSuccess(compact('rating'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }
}
