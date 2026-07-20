$(document).ready(function() {


    $('#h_input').click(function () {
        $('#pop_addMaterial').css('display', 'block');
    });

    $('#h_output').click(function () {
        $('#pop_addMaterial').css('display', 'block');
    });

    $('#Xbtn,#Xbtn2').on('click',function(e){
        // INI_Matching_pop();
        $('#pop_addMaterial').hide();
    });

});
