
<div class="row">
    <div class="col-md-9">
        <div class="box-body">
            <div class="form-group">
                <label for="company_id">@lang('route.company')</label>
                {{ Form::select('company_id', $companies->pluck('name', 'id') ?? '', $route->company_id ?? '',[
                    'class' => 'form-control',
                    'disabled' => isset($route->company_id),
                ]) }}
                <span for="company_id" class="error help-block"></span>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="start_station_id">@lang('route.start_station')</label>
                    {{ Form::select('start_station_id', $stations->pluck('name', 'id') ?? '', $route->start_station_id ?? '',[
                        'class' => 'form-control',
                    ]) }}
                    <span for="start_station_id" class="error help-block start-station-error"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="destination_station_id">@lang('route.destination_station')</label>
                    {{ Form::select('destination_station_id', $stations->pluck('name', 'id') ?? '', $route->destination_station_id ?? '',[
                        'class' => 'form-control',
                    ]) }}
                    <span for="destination_station_id" class="error help-block"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="start_time">@lang('route.start_time')</label>
                    {{ Form::text('start_time', $route->start_time ?? '', [
                        'class' => 'form-control time-picker',
                        'placeholder' => trans('route.start_time'),
                    ]) }}
                    <span for="start_time" class="error help-block"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="destination_time">@lang('route.destination_time')</label>
                    {{ Form::text('destination_time', $route->destination_time ?? '', [
                        'class' => 'form-control time-picker',
                        'placeholder' => trans('route.destination_time'),
                    ]) }}
                    <span for="destination_time" class="error help-block"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone">@lang('station.phone')</label>
                    {{ Form::text('phone', $route->phone ?? '', [
                        'class' => 'form-control',
                        'placeholder' => trans('station.phone'),
                    ]) }}
                    <span for="phone" class="error help-block"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="reservation">@lang('route.reservation')</label>
                    <div class="form-control" style="border: none;">
                        <input type="checkbox"
                            name="reservation"
                            class="flat-red choice-all"
                            {{ isset($route) && $route->reservation == config('setting.reservation.allow') ? 'checked' : '' }}>
                    </div>
                    <span for="reservation" class="error help-block"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="number_preset_date">@lang('route.number_preset_date')</label>
                    {{ Form::text('number_preset_date', $route->number_preset_date ?? '', [
                        'class' => 'form-control',
                        'placeholder' => trans('route.number_preset_date'),
                    ]) }}
                    <span for="number_preset_date" class="error help-block"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="direct_payment">@lang('route.direct_payment')</label>
                    <div class="form-control" style="border: none;">
                        <input type="checkbox"
                            name="direct_payment"
                            class="flat-red choice-all"
                            {{ isset($route) && $route->direct_payment == config('setting.direct_payment.allow') ? 'checked' : '' }}>
                    </div>
                    <span for="direct_payment" class="error help-block"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="status">@lang('station.status')</label>
                {{ Form::select('status', $statuses, $route->status ?? '', [
                    'class' => 'form-control',
                ]) }}
                <span for="status" class="error help-block"></span>
            </div>
        </div>
        @if (isset($route))
            <label for="status">@lang('route.bus_route')</label>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-record">
                    <tbody>
                        <tr>
                            <th>@lang('bus.lisense_plate')</th>
                            <th>@lang('main.price')</th>
                            <th>@lang('company.phone')</th>
                            <th></th>
                        </tr>
                        @php
                            unset($statuses[0]);    
                        @endphp
                            {{-- <tr>
                                <td>
                                    {{ Form::select('bus_id', $buses, Request::get('bus_id'), [
                                        'class' => 'form-control',
                                        'form' => 'form-search'
                                    ])}}
                                </td>
                                <td>
                                    {{ Form::text('price', '', [
                                        'class' => 'form-control',
                                        'placeholder' => trans('main.price'),
                                    ]) }}
                                </td>
                                <td>
                                    {{ Form::text('price', '', [
                                        'class' => 'form-control',
                                        'placeholder' => trans('company.phone'),
                                    ]) }}
                                </td>
                                <td><a class="btn btn-primary btn-xs" href="">thêm</a></td>
                            </tr> --}}
                        @forelse ($route->busRoutes as $busRoute)
                            <tr>
                                <td>{{ $busRoute->bus->lisense_plate }}</td>
                                <td>{{ $busRoute->price_format }}đ</td>
                                <td>{{ $busRoute->phone }}</td>
                                {{-- <td><a href=""><span style="color: red" class="fa fa-trash"></span></a></td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <span>@lang('message.data_not_found')</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <div class="clearfix"></div>
    <div class="box-body">
        <div class="box-footer">
            <button type="button" class="btn btn-primary btn-route">Submit</button>
        </div>
    </div>
</div>
    