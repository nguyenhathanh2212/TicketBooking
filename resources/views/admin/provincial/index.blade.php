@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_provincial')
    <small>@lang('main.list')</small>
</h1>
@endsection

@section('main_content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('main.manage_provincial')</h3>
                <div class="box-tools">
                    {{ Form::open(['url' => route('provincial.index'), 'method' => 'get']) }}
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th width="5%">
                                <input type="checkbox" class="flat-red choice-all">
                            </th>
                            <th width="5%">No.</th>
                            <th width="30%">@lang('station.name')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'name'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'name') }}"></i>
                                </a>
                            </th>
                            <th width="30%">@lang('main.stations')</th>
                            <th width="30%">@lang('station.status')</th>
                        </tr>
                        @php
                            unset($statuses[0]);    
                        @endphp
                        @foreach ($provincials as $provincial)
                            <tr>
                                <td><input type="checkbox" value="{{ $provincial->id }}" name="provincial_choice[]" class="choice-item flat-red"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('provincial.show', $provincial->id) }}">{{ $provincial->name }}</a></td>
                                <td>
                                    <a href="{{ route('station.index', ['provincial_id' => $provincial->id]) }}">
                                        <label class="label label-info">{{ $provincial->stations_count }}</label> @lang('main.stations')
                                    </a>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{ Form::select('status', $statuses, $provincial->status,[
                                            'class' => 'form-control select-status',
                                            'data-id' => $provincial->id,
                                        ]) }}
                                    </div>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">@lang('main.delete')</a></li>
                    </ul>
                </div>
                <div class="input-group-btn text-right">
                    {{ Form::open(['method' => 'post', 'url' => route('company.update_multy_status'), 'class' => 'form-change-multy-status']) }}
                        {{ Form::hidden('data', '', ['class' => 'data-change-status']) }}
                        <button type="button"
                            class="btn btn-info btn-sm btn-change-multy-status"
                            data-message="@lang('message.warning_change_status_provincial')">
                            @lang('company.change_status')
                        </button>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="box-footer clearfix">
                <div class="col-md-3">
                    <div class="dataTables_length" id="example1_length">
                        <label>@lang('main.show')
                            {{ Form::select('paginate', config('setting.number_of_records_pagination'), Request::get('size'), [
                                'class' => 'show-number-record form-control input-sm'
                            ]) }}
                            @lang('main.entries')
                        </label>
                    </div>
                </div>
                <div class="text-right col-md-9">
                    {{ $provincials->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
