$(document).ready(function () {

    $('#btnOSearch').on('click',function() {
        $('#pageArea').data('page', 1);
        Ini_Form();
        Make_Html(Make_Option());
    });

    $('#skey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            Ini_Form();
            $('#pageArea').data('page',1);
            Make_Html(Make_Option());
        }
    });

    $('.period').on('click',function(e){
        e.preventDefault();
        $('.period').removeClass('active');
        $(this).addClass('active');

        const today = new Date();
        let startDate = new Date();
        let endDate = new Date();

        const periodText = $(this).text();

        switch (periodText) {
            case '오늘':
                startDate = today;
                endDate = today;
                break;
            case '1주일':
                startDate = new Date(today);
                startDate.setDate(today.getDate() - 6);
                endDate = today;
                break;
            case '1개월':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 1);
                startDate.setDate(startDate.getDate() + 1);
                endDate = today;
                break;
            case '3개월':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 3);
                startDate.setDate(startDate.getDate() + 1);
                endDate = today;
                break;
            case '6개월':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 6);
                startDate.setDate(startDate.getDate() + 1);
                endDate = today;
                break;
            case '전체':
                startDate = '';
                endDate = '';
                break;
            default:
                startDate = today;
                endDate = today;
        }

        $('#sdate').val(startDate ? formatDate(startDate) : '');
        $('#edate').val(endDate ? formatDate(endDate) : '');
        $('#pageArea').data('page',1);
        Ini_Form();
        Make_Html(Make_Option());
    });


    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Ini_Form();
        Make_Html(Make_Option());
    });


    $("#sdate , #edate").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });


    $('#btn_cancle').on('click',function(e){
        location.reload();
    });

    $('#bnt_order_confirm').on('click',async function(e){
        let arr = [];
        $('input[name="chkorder"]:checked').each(function(){
            let v_status = $(this).data('status');
            let val = $(this).val();
            arr.push({ sn: val, status: v_status });
        });

        let o_Step = ORDER_UNCONFIRM;
        let n_Step = ORDER_PROCESSING;
        let o_name = Order_Step_Name(o_Step);
        let n_name = Order_Step_Name(n_Step);
        let Cnt = arr.length;
        if(Cnt <=0){
            Make_Toast(n_name + '으로 적용하실 주문을 선택하세요.');
        }else{
            console.log(arr);
            let filtered = arr.filter(item => item.status != o_Step);
            let fCnt = filtered.length;
            if(fCnt > 0){
                Make_Toast(`선택하신 항목중에 ${o_name} 상태가 아닌 주문이 있습니다.` );
            }else if(window.confirm(`선택하신 상품을 ${n_name}  처리 하시겠습니까?`)==true){
                let retVal = await Order_Step_Do(arr,ORDER_UNCONFIRM,ORDER_PROCESSING);
                if (retVal.get('status') == 'NoLogin') {
                    go_login();
                }else if(retVal.get('status') == 'ok') {
                    let data = retVal.get('data');
                    let arr = (data) ? data : [];
                    let rCnt = arr.length;
                    if (rCnt > 0) {
                        $.each(arr, function (index, el) {
                            $('#otr_' + el).empty();
                        });
                        $('input[name="chkorder"]').prop('checked', false);
                        $('input[name="h_chkorder"]').prop('checked', false);
                        Make_Toast("총 " + rCnt + "건 " + n_name + " 완료 하였습니다.[배송내역에서 확인하세요.]");
                    }
                }else{
                    Make_Toast(retVal.get('message'));
                }
            }
        }
    });

    $(document).on('click','button[name="btnOrderConfirm"]',async function(){
        let now_sn = $(this).data('sn');
        let now_status = $(this).data('status');

        console.log('sn=' + now_sn + ' / status=' + now_status);

        if((now_sn=='') || (now_status==='')){
            Make_Toast('잘못된 접근입니다.');
            return '';
        }
        if(now_status > 1){
            Make_Toast('이미 확인된 주문입니다.');
            return '';
        }
        if(window.confirm('주문확인 하시겠습니까?')==true){
            let params = {
                'sn' : now_sn,
                'nowstep' : ORDER_UNCONFIRM,
                'nextstep' : ORDER_PROCESSING
            }
            const response = await Model.pharm_m.Update_Pharm_OrderByStep(params);
            let effect = response.effect;
            if(effect > 0){
                Make_Toast('완료 되었습니다.');
                $('#ostr1_' + now_sn).html(Order_Step_Name(ORDER_PROCESSING));
                $('#ostr2_' + now_sn).html('확인완료');
            }
        }
    });



    $(document).on('click','button[name="PrnBarcode2"]',function(){
        const hncode = $(this).data('hncode');
        const hpcode = $(this).data('hpcode');


        let url = "/Mypharm/PrnInfo?hn=" + hncode + "&hp=" + hpcode;
        let width = 720;

        let newWindow = window.open(url, "_blank",
            `width=${width},height=600,resizable=yes,scrollbars=no`
        );

        newWindow.onload = function() {
            setTimeout(() => {
                try {
                    let docHeight = Math.max(
                        // newWindow.document.body.scrollHeight,
                        // newWindow.document.documentElement.scrollHeight,
                        newWindow.document.main.offsetHeight
                    );

                    newWindow.resizeTo(width, docHeight + 80);
                    newWindow.scrollTo(0, 0);
                } catch(e) {
                    console.log("waybill 새 창 높이 조절 불가", e);
                }
            }, 300);
        };

    });

    $(document).on('click','button[name="PrnBarcode"]',function(){
        const hncode = $(this).data('hncode');
        const hpcode = $(this).data('hpcode');


        let url = "/Mypharm/PrnInfo?hn=" + hncode + "&hp=" + hpcode;
        let width = 720;

        let newWindow = window.open(url, "_blank",
            `width=${width},height=600,resizable=yes,scrollbars=no`
        );

        newWindow.onload = function() {
            setTimeout(() => {
                try {
                    let docHeight = Math.max(
                        // newWindow.document.body.scrollHeight,
                        // newWindow.document.documentElement.scrollHeight,
                        newWindow.document.main.offsetHeight
                    );

                    newWindow.resizeTo(width, docHeight + 80);
                    newWindow.scrollTo(0, 0);
                } catch(e) {
                    console.log("waybill 새 창 높이 조절 불가", e);
                }
            }, 300);
        };

    });

    Make_Html(Make_Option());
});

function Ini_Form(){
    $('#orderList').empty();
}

function Make_Option(){
    return {
        'cfcode' : $('#cfcode').val(),
        'deliStatus' : $('#deliStatus').val(),
        'page' : $('#pageArea').data('page'),
        'sdate' : $('#sdate').val(),
        'edate' : $('#edate').val(),
        'sort' : $('#sort').val(),
        'pCnt' : $('#pCnt').val(),
        'skey' : $('#skey').val()
    }
}

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Order(params);
    console.log(response);
    let list = response.list;
    let tcnt = response.total;
    let mTotal = response.totalRs;
    let nPage = response.nPage;
    let html = '';
    if(tcnt > 0){
        $.each(list, function (index, el) {
            let pname = '';
            let gd_typ_str = '';
            let buycntstr  = (el.hn_package_type==1) ? buystr=el.defaultCnt + '개' : buystr=el.defaultCnt + 'Box';
            let btnstr  = (el.gd_status == 1) ? `<button type="button" class="btnType1 barBtn  " name="btnOrderConfirm" data-status="${el.gd_status}" data-sn="${el.sn}" >확인</button>` : '확인완료';
            gd_typ_str = Order_Step_Name(el.gd_status);
            if(el.option_str=='' || el.option_str=='-'){
                pname = el.hn_name;
            }else{
                pname = el.hn_name + '[' + el.option_str + ']';
            }
            html += `
                <tr>
                    <td id="ostr1_${el.sn}">${gd_typ_str}</td>
                    <td>${el.gd_code}</td>
                    <td>${el.decoc_name}</td>
                    <td>${pname}</td>
                    <td>${el.n_value}</td>
                    <td>${el.packageStr}</td>
                    <td>${el.w_name}</td>
                    <td>${number_format(el.gd_rPrice || 0)}원</td>
                    <td>${number_format(el.geunPrice || 0)}원</td>
                    <td>${buycntstr}</td>
                    <td>${number_format(el.totalPrice || 0)}원</td>
                    <td>-</td>
                    <td>${el.od_regdate}</td>
                    <td>${el.gd_delidate}</td> 
                    <td id="ostr2_${el.sn}">${btnstr}</td> 
                </tr >
            `;
        });
    }else{
        html = `
            <tr><td colspan="15">주문정보가 없습니다. </td></tr>
        `;
    }
    $('#orderList').append(html);
    let options = {
        page : $('#pageArea').data('page'),
        total : mTotal,
        perpage : $('#pageArea').data('pcnt'),
        bname : 'btnLinkPaging'
    }
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#pageArea').data('page',nPage);

}

