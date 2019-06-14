@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_bus')
    <small>@lang('main.list')</small>
</h1>
@endsection

@section('main_content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('main.manage_bus')</h3>
                <div class="block-search">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            {{ Form::select('company_id', $listCompanies, Request::get('company_id'), [
                                'class' => 'form-control',
                                'form' => 'form-search'
                            ])}}
                        </div>
                    </div>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            {{ Form::select('status', $statuses, Request::get('status'), [
                                'class' => 'form-control',
                                'form' => 'form-search'
                            ])}}
                        </div>
                    </div>
                    <div class="box-tools">
                        {{ Form::open(['url' => route('bus.index'), 'method' => 'get', 'id' => 'form-search']) }}
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            @include('admin.template.notice')
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-record">
                    <tbody>
                        <tr>
                            <th>
                                <input type="checkbox" class="flat-red choice-all">
                            </th>
                            <th>No.</th>
                            <th>@lang('bus.lisense_plate')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'lisense_plate'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'lisense_plate') }}"></i>
                                </a>
                            </th>
                            <th>@lang('bus.driver_name')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'driver_name'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'driver_name') }}"></i>
                                </a>
                            </th>
                            <th>Loại xe</th>
                            <th>@lang('bus.number_of_seats')</th>
                            <th>@lang('main.status')</th>
                        </tr>
                        @php
                            unset($statuses[0]);    
                        @endphp
                        @forelse ($buses as $bus)
                            <tr>
                                <td><input type="checkbox" value="{{ $bus->id }}" name="item_choice[]" class="choice-item flat-red"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('bus.show', $bus->id) }}">{{ $bus->lisense_plate }}</a></td>
                                <td>{{ $bus->driver_name }}</td>
                                <td>{{ $bus->name_bus_type }}</td>
                                <td>{{ $bus->seats }}</td>
                                <td>
                                    <div class="form-group">
                                        {{ Form::select('status', $statuses, $bus->status,[
                                            'class' => 'form-control select-status',
                                            'data-id' => $bus->id,
                                        ]) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <span>@lang('message.data_not_found')</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($buses->total())
                <div class="box-footer clearfix">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                        <span class="fa fa-caret-down"></span></button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" data-message="@lang('message.warning_delete_bus')" class="btn-delete-multy">@lang('main.delete')</a>
                                {{ Form::open(['method' => 'delete', 'url' => route('bus.delete_multy'), 'class' => 'form-delete-multy']) }}
                                    {{ Form::hidden('data', '', ['class' => 'data-id-delete']) }}
                                {{ Form::close() }}
                            </li>
                        </ul>
                    </div>
                    <div class="input-group-btn text-right">
                        {{ Form::open(['method' => 'post', 'url' => route('bus.update_multy_status'), 'class' => 'form-change-multy-status']) }}
                            {{ Form::hidden('data', '', ['class' => 'data-change-status']) }}
                            <button type="button"
                                class="btn btn-info btn-sm btn-change-multy-status"
                                data-message="@lang('message.warning_change_status_bus')">
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
                        {{ $buses->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
