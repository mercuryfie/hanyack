$(document).ready(function () {
    $(".GaugeMeter").gaugeMeter();

    $('.GaugeMeter').each(function(){
        var percent = $(this).data('used');
        if(percent >= 70){
            $(this).attr('data-color', 'red');
        }else{
            $(this).attr('data-color', 'green');
        }
    });


    $('#stock_meger').on('click', function() {
        Make_Toast('약재 재고 리스트로 이동');
    });


})