$(document).ready(function () {

    $('.period').on('click', set_Period);
    $('.period').first().trigger('click');

    $('#more, #more2').on('click',function(e){
        let page = $('#more').data('page');
        let skey = '';
        Load_Order(page,skey);
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


    $(document).on('click', 'button[name="inputdeli"]', async function(e) {
        let arr = [];
        //let deli = $(this).val();
        let deli = $(this).closest('tr').find('input[name="txtdel"]').val();
        if(deli!='') {
            let snval = $(this).data('sn');
            let v_status = $(this).data('status');
            arr.push({sn: snval, status: v_status, delidate: deli});

            console.log("sn:", snval, "입력값:", deli);

            let n_Step = ORDER_PROCESSING;
            let n_name = Order_Step_Name(n_Step);
            let str = JSON.stringify(arr);
            let retVal = await Order_Step_Do(str, ORDER_UNCONFIRM, ORDER_PROCESSING);
            console.log(retVal);
            if (retVal.get('status') == 'NoLogin') {
                go_login();
            } else if (retVal.get('status') == 'ok') {
                let data = retVal.get('data');
                let sn = data.sn;
                let nstep = data.n_step;
                $('#ostr1_' + sn).text(n_name);
                $('#ostr2_' + sn).text(deli);
                $('#ostr3_' + sn).text('');
                Make_Toast(n_name + " 완료 하였습니다.[배송내역에서 확인하세요.]");
            } else {
                Make_Toast(retVal.get('message'));
            }
        }else{
            Make_Toast('출하예정 날짜를 입력하세요.');
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
        if(now_status > 0){
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


function  set_Period (e) {

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

    $('#sdate').val(formatDate(startDate));
    $('#edate').val(formatDate(endDate));

}

// $('.period').click(function(e) {
//     e.preventDefault();
//     $('.period').removeClass('active');
//     $(this).addClass('active');
//
//     const today = new Date();
//     let startDate = new Date();
//     let endDate = new Date();
//
//     const periodText = $(this).text();
//
//     switch (periodText) {
//         case '오늘':
//             startDate = today;
//             endDate = today;
//             break;
//         case '1주일':
//             startDate = new Date(today);
//             startDate.setDate(today.getDate() - 6);
//             endDate = today;
//             break;
//         case '1개월':
//             startDate = new Date(today);
//             startDate.setMonth(today.getMonth() - 1);
//             startDate.setDate(startDate.getDate() + 1);
//             endDate = today;
//             break;
//         case '3개월':
//             startDate = new Date(today);
//             startDate.setMonth(today.getMonth() - 3);
//             startDate.setDate(startDate.getDate() + 1);
//             endDate = today;
//             break;
//         case '6개월':
//             startDate = new Date(today);
//             startDate.setMonth(today.getMonth() - 6);
//             startDate.setDate(startDate.getDate() + 1);
//             endDate = today;
//             break;
//         case '전체':
//             startDate = '';
//             endDate = '';
//             break;
//         default:
//             startDate = today;
//             endDate = today;
//     }
//
//     $('#sdate').val(formatDate(startDate));
//     $('#edate').val(formatDate(endDate));
// });

function Make_Option(){
    return {
        'cfcode' : $('#cfcode').val(),
        'deliStatus' : $('#deliStatus').val(),
        'page' : $('#pageArea').data('page'),
        'sdate' : $('#sdate').val(),
        'edate' : $('#edate').val(),
        'sort' : $('#sort').val(),
        'pCnt' : $('#pCnt').val()
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
            let btnstr  = (el.gd_status == 0) ? `<button type="button" class="btnType1 barBtn" name="btnOrderConfirm" data-status="${el.gd_status}" data-sn="${el.sn}" >확인</button>` : '확인완료';
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
                    <td>${el.od_regdate}</td>
                    <td>${el.gd_delidate}</td> 
                    <td id="ostr2_${el.sn}">${btnstr}</td> 
                </tr >
            `;
        });

    }else{
        html = `
            <tr><td colspan="14">주문정보가 없습니다. </td></tr>
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

async function Load_Order(page, skey) {
    try {
        start_spinner();
        let l_step = 1;
        let dataarr = {"page" : page,"skey" : skey,"step" : l_step};
        let url = APIURL + '/Load_Order_Pharm';

        let result = await Load_API(url,dataarr);
        console.log(result);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let html = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr, function (index, el) {
                    let gd_typ_str = '';
                    let gd_ptyp_str = '';
                    let delstr1 = '';
                    let delstr2 = '';

                    gd_typ_str = Order_Step_Name(el.gd_status);

                    if(el.gd_pType==1){
                        gd_ptyp_str = ORDER_TYPE_1;
                    }else if(el.gd_pType==2){
                        gd_ptyp_str = ORDER_TYPE_2 +"[" + el.gd_period + "개월]";
                    }else if(el.gd_pType==3){
                        gd_ptyp_str = ORDER_TYPE_3;
                    }

                    if(el.gd_delidate==''){
                        delstr1 = `
                        <div class="dateBox_boxzzl ">
                            <input type="text" name="txtdel" class="inputType140 datepicker datepicker1-2" placeholder="날짜 선택" readonly>
                            <i class="fa-regular fa-calendar calicon"id=""></i> 
                        </div>`;
                        delstr2 = `<button type="button" data-status="${el.gd_status}" data-sn="${el.sn}" class="btnType1" name="inputdeli">확인</button>`;
                    }else{
                        delstr1 = `${el.gd_delidate}`;
                        delstr2 = '';
                    }

                    html += `
                        <tr id="otr_${el.sn}">
                            <td id="ostr1_${el.sn}">${gd_typ_str}</td>
                            <td>${el.gd_code}</td>
                            <td>${gd_ptyp_str}</td>
                            <td>${el.od_wname}</td>
                            <td>${el.hn_name}</td>
                            <td>${el.n_value}</td>
                            <td>${el.t1_value}</td>
                            <td>${el.t2_value}</td>
                            <td>${el.w_name}</td>
                            <td>${number_format(el.gd_rPrice)}원</td>
                            <td>${number_format(el.gd_price)}원</td>
                            <td>${el.oddate}</td>
                            <td id="ostr2_${el.sn}">${delstr1}</td> 
                            <td id="ostr3_${el.sn}">${delstr2}</td>
                            <td>
                                <button type="button" class="btnType1 barBtn" onclick="barcodePreview('${el.hncode}');">
                                    <i class="fa-solid fa-barcode" onclick=""></i>
                                </button>
                            </td>
                        </tr >
                    `;
                });
            }else{
                html = '<tr><td colspan="15">주문내역이 없습니다.</td></tr>';
            }

            $('#more,#more2').data('page',result.get('data').page);
            $('#orderlist').append(html);
            initDatepickers();
        }else if(result.get('status') == 'last') {
            let tcnt = $('#orderlist tr').length;
            if(tcnt > 0) alert('마지막 입니다.');
            $('.moreListBox').css('display','none');
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

function initDatepickers() {
    $('.datepicker').each(function(index, datepicker) {
        let $datepicker = $(datepicker);

        if (!datepicker._flatpickr) {
            const options = {
                dateFormat: "Y-m-d",
                static: true,
                appendTo: $datepicker.parent()[0],
                onClose: function(selectedDates, dateStr, instance) {
                }
            };

            if ($datepicker.closest(".datepicker1-5").length > 0) {
                options.minDate = null;
            } else {
                options.minDate = "2024-01-01";
            }

            flatpickr(datepicker, options);
        }
    });

    $('.calicon').off('click').on('click', function(e) {
        e.preventDefault();
        const index = $('.calicon').index(this);
        const fp = $('.datepicker').eq(index)[0]._flatpickr;
        if (fp) fp.toggle();
    });
}


async function Order_Step_Do(o_data,ostep,nstep){
    let retMap = new Map();
    try {
        start_spinner();
        let dataarr = {"data" : o_data,"ostep" : ostep,"nstep" : nstep};
        let url = APIURL + '/Order_Step_Do';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            retMap.set('status','NoLogin');
            retMap.set('data','');
            retMap.set('message','');
        }else if(result.get('status') == 'ok') {
            let data = result.get('data');
            retMap.set('status','ok');
            retMap.set('data',data);
            retMap.set('message','');
        }else{
            retMap.set('status','error');
            retMap.set('data','');
            retMap.set('message',result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        retMap.set('status','error');
        retMap.set('data','');
        retMap.set('message','오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
    return retMap;
}

