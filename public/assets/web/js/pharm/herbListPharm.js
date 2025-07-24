$(document).ready(function() {
    // $('.authStatus').css('color','red');
    $('.authStatus').each(function() {
        var value = $(this).text().trim();
        if (value === "1") {
            $(this).text('반려').css('color', '#7c7c7c');
        } else if (value === "0") {
            $(this).text('미승인').css('color', 'red');
        } else if (value === "100") {
            $(this).text('승인').css('color', 'green');
        }
    });



    let checkedIds = [];

    $("input[name='okCheck']").on('change', function() {
        const id = $(this).data('id');
        if ($(this).is(':checked')) {
            checkedIds.push(id);
        } else {
            checkedIds = checkedIds.filter(item => item !== id);
        }
        // console.log('hn_code:', checkedIds);
    });




});