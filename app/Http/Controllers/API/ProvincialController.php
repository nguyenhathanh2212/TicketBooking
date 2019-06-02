<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProvincialService;

class ProvincialController extends BaseController
{
    protected $provincialService;

    public function __construct(ProvincialService $provincialService)
    {
        $this->provincialService = $provincialService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $allProvincials = $this->provincialService->getAll(config('setting.status.active'));

            return $this->responseSuccess(compact('allProvincials'));
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
        //
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

    public function popular()
    {
        try {
            $popularProvincials = $this->provincialService->getPopulars(config('setting.status.active'));

            return $this->responseSuccess(compact('popularProvincials'));
        } catch (Exception $e) {
            report($e);

            return $this->responseErrors($e->getCode(), $e->getMessage());
        }
    }
}
