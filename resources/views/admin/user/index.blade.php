@extends('admin.template.master')

@section('main_content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('main.manage_company')</h3>
                <div class="box-tools" style="right: 180px;">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        {{ Form::select('role', $listRoles, Request::get('role'), [
                            'class' => 'form-control filter-list'
                        ])}}
                    </div>
                </div>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>
                                <input type="checkbox" class="flat-red choice-all">
                            </th>
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
                        </tr>
                        @foreach ($users as $user)
                            <tr>
                                <td><input type="checkbox" value="{{ $user->id }}" name="users_choice[]" class="choice-item flat-red"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('user.show', $user->id) }}">{{ $user->full_name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="label label-info">
                                        {{ trans('user.role_value')[$user->role] }}
                                    </span>
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
        </div>
    </div>
</div>
@endsection
