$(document).ready(function () {
    var form = $('.form-route');
    var validation = validateRoute(form);

    $(document).on('click', '.btn-route', function () {
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

function validateRoute(form) {
    $.validator.addMethod('valid_station', function(value, element) {
        var startStation = $('select[name=start_station_id]').val();
        var destinationStation = $('select[name=destination_station_id]').val();
        
        return startStation != destinationStation;
    }, Lang.get('message.start_station_other_destination_station'));

    $.validator.addMethod('required_dn_station', function(value, element) {
        var startStation = $('select[name=start_station_id]').val();
        var destinationStation = $('select[name=destination_station_id]').val();
        
        return startStation == 1 || destinationStation == 1;
    }, Lang.get('message.must_dn_station'));

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
                required: true,
            },
            start_station_id: {
                required: true,
                valid_station: true,
                required_dn_station: true
            },
            destination_station_id: {
                required: true,
            },
            start_time: {
                required: true,
            },
            destination_time: {
                required: true,
            },
            phone: {
                number: true,
            },
            number_preset_date: {
                required: true,
                number: true,
            },
            status: {
                required: true,
            }
        },
        messages: {
            company_id: {
                required: Lang.get('validation.required', {attribute: Lang.get('route.company')}),
            },
            start_station_id: {
                required: Lang.get('validation.required', {attribute: Lang.get('route.start_station')}),
            },
            destination_station_id: {
                required: Lang.get('validation.required', {attribute: Lang.get('route.destination_station')}),
            },
            start_time: {
                required: Lang.get('validation.required', {attribute: Lang.get('route.start_time')}),
            },
            destination_time: {
                required: Lang.get('validation.required', {attribute: Lang.get('route.destination_time')}),
            },
            phone: {
                number: Lang.get('validation.not_regex', {attribute: Lang.get('station.phone')})
            },
            number_preset_date: {
                required: Lang.get('validation.required', {attribute: Lang.get('route.number_preset_date')}),
                number: Lang.get('validation.not_regex', {attribute: Lang.get('route.number_preset_date')})
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
