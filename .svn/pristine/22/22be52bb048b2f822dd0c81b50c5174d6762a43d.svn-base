$(document).ready(function() {
    let checkedIds = [];
    $("input[name='okCheck']").on('change', function() {
        const id = $(this).data('id');
        if ($(this).is(':checked')) {
            checkedIds.push(id);
        } else {
            checkedIds = checkedIds.filter(item => item !== id);
        }
        console.log('hn_code:', checkedIds);
    });

    $('.selectAll').on('change', function() {
        var columnClass = '.column-' + $(this).data('column');
        $(columnClass).prop('checked', $(this).is(':checked'));
    });

    $('.itemFilter').on('click', function() {
        $('.itemFilter').removeClass('periodSelected');
        $(this).addClass('periodSelected');
    });
});