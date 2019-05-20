@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_station')
    <small>@lang('main.detail')</small>
</h1>
@endsection

@section('main_content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('station.station_information')</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="status">@lang('station.provincial')</label>
                                {{ Form::select('provincial', $provincials->pluck('name', 'id'), $station->provincial_id,[
                                    'class' => 'form-control',
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('station.name')</label>
                                {{ Form::text('name', $station->name, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('station.name'),
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="address">@lang('station.address')</label>
                                {{ Form::text('address', $station->address, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('station.address'),
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label for="phone">@lang('station.phone')</label>
                                {{ Form::text('phone', $station->phone, [
                                    'class' => 'form-control',
                                    'placeholder' => trans('station.phone'),
                                ]) }}
                            </div>
                            {{-- <div class="form-group">
                                <label for="status">@lang('station.status')</label>
                                {{ Form::select('status', $statuses, $station->status, [
                                    'class' => 'form-control',
                                ]) }}
                            </div> --}}
                            <div class="form-group">
                                <label for="status">@lang('station.companies')</label>    
                                <a href="{{ route('company.index', ['station_id' => $station->id]) }}">
                                    <label style="cursor: pointer" class="label label-info">{{ $station->companies_count }} @lang('station.companies')</label>
                                </a>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    {{-- <img class="avatar-user-detail" src="{{ $user->avatar }}" alt=""> --}}
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
