
<div class="row">
    <div class="col-md-8">
        <div class="box-body">
            <div class="form-group">
                <label for="status">@lang('station.provincial')</label>
                {{ Form::select('provincial_id', $provincials->pluck('name', 'id') ?? '', $station->provincial_id ?? '',[
                    'class' => 'form-control',
                ]) }}
                <span for="provincial_id" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="name">@lang('station.name')</label>
                {{ Form::text('name', $station->name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('station.name'),
                ]) }}
                <span for="name" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="address">@lang('station.address')</label>
                {{ Form::text('address', $station->address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('station.address'),
                ]) }}
                <span for="address" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="phone">@lang('station.phone')</label>
                {{ Form::text('phone', $station->phone ?? '', [
                    'class' => 'form-control',
                    'placeholder' => trans('station.phone'),
                ]) }}
                <span for="phone" class="error help-block"></span>
            </div>
            <div class="form-group">
                <label for="status">@lang('station.status')</label>
                {{ Form::select('status', $statuses, $station->status ?? '', [
                    'class' => 'form-control',
                ]) }}
                <span for="status" class="error help-block"></span>
            </div>
            @if (isset($station))
                <div class="form-group">
                    <label for="status">@lang('station.companies')</label>    
                    <a class="btn btn-info btn-xs" href="{{ route('company.index', ['station_id' => $station->id]) }}">
                        {{ $station->companies_count }} @lang('station.companies')
                    </a>
                    <a class="btn btn-primary btn-xs" href="{{ route('company.create', ['station_id' => $station->id]) }}">
                        <i class="fa fa-plus"></i> @lang('station.add_company')
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-4">
        {{ Form::hidden('old_image', '', [
            'class' => 'old-image'
        ]) }}
        <div class="custom-file-container"
            data-img="{{ isset($station) ? json_encode($station->images->pluck('url')->all()) : '' }}" data-upload-id="upload-image">
            <label>Upload File <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">&times;</a></label>
            <label class="custom-file-container__custom-file" >
                <input type="file" name="images[]" class="custom-file-container__custom-file__custom-file-input" accept="*" multiple aria-label="Choose File">
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="box-body">
        <div class="box-footer">
            <button type="button" class="btn btn-primary btn-station">Submit</button>
        </div>
    </div>
</div>
