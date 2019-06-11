@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_tickets')
    <small>@lang('main.list')</small>
</h1>
@endsection

@section('main_content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">@lang('main.manage_tickets')</h3>
            </div>
            <div class="block-search">
                <div class="box-tools" style="float: left; padding-left: 10px">
                    <div class="input-group input-group-sm"
                        style="width: auto; height: 30px; line-height: 30px; text-align: left">
                        <a href="#" data-url="{{ route('export-tickets') }}"
                            data-request="{{ json_encode(Request::all()) }}" class="btn btn-info btn-xs btn-export-excel">
                            <i class="fa fa-download" aria-hidden="true"></i> @lang('main.export')
                        </a>
                    </div>
                </div>
                <div class="box-tools">
                    {{ Form::hidden('company_id', Request::get('company_id'), [
                        'form' => 'form-search'
                    ]) }}
                    <div class="input-group input-group-sm" style="width: 150px;">
                        {{ Form::select('route_id', $routes, Request::get('route_id'), [
                            'class' => 'form-control',
                            'form' => 'form-search'
                        ])}}
                    </div>
                </div>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        {{ Form::select('bus_id', $busLisenses, Request::get('bus_id'), [
                            'class' => 'form-control',
                            'form' => 'form-search'
                        ])}}
                    </div>
                </div>
                <div class="box-tools">
                    <div class="input-group input-group-sm date-picker" style="width: 150px;">
                        <input type='text' value="{{ Request::get('date_away') }}" name="date_away" class="form-control" form="form-search" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
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
                    {{ Form::open(['url' => route('ticket.index'), 'method' => 'get', 'id' => 'form-search']) }}
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
                @php
                    $paypal = $allTickets->where('payment_method', config('setting.ticket.payment_method.paypal'))
                        ->where('status', config('setting.ticket.status.active'));
                    $direct = $allTickets->where('payment_method', config('setting.ticket.payment_method.direct'))
                        ->where('status', config('setting.ticket.status.active'));
                    $paypalCount = $paypal->count();
                    $totalPrePay = $paypal->sum('total_price');
                    $directCount = $direct->count();
                    $totalNotPayYet = $direct->sum('total_price');
                    // dd($paypalCount, $totalPrePay, $directCount, $totalNotPayYet);
                @endphp
                <table class="table table-hover table-record"
                    style="
                        border: 1px solid #ddd;
                        width: 30%;
                        float: right;
                        margin: 10px;
                    ">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                        </tr>
                        <tr>
                            <td>Đã thanh toán: </td>
                            <td>{{ $paypalCount }}</td>
                            <td>{{ number_format($totalPrePay, 2) }}đ</td>
                        </tr>
                        <tr>
                            <td>Chưa thanh toán</td>
                            <td>{{ $directCount }}</td>
                            <td>{{ number_format($totalNotPayYet, 2) }}đ</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-hover table-record">
                    <tbody>
                        <tr>
                            <th>
                                <input type="checkbox" class="flat-red choice-all">
                            </th>
                            <th>No.</th>
                            <th>@lang('ticket.name')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'name'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'name') }}"></i>
                                </a>
                            </th>
                            <th>@lang('ticket.phone')</th>
                            <th>@lang('ticket.email')
                                <a href="{{ route(Route::currentRouteName(),
                                    array_merge(Route::current()->parameters(), makeSortLink(Request::all(), 'email'))) }}" data-test="">
                                    <i class="icon-sort fa {{ getSortIcon(Request::all(), 'email') }}"></i>
                                </a>
                            </th>
                            <th>@lang('ticket.payment_method')</th>
                            <th>@lang('ticket.date_away')</th>
                            <th>@lang('ticket.quantity')</th>
                            <th>@lang('ticket.total_price')</th>
                            <th>@lang('main.status')</th>
                        </tr>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td><input type="checkbox" value="{{ $ticket->id }}" name="companies_choice[]" class="choice-item flat-red"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('ticket.show', $ticket->id) }}">{{ $ticket->name }}</a></td>
                                <td>{{ $ticket->phone }}</td>
                                <td>{{ $ticket->email }}</td>
                                <td>
                                    {{ $ticket->payment_method_str }}
                                </td>
                                <td>
                                    {{ $ticket->date }}
                                </td>
                                <td>
                                    {{ $ticket->quantity }}
                                </td>
                                <td>
                                    {{ $ticket->price_format }}đ
                                </td>
                                <td>
                                    <span class="label label-info">{{ $ticket->status_str }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <span>@lang('message.data_not_found')</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
            <div class="box-footer clearfix">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" data-message="@lang('message.warning_delete_company')" class="btn-delete-multy">@lang('main.delete')</a>
                            {{ Form::open(['method' => 'delete', 'url' => route('company.delete_multy'), 'class' => 'form-delete-multy']) }}
                                {{ Form::hidden('data', '', ['class' => 'data-id-delete']) }}
                            {{ Form::close() }}
                        </li>
                    </ul>
                </div>
                <div class="input-group-btn text-right">
                    {{-- {{ Form::open(['method' => 'post', 'url' => route('company.update_multy_status'), 'class' => 'form-change-multy-status']) }}
                        {{ Form::hidden('data', '', ['class' => 'data-change-status']) }}
                        <button type="button"
                            class="btn btn-info btn-sm btn-change-multy-status"
                            data-message="@lang('message.warning_change_status_company')">
                            @lang('company.change_status')
                        </button>
                    {{ Form::close() }} --}}
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
                    {{ $tickets->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-export-excel', function (e) {
                e.preventDefault();
                var url = $(this).data('url');
                var params = $(this).data('request');
                var path = '';

                $.each(params, function(key, value) {
                    if (value) {
                        path += `${key}=${value}&`;
                    }
                });

                window.location.href = (`${url}?${path}`);
                // $.ajax({
                //     method: 'GET',
                //     url: $(this).data('url'),
                //     data: $(this).data('request')
                // });
            })
        })
    </script>
@endpush
