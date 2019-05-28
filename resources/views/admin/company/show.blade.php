@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_company')
    <small>@lang('main.detail')</small>
</h1>
@endsection

@section('main_content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('company.company_information')</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        @include('admin.template.notice')
        <div class="box-body">
            <div class="box-body">
                {{ Form::open(['class' => 'form-company',
                    'url' => route('company.update', $company->id),
                    'method' => 'PUT',
                    'enctype'=>'multipart/form-data',
                    'data-message' => trans('message.confirm_update_company')]) }}
                    @include('admin.company.form')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{ Html::script(asset('admin/js/company.js')) }}
@endpush
    