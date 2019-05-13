@extends('admin.template.master')

@section('main_content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('main.manage_company')</h3>
                <div class="box-tools">
                    {{ Form::open(['url' => route('company.index'), 'method' => 'get']) }}
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
                            <th>
                                <input type="checkbox" class="flat-red choice-all">
                            </th>
                            <th>No.</th>
                            <th>@lang('company.name')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'name'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'name') }}"></i>
                                </a>
                            </th>
                            <th>@lang('company.address')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'address'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'address') }}"></i>
                                </a>
                            </th>
                            <th>@lang('company.phone')</th>
                            <th>@lang('company.route')</th>
                            <th>@lang('company.review')</th>
                            <th>@lang('company.status')</th>
                        </tr>
                        @foreach ($companies as $company)
                            <tr>
                                <td><input type="checkbox" value="{{ $company->id }}" name="companies_choice[]" class="choice-item flat-red"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('company.show', $company->id) }}">{{ $company->name }}</a></td>
                                <td>{{ $company->address }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>
                                    <a href="">
                                        <label class="label label-info">{{ $company->routes->count() }}</label> @lang('company.route')
                                    </a>
                                </td>
                                <td>
                                    <a href="">
                                        <label class="label label-warning">{{ $company->ratings->count() }}</label> @lang('company.review')
                                    </a>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-xs" title="@lang('company.change_status')">Active</button>
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
                        <li><a href="#">@lang('company.change_status')</a></li>
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
                    {{ $companies->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

        })
    </script>
@endpush
