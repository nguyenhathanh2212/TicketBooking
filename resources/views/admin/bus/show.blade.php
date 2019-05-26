@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_bus')
    <small>@lang('main.detail')</small>
</h1>
@endsection

@section('main_content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('bus.bus_information')</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        @include('admin.template.notice')
        <div class="box-body">
            {{ Form::open(['class' => 'form-bus',
                'url' => route('bus.update', $bus->id),
                'method' => 'PUT',
                'data-message' => trans('message.confirm_update_bus')]) }}
                @include('admin.bus.form')
            {{ Form::close() }}
            <!-- /.row -->
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            var form = $('.form-bus');
            var validation = validateBus(form);

            $(document).on('click', '.btn-bus', function () {
                if (form.valid()) {
                    swal({
                        title: 'Are you sure?',
                        text: form.data('message'),
                        icon: 'info',
                        buttons: true,
                        dangerMode: true,
                    }).then((ok) => {
                        if (ok) {
                            form.submit();
                        }
                    });
                }
            })
        })

        function validateBus(form) {
            var validation = form.validate({
                debug: false,
                invalidHandler: function(form, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        validator.errorList[0].element.focus();
                    }
                },
                rules: {
                    company_id: {
                        required: true
                    },
                    lisense_plate: {
                        required: true
                    },
                    driver_name: {
                        required: true
                    },
                    number_of_seats: {
                        required: true,
                        number: true
                    },
                    status: {
                        required: true,
                    }
                },
                messages: {
                    company_id: {
                        required: Lang.get('validation.required', {attribute: Lang.get('route.company')}),
                    },
                    lisense_plate: {
                        required: Lang.get('validation.required', {attribute: Lang.get('bus.lisense_plate')}),
                    },
                    driver_name: {
                        required: Lang.get('validation.required', {attribute: Lang.get('bus.driver_name')}),
                    },
                    number_of_seats: {
                        required: Lang.get('validation.required', {attribute: Lang.get('bus.number_of_seats')}),
                        number: Lang.get('validation.not_regex', {attribute: Lang.get('bus.number_of_seats')})
                    },
                    status: {
                        required: Lang.get('validation.required', {attribute: Lang.get('company.status')}),
                    }
                },
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                }
            });

            return validation;
        }

    </script>
@endpush
