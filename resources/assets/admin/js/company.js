$(document).ready(function() {
    var upload = new FileUploadWithPreview('upload-image', {
        presetFiles: $('.custom-file-container').data('img'),
    });

    var form = $('.form-company');
    var validation = validateCompany(form);
    autoComplateUser();
    removeItem();

    $(document).on('click', '.btn-company', function () {
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
            var userManageId = $('.group-member-admin .ui-users .ui-users-item').first().data('id');
            var userEmployeeIds = [];
            $('.group-member-emplyee .ui-users .ui-users-item').map(function () {
                userEmployeeIds.push($(this).data('id'))
            });
            form.find('.super-manager').val(userManageId);
            form.find('.employee').val(JSON.stringify(userEmployeeIds));
            
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

function removeItem() {
    $(document).on('click', '.remove-user', function () {
        $(this).closest('li.ui-users-item').remove();
    })
}

function autoComplateUser() {
    $('.user-autocomplate').each(function () {
        $(this).autocomplete({
            minLength: 0,
            source: function(request, response) {
                var filterId = [];
                $('.ui-users .ui-users-item').map(function() {
                    filterId.push($(this).data('id'));
                });
                
                if ($(this.element).hasClass('user-admin-company') && $('.ui-users-admin .ui-users-item').length >= 1) {
                    response([{ limit_result: Lang.get('message.just_add_one') }]);
                } else {
                    $.ajax({
                        method: 'GET',
                        url: $(this.element).data('url'),
                        data: {
                            keyword: $(this.element).val(),
                            filter_id: filterId
                        }
                    }).done(function (data) {
                        if (data.users.data.length) {
                            response(data.users.data);
                        } else {
                            response([{ no_result: Lang.get('message.not_found')}]);
                        }

                        $('.loading-search-member').hide();
                    });
                }
            },
            select: function(event, ui) {
                if (ui.item.no_result || ui.item.limit_result) {
                    return false;
                }

                var value = `<li class="ui-users-item" data-id="${ui.item.id}" title="${ui.item.full_name}">
                                <div class="ui-users-item-wrapper">
                                    <img src="${ui.item.avatar}" class="member-avatar">
                                    <span class="name-user">${ui.item.full_name}</span>
                                    <span class="remove-user"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                </div>
                            </li>`;
                $(this).val('')
                $(this).closest('.group-member').find('.ui-users').prepend(value);
                
                return false;
            }
        }).autocomplete('instance')._renderItem = function(ul, item) {
            var value = null;

            if (item.no_result) {
                value = `<div class="no-results">${item.no_result}</div>`;
            } else if(item.limit_result) {
                value = `<div class="no-results" title="${item.limit_result}">${item.limit_result}</div>`;
            } else {
                value = `<div>
                    <img src="${item.avatar}" class="member-avatar">
                    <span class="name-user">${item.full_name}</span>
                </div>`;
            }

            return $('<li>').append(value).appendTo(ul);
        };
    })
}

function validateCompany(form) {
    $.validator.addMethod('require_admin_company', function (value) {
        return !!$('.group-member-admin .ui-users .ui-users-item').length;
    }, Lang.get('validation.required', {attribute: Lang.get('company.admin_company')}));

    $.validator.addMethod('max_admin_company', function (value) {
        return $('.group-member-admin .ui-users .ui-users-item').length == 1;
    }, Lang.get('validation.lte.array', {attribute: Lang.get('company.admin_company'), value: 1}));

    var validation = form.validate({
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
            },
            super_manager_view: {
                require_admin_company: true,
                max_admin_company: true,
            }
        },
        messages: {
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
