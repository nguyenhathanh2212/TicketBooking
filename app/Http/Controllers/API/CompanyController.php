<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Services\RatingService;
use Illuminate\Http\Response;
use Auth;
use Exception;

class CompanyController extends BaseController
{
    protected $companyService;
    protected $ratingService;

    /**
     * CompanyController constructor.
     * @param CompanyService $companyService
     * @param RatingService $ratingService
     */
    public function __construct(
        CompanyService $companyService,
        RatingService $ratingService
    ) {
        $this->companyService = $companyService;
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
            ]);

            $companies = $this->companyService->search($params);

            return $this->responseSuccess(compact('companies'));
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
            $company = $this->companyService->getCompany($id);

            return $this->responseSuccess(compact('company'));
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
            $company = $this->companyService->getCompany($id);
            $params = $request->only([
                'size',
                'sort_field',
                'sort_type',
            ]);

            $ratings = $this->ratingService->search($company, $params);

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
            $company = $this->companyService->getCompany($id);
            $rating = $this->ratingService->createRating($company, $data);

            return $this->responseSuccess(compact('rating'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }
}
