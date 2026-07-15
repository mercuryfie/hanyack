$(document).ready(function () {

    $('.shareBox .linkcopy').click(function() {
        var url = window.location.href;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(url).then(function() {
                Make_Toast('URL이 복사되었습니다');
            }, function() {
                Make_Toast('복사에 실패했습니다');
            });
        } else {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            document.execCommand("copy");
            $temp.remove();
            Make_Toast('URL이 복사되었습니다');
        }
    });

    $('#btnLike').on('click',async function(){
        let code = $(this).data('code');
        let act = $(this).data('act');
        let params = {code:code,act:act};
        let response = await Model.decoc_m.Process_Herb_Like(params);
        if(response.effect > 0){
            if(act==1){
                $(this).addClass('active');
                $(this).find('.wishHeart').removeClass('fa-regular').addClass('fa-solid fa-heart wishHeart active');
                $(this).data('act',2);
            }else{
                $(this).removeClass('active');
                $(this).find('.wishHeart').removeClass('active fa-solid').addClass('fa-regular fa-heart wishHeart');
                $(this).data('act',1);
            }
        }
    });

    $('#btnAddCart').on('click',async function(){
        const hncode = $(this).data('code');
        var countText = $('#price_cnt').text();
        var rCountVal = parseInt(countText, 10);
        if(window.confirm('장바구니에 담으시겠습니까?')==true) {
            let params = {code: hncode, cnt: rCountVal};
            let response = await Model.decoc_m.Insert_Decoc_Cart(params);
            if(response.effect > 0){
                if(window.confirm("완료 하였습니다.\n장비구니로 이동하시겠습니까?")==true){
                    go_cart();
                }
            }
        }
    });

    $('#btnBuyPlus').on('click', function() {
        const currentDisplay = parseInt($('#price_cnt').text(), 10);
        const dCnt = parseInt($(this).attr('data-dCnt'), 10) || 1;
        const newDisplay = currentDisplay + 1;
        const newTotalCnt = newDisplay * dCnt;

        $('#price_cnt').text(newDisplay);
        $('#price_cnt').attr('data-totalCnt', newTotalCnt);

        updateTotalPrice(newTotalCnt, $(this).attr('data-uPrice'));
    });

    $('#btnBuyMinus').on('click', function() {
        const currentDisplay = parseInt($('#price_cnt').text(), 10);
        const dCnt = parseInt($(this).attr('data-dCnt'), 10) || 1;
        const newDisplay = currentDisplay - 1;
        if (newDisplay < 0) {
            return;
        }
        const newTotalCnt = newDisplay * dCnt;
        $('#price_cnt').text(newDisplay);
        $('#price_cnt').attr('data-totalCnt', newTotalCnt);
        updateTotalPrice(newTotalCnt, $(this).attr('data-uPrice'));
    });



    $(document).on('click','button[name="btnBuy"]',async function(){
        const hncode = $(this).data('code');
        const rcnt = parseInt($('#price_cnt').text(), 10) || 0;
        const delidate = $('#deliDate').val();
        if(hncode==''){
            Make_Toast('잘못된 접근입니다.');
            return;
        }
        if((rcnt==0) || (rcnt=='')){
            Make_Toast('주문수량을 확인하여주세요.');
            return;
        }
        if(window.confirm('주문하시겠습니까?')==true) {
            const params = {code:hncode,cnt:rcnt,delidate:delidate};
            let response = await Model.decoc_m.Add_Decoc_OrderByList(params);
            if (response.effect > 0) {
                if(window.confirm("완료 하였습니다.\n주문내역으로 이동하시겠습니까?")==true){
                    //go_orderList();
                }
            }
        }
    });


    $('#deliDate').val(fnToDay());

    $("#deliDate").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });
});


function updateTotalPrice(totalCnt, unitPrice) {
    const uPrice = parseInt(unitPrice, 10) || 0;
    const totalPrice = totalCnt * uPrice;
    $('#totalprice').text(totalPrice.toLocaleString());
    $('#totalprice').attr('data-tprice', totalPrice);
}





