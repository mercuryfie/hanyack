$(document).ready(function(){
    $('#prn_Box').on('click',function(e){
        printWindow('org_area');
    });
});


function prn_Pallet(hdcode){
    let url = '/Mypharm/statementPallet?key=' + hdcode;
    let param = "status=0,title=0,height=700,width=1000,scrollbars=1"
    window.open(url,'statementPallet',param);
}
