$(document).ready(function () {
    var upload = new FileUploadWithPreview('upload-image', {
        presetFiles: $('.custom-file-container').data('img'),
    });
    var form = $('.form-station');
    var validation = validateStation(form);

    $(document).on('click', '.btn-station', function () {
        var oldImage = [];

        upload.cachedFileArray.map(function (value) {
            if(value.constructor.name == 'Blob') {
                oldImage.push(value.name);
            }
        });
        
        if (oldImage.length) {
            $('.old-image').val(JSON.stringify(oldImage));
        }

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

function validateStation(form) {
    var validation = form.validate({
        debug: false,
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus();
            }
        },
        rules: {
            provincial: {
                required: true,
            },
            name: {
                required: true,
            },
            address: {
                required: true,
            },
            phone: {
                required: true,
                number: true,
            },
            status: {
                required: true,
            }
        },
        messages: {
            provincial: {
                required: Lang.get('validation.required', {attribute: Lang.get('station.provincial')}),
            },
            name: {
                required: Lang.get('validation.required', {attribute: Lang.get('company.name')}),
            },
            address: {
                required: Lang.get('validation.required', {attribute: Lang.get('company.address')}),
            },
            phone: {
                required: Lang.get('validation.required', {attribute: Lang.get('company.phone')}),
                number: Lang.get('validation.not_regex', {attribute: Lang.get('company.phone')})
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
