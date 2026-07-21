$(document).ready(function(){
    $('#prn_Box').on('click',function(e){
        printWindow('org_area');
    });

    $('#btnPrnPallet').on('click',function(){
        const pacode = $(this).data('code');
        let url = '/Mypharm/statementPallet?cd=' + pacode;
        openPopup(url,1000,700,'prnPallet');
    });

});

