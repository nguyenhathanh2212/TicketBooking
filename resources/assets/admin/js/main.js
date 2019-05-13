$(document).ready(function () {
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
})

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