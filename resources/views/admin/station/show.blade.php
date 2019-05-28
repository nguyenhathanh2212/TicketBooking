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
        @include('admin.template.notice')
        <div class="box-body">
            {{ Form::open(['class' => 'form-station',
                'url' => route('station.update', $station->id),
                'method' => 'PUT',
                'enctype'=>'multipart/form-data',
                'data-message' => trans('message.confirm_update_station')]) }}
                @include('admin.station.form')
            {{ Form::close() }}
            <!-- /.row -->
        </div>
    </div>
@endsection

@push('script') 
    {{ Html::script(asset('admin/js/station.js')) }}
@endpush
