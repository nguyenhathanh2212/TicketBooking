@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_company')
    <small>@lang('main.create')</small>
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
        <div class="box-body">
            @include('admin.company.form')
            <!-- /.row -->
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var form = $('.form-company');
            var validator = form.validate({
                debug: false,
                invalidHandler: function(form, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        validator.errorList[0].element.focus();
                    }
                },
                rules: {
                    name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: Lang.get('validation.required', {attribute: Lang.get('company.name')}),
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                }
            });

            // form.valid();
        })
    </script>
@endpush
