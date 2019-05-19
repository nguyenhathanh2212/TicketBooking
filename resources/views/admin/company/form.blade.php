
<div class="row">
    <div class="col-md-8">
        {{ Form::open(['class' => 'form-company']) }}
            <div class="box-body">
                <div class="form-group">
                    <label for="status">@lang('company.station')</label>
                    {{ Form::select('station', $stations->pluck('name', 'id'), $company->station_id ?? '', [
                        'class' => 'form-control',
                    ]) }}
                    <label for="station" class="error help-block"></span>
                </div>
                <div class="form-group">
                    <label for="name">@lang('company.name')</label>
                    {{ Form::text('name', $company->name ?? '', [
                        'class' => 'form-control',
                        'placeholder' => trans('company.name'),
                    ]) }}
                    <label for="name" class="error help-block"></span>
                </div>
                <div class="form-group">
                    <label for="address">@lang('company.address')</label>
                    {{ Form::text('address', $company->address ?? '', [
                        'class' => 'form-control',
                        'placeholder' => trans('company.address'),
                    ]) }}
                    <label for="address" class="error help-block"></span>
                </div>
                <div class="form-group">
                    <label for="phone">@lang('company.phone')</label>
                    {{ Form::text('phone', $company->phone ?? '', [
                        'class' => 'form-control',
                        'placeholder' => trans('company.phone'),
                    ]) }}
                    <label for="phone" class="error help-block"></span>
                </div>
                <div class="form-group">
                    <label for="status">@lang('main.status')</label>
                    {{ Form::select('status', $statuses, $company->status ?? '',[
                        'class' => 'form-control',
                    ]) }}
                    <label for="status" class="error help-block"></span>
                </div>
                <div class="form-group">
                    <label for="description">@lang('company.description')</label>
                    <textarea class="textarea" name="description" placeholder="Place some text here"
                        style="width: 100%; height: 200px; font-size: 14px;
                        line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $company->description ?? '' }}</textarea>
                    <label for="description" class="error help-block"></span>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        {{ Form::close() }}
    </div>
    <div class="col-md-4">
        {{-- <img class="avatar-user-detail" src="{{ $user->avatar }}" alt=""> --}}
    </div>
</div>
