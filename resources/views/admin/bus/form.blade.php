
<div class="row">
    <div class="col-md-8">
        <div class="box-body">
            <div class="form-group">
                <label for="company_id">@lang('route.company')</label>
                {{ Form::select('company_id', $companies->pluck('name', 'id') ?? [], $bus->company_id ?? '',[
                    'class' => 'form-control',
                    'disabled' => isset($route->company_id),
                ]) }}
                <span for="company_id" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="lisense_plate">@lang('bus.lisense_plate')</label>
                {{ Form::text('lisense_plate', $bus->lisense_plate ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('bus.lisense_plate'),
                ]) }}
                <span for="lisense_plate" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="driver_name">@lang('bus.driver_name')</label>
                {{ Form::text('driver_name', $bus->driver_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('bus.driver_name'),
                ]) }}
                <span for="driver_name" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="number_of_seats">@lang('bus.bus_type')</label>
                {{ Form::select('type_bus_id', $busTypes ?? [], $bus->type_bus_id ?? 0,[
                    'class' => 'form-control',
                ]) }}
                <span for="type_bus_id" class="error help-block"></span>
            </div>
            <div class="form-group number-of-seat" {{ isset($bus->type_bus_id) && $bus->type_bus_id > 0 ? "style='display: none'" : '' }}>
                <label for="number_of_seats">@lang('bus.number_of_seats')</label>
                {{ Form::text('number_of_seats', $bus->number_of_seats ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('bus.number_of_seats'),
                ]) }}
                <span for="number_of_seats" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="status">@lang('station.status')</label>
                {{ Form::select('status', $statuses, $bus->status ?? '', [
                    'class' => 'form-control',
                ]) }}
                <span for="status" class="error help-block"></span>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="box-body">
        <div class="box-footer">
            <button type="button" class="btn btn-primary btn-bus">Submit</button>
        </div>
    </div>
</div>
    