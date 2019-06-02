@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.dashboard')
</h1>
@endsection

@section('main_content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $data['companyCount'] }}</h3>
                <p>@lang('main.companies')</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-bus"></i>
            </div>
            <a href="{{ route('company.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $data['stationCount'] }}</h3>
                <p>@lang('main.stations')</p>
            </div>
            <div class="icon">
                <i class="ion ion-home"></i>
            </div>
            <a href="{{ route('station.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $data['provincialCount'] }}</h3>
                <p>@lang('main.provincials')</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-location"></i>
            </div>
            <a href="{{ route('provincial.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $data['userCount'] }}</h3>
                <p>@lang('main.users')</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
@endsection
