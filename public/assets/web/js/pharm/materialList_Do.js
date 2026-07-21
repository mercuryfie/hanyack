$(document).ready(function() {


    $('button[name="h_input"]').click(function () {
        $('#pop_addMaterial').css('display', 'block');
    });

    $('button[name="h_output"]').click(function () {
        $('#pop_outMaterial').css('display', 'block');
    });

    $('#Xbtn,#Xbtn2').on('click',function(e){
        // INI_Matching_pop();
        $('#pop_addMaterial').hide();
        $('#pop_outMaterial').hide();
    });

});
