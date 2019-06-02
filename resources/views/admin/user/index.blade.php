@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_company')
    <small>@lang('main.list')</small>
</h1>
@endsection

@section('main_content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('main.manage_company')</h3>
                <div class="box-tools" style="right: 180px;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        {{ Form::select('type_user', $listRoles, Request::get('type_user'), [
                            'class' => 'form-control',
                            'form' => 'form-search'
                        ])}}
                    </div>
                </div>
                <div class="box-tools">
                    {{ Form::open(['url' => route('user.index'), 'method' => 'get', 'id' => 'form-search']) }}
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
            @include('admin.template.notice')
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-record">
                    <tbody>
                        <tr>
                            @can('deleteMulty', App\Models\User::class)
                                <th>
                                    <input type="checkbox" class="flat-red choice-all">
                                </th>
                            @endcan
                            <th>No.</th>
                            <th>@lang('user.name')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'first_name'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'first_name') }}"></i>
                                </a>
                            </th>
                            <th>@lang('user.email')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'email'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'email') }}"></i>
                                </a>
                            </th>
                            <th>@lang('user.role')</th>
                            <th>@lang('main.status')</th>
                        </tr>
                        @php
                            unset($statuses[0]);    
                        @endphp
                        @forelse ($users as $user)
                            <tr>
                                @can('deleteMulty', App\Models\User::class)
                                    <td>
                                        <input type="checkbox"
                                            value="{{ $user->id }}"
                                            name="item_choice[]"
                                            class="choice-item flat-red">
                                    </td>
                                @endcan
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('user.show', $user->id) }}">{{ $user->full_name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="label label-info">
                                        {{ $user->role_str }}
                                    </span>
                                </td>
                                <td>
                                    <div class="form-group">
                                        {{ Form::select('status', $statuses, $user->status,[
                                            'class' => 'form-control select-status',
                                            'data-id' => $user->id,
                                            'disabled' => Auth::user()->cannot('update', $user),
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
            @if ($users->total())
                <div class="box-footer clearfix">
                    <div class="input-group-btn">
                        @can('deleteMulty', App\Models\User::class)
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                            <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" data-message="@lang('message.warning_delete_user')" class="btn-delete-multy">@lang('main.delete')</a>
                                    {{ Form::open(['method' => 'delete', 'url' => route('user.delete_multy'), 'class' => 'form-delete-multy']) }}
                                        {{ Form::hidden('data', '', ['class' => 'data-id-delete']) }}
                                    {{ Form::close() }}
                                </li>
                            </ul>
                        @endcan
                    </div>
                    <div class="input-group-btn text-right">
                        @can('updateMulty', App\Models\User::class)
                            {{ Form::open(['method' => 'post', 'url' => route('user.update_multy_status'), 'class' => 'form-change-multy-status']) }}
                                {{ Form::hidden('data', '', ['class' => 'data-change-status']) }}
                                <button type="button"
                                    class="btn btn-info btn-sm btn-change-multy-status"
                                    data-message="@lang('message.warning_change_status_user')">
                                    @lang('company.change_status')
                                </button>
                            {{ Form::close() }}
                        @endcan
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
                        {{ $users->appends(Request::except('page'))->links() }}
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
