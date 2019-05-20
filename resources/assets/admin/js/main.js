$(document).ready(function () {
    Lang.setLocale(document.getElementsByTagName('html')[0].getAttribute('lang'));
    if ($('input[type="checkbox"].flat-red').length) {
        $('input[type="checkbox"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    }

    if ($('input[type="radio"].flat-red').length) {
        $('input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    }

    if ($('input[type="checkbox"].minimal-red').length) {
        $('input[type="checkbox"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
    }

    if ($('input[type="radio"].minimal-red').length) {
        $('input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
    }

    if ($('.show-number-record').length) {
        $(document).on('change', '.show-number-record', function () {
            showNumberRecord($(this).val());
        })
    }

    $(document).on('ifClicked', '.choice-all', function(event) {
        var check = $(this).prop('checked') ? 'uncheck' : 'check';
        $('.choice-item').map(function() {
            $(this).iCheck(check);
        })
    })

    $(document).on('ifChanged', '.choice-item', function(event) {
        if (!event.target.checked) {
            $('.choice-all').iCheck('uncheck')
        }
    })

    if ($('.filter-list').length) {
        $(document).on('change', '.filter-list', function () {
            filterTypeRecord($(this).val());
        })
    }
    
    $(document).on('change', '.select-status', function () {
        var defaultSelected = 0;

        $(this).find('option').each(function (index, value) {
            if (value.defaultSelected) {
                defaultSelected = value.value;

                return
            }
        }); 
        
        if ($(this).val() != defaultSelected) {
            $(this).addClass('bg-change-select')
        } else {
            $(this).removeClass('bg-change-select')
        }
    })

    $(document).on('click', '.btn-delete-multy', function (event) {
        var element = $(this);
        event.preventDefault();
        var dataId = getAllChoice();

        if (!dataId.length) {
            swal({
                text: Lang.get('message.dont_select_any_item'),
                icon: "warning",
                button: "Ok!",
            });
        } else {
            $('.data-id-delete').val(JSON.stringify(dataId));

            swal({
                title: "Are you sure?",
                text: element.data('message'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((ok) => {
                if (ok) {
                    $('.form-delete-multy').submit();
                }
            });
        }
    })

    $(document).on('click', '.btn-change-multy-status', function() {
        var element = $(this);

        if (!$('.table-record .select-status.bg-change-select').length) {
            swal({
                text: Lang.get('message.dont_change_any_status'),
                icon: "warning",
                button: "Ok!",
            });
        } else {
            var dataId = [];
            
            $('.table-record .select-status.bg-change-select').each(function(index, element) {
                dataId.push({
                    id: $(element).data('id'),
                    status: $(element).val()
                });
            })
            $('.data-change-status').val(JSON.stringify(dataId));

            swal({
                title: "Are you sure?",
                text: element.data('message'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((ok) => {
                if (ok) {
                    $('.form-change-multy-status').submit();
                }
            });
        }
    })

    if ($('.textarea').length) {
        $('.textarea').wysihtml5()
    }

    if ($('.date-picker').length) {
        $('.date-picker').datetimepicker({
            format: Lang.get('main.date_format_view')
        });
    }
})

// function filterTypeRecord(number) {
//     var oldSearchValue = location.search.replace(/^\?/, '');
//     oldSearchValue = (oldSearchValue + '&').replace(/role=\d*&/ig, '').replace(/page=\d*&/ig, '').replace(/&$/, '');

//     var url = location.origin;
//     var pathName = location.pathname;

//     if (pathName != '' && pathName != '/' && pathName != 'undefined') {
//         url = url + pathName;
//     }

//     if (oldSearchValue) {
//         window.location.href = url + `?${oldSearchValue}&role=${number}`;
//     } else {
//         window.location.href = url + `?role=${number}`;
//     }
// }

function showNumberRecord(number) {
    var oldSearchValue = location.search.replace(/^\?/, '');
    oldSearchValue = (oldSearchValue + '&').replace(/size=\d*&/ig, '').replace(/page=\d*&/ig, '').replace(/&$/, '');

    var url = location.origin;
    var pathName = location.pathname;

    if (pathName != '' && pathName != '/' && pathName != 'undefined') {
        url = url + pathName;
    }

    if (oldSearchValue) {
        window.location.href = url + `?${oldSearchValue}&size=${number}`;
    } else {
        window.location.href = url + `?size=${number}`;
    }
}

function getAllChoice() {
    return $('input[name="companies_choice[]"]:checked').map(function (index, element) {
        return $(element).val();
    }).get();
}