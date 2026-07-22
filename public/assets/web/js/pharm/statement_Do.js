$(document).ready(function () {
    Prn_Barcode();

    $(document).on('click','#applyPrintBtn',async function(e){
        let ptype = $('#applyPrintBtn').data('ptype');
        if(ptype==1){
            if(window.confirm('해당 작업내역을 출력 하시겠습니까?')==true) {
                let pcode = $('#applyPrintBtn').data('pcode');
                if (pcode == '') {
                    Make_Toast('잘못된 접근입니다.');
                } else {
                    let params = {
                        pcode:pcode,
                        ostep:ORDER_DELIVERY_READY,
                        pstep:PACKAGE_SHIP_READY
                    };
                    const response = await Model.pharm_m.Update_Pharm_Delivery_Info(params);
                    if(response.effect > 0){
                        opener.location.reload();
                        printWindow('org_area');
                    }
                }
            }
        }else {
            if (window.confirm('해당 작업을 재출력 하시겠습니까?') == true) {
                printWindow('org_area');
            }
        }
    });

    $('.prnBox').on('click',function(){
        const code=$(this).data('code');
        let url = '/Mypharm/statementBox?cd=' + code;
        openPopup(url,700,500,'sboxprn');
    });

});


function Prn_Barcode() {
    let pcode = $("#barcodeDiv").data("pcode");
    JsBarcode("#barcodeDiv", pcode, {format: "CODE39",width: 1.8,height:60, displayValue: false});
    $("#barcodeDiv").css("overflow", "hidden");
    $("#barcodeDiv").css("margin", "0 auto");
    $("#barcodeDiv").css("display", "flex");
    $("#barcodeDiv").css("justifyContent", "center");
    $("#barcodeDiv").css("width", "320px");
}
