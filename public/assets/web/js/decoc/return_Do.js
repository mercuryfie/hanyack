$(document).ready(function () {

    $(document).on('click','#btn_plus',function(){
        let nowCnt = $('#r_count').html();
        let maxCtn = $('#r_count').data('max');
        let newCnt = 0;

        if(nowCnt >=maxCtn){
            Make_Toast('선택하신 반품 갯수가 주문갯수를 넘을수 없습니다.');
        }else{
            newCnt = parseInt(nowCnt, 10) + 1;
            $('#r_count').html(newCnt);
        }
    });

    $(document).on('click','#btn_minus',function(){
        let nowCnt = $('#r_count').html();
        let newCnt = 0;

        if(nowCnt <= 1){
            Make_Toast('최소 반품 갯수는 1개 입니다.');
        }else{
            newCnt = parseInt(nowCnt, 10) - 1;
            $('#r_count').html(newCnt);
        }
    });


    $(document).on('change', '#returnAll', function() {
        if ($(this).is(':checked')) {
            let maxCtn = $('#r_count').data('max');
            $('#r_count').html(maxCtn);
        } else {
            $('#r_count').html('1');
        }
    });

    $(document).on('click','button[name="btn_return"]',async function(){
        let sVal = $('input[name="claim"]:checked').val();
        let confirmstr = '';
        let process = 0;
        let nowCnt = $('#r_count').html();
        let maxCtn = $('#r_count').data('max');

        if(sVal==1){
            confirmstr = '해당 주문을 반품 하시겠습니까?';
            process = ORDER_RETURNING;
        }else if(sVal==2){
            confirmstr = '해당 주문을 교환 하시겠습니까?';
            process = ORDER_EXCHANGING;
        }
        if(window.confirm(confirmstr)==true) {
            let sn = $(this).data('sn');
            let nowCnt = $('#r_count').html();
            let msg = $('#txt_msg').val();

            let bool = await Return_order(sn,msg,process,nowCnt);
            if (bool == true) {
                let url = DECOCURL + "/orderList";
                Make_Toast_URL('요청하신 내용이 완료되었습니다.',url);
            }
        }
    });


});


async function Return_order(sn,msg,process,cnt){
    let retval = false;
    try {
        start_spinner();
        let dataarr = {"sn": sn,"msg":msg,"process" : process,"cnt" : cnt};
        let url = APIURL + '/Return_Do';
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            $('#gdr_' + sn).empty();
            retval = true;
        }else{
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    }catch (e) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + e + '}');
        stop_spinner();
    }
    return retval;
}

