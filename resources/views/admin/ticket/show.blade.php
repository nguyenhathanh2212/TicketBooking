@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_tickets')
    <small>@lang('main.detail')</small>
</h1>
@endsection

@section('main_content')
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">@lang('user.user_information')</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form role="form" class="form-ticket">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email">@lang('ticket.name')</label>
                            {{ Form::text('name', $ticket->name, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('ticket.email')</label>
                            {{ Form::text('email', $ticket->email, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="phone">@lang('ticket.phone')</label>
                            {{ Form::text('phone', $ticket->phone, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="status">@lang('main.status')</label>
                            {{ Form::text('status', $ticket->status_str, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="quantity">@lang('ticket.quantity')</label>
                            {{ Form::text('quantity', $ticket->quantity .  ' (' . implode(', ', json_decode($ticket->seat_number)) . ')', [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="payment_method">@lang('ticket.payment_method')</label>
                            {{ Form::text('payment_method', $ticket->payment_method_str, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="date_away">@lang('ticket.date_away')</label>
                            {{ Form::text('date_away', $ticket->date, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="date_away">@lang('main.route')</label>
                            {{ Form::text('date_away', $ticket->busRoute->route->name_route, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="lisense_plate">@lang('ticket.lisense_plate')</label>
                            {{ Form::text('lisense_plate', $ticket->busRoute->bus->lisense_plate, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="start_place">@lang('ticket.start_place')</label>
                            {{ Form::text('start_place', $ticket->start_place ?? $ticket->busRoute->route->start_station_name, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="destination_place">@lang('ticket.destination_place')</label>
                            {{ Form::text('destination_place', $ticket->destination_place ?? $ticket->busRoute->route->destination_station_name, [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="total_price">@lang('ticket.total_price')</label>
                            {{ Form::text('total_price', $ticket->price_format . 'đ', [
                                'class' => 'form-control',
                                'readonly' => true,
                            ]) }}
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
@endsection
