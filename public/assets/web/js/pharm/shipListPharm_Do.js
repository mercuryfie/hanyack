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

    $(document).on('click', '.delicodeA', function (e) {
        e.preventDefault();
        let text = $(this).text();
        if ($(this).find('input').length > 0) return;
        let input = $('<input type="search" class="newdelicode">').val(text);
        let btn = $('button[name="btn_deli"]');
        $(this).empty().append(input);
        input.on('blur', function() {
            if (input.val().trim() === '') {
                btn.show();
            } else {
                let newtext = input.val();
                $(this).text(newtext);
                console.log('새로 입력된 text:', newtext);
            }
        });
        input.on('keydown', function(e) {
            if (e.key === 'Enter') {
                $(this).blur();
            }
        });
        New_Delicode.call(this, e);
    });

    $(document).on('click','.btnPackageDetail',async function(){
        const params = {'pcode' :  $(this).data('pcode')};
        const response = await Model.pharm_m.Load_Pharm_PackageDetail(params);
        console.log(response);
        const tcnt = response.total;
        const list = response.list;
        let html = '';
        if(tcnt > 0){
            $.each(list, function (index, el) {
                let gdstatus = '';
                let status = el.gd_status;
                if(status >= 3){
                    gdstatus = 'disabled';
                }
                html += `
                        <tr>
                            <td class="row row1">${el.pa_code}</td>
                            <td class="row row2">${el.fk_pcode}</td>
                            <td class="row row3">${el.fk_hncode}</td>
                            <td>${el.hn_name}</td>
                            <td>${el.t1_value}</td>
                            <td>${el.t2_value}</td>
                            <td>${el.t_cnt}개</td>
                            <td>${formatWeight(el.t_weight)}</td>
                            <td>${el.delidate}</td>
                        </tr>
                    `;
            });
        } else {
            html = '<td colspan="10">출하 상품 정보가 없습니다.</td>';
        }
        $('#packagelistinfo').empty();
        $('#packagelistinfo').append(html);
    });

    $(document).on('click','button[name="btnPrnDelivery"]',function(){
        const pcode = $(this).data('pcode');
        let url = '/Mypharm/statement?cd=' + pcode;
        openPopup(url,1200,800,'prnPackage');
    });

    $(document).on('click', 'button[name="btnDeliveryInput"]', async function() {
        let $row = $(this).closest('tr');
        let deliType = $row.find('select[name="delitype"]').val();
        let deliCode = $row.find('input[name="delicode"]').val();
        let pCode = $(this).data('pcode');
        if(deliType === "0") {
            alert("배송업체를 선택해주세요.");
            return;
        }
        if(!deliCode.trim()) {
            alert("송장번호를 입력해주세요.");
            return;
        }
        if(window.confirm('송장번호를 등록하시겠습니까?')==true) {
            let params = {
                pCode: pCode,
                oStep: ORDER_DELIVERING,
                pStep: PACKAGE_SHIP_START,
                deliType: deliType,
                deliCode: deliCode
            };
            const response = await Model.pharm_m.Update_Pharm_Delivery_Info(params);
            if (response.effect > 0) {
                $row.find('td[name="tdDeliType"]').html(Make_delcode_str(deliType));
                $row.find('td[name="tdDeliCode"]').text(deliCode);
                $row.find('td[name="tdDeliBtn"]').html('');
                Make_Toast('배송정보 등록이 완료 되었습니다.');
            }
        }
    });


    const today = new Date();
    $('#sdate').val(formatDate(today));
    $('#edate').val(formatDate(today));
    Make_Html(Make_Option());
});

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Package(params);
    let list = response.list;
    let tcnt = response.total;
    let mTotal = response.totalRs;
    let nPage = response.nPage;
    let html = '';
    if(tcnt > 0) {
        $.each(list, function (index, el) {
            let subHhtml = '';
            let delcode_html = '';
            let prn_html = '';

            if (el.p_type == PACKAGE_READY) {
                prn_html = `<button class="btnType1-2 h32" type="button" name="btnPrnDelivery" data-pcode="${el.pcode}" >출력</button>`;
                subHhtml = `
                            <td name="tdDeliType"></td>
                            <td name="tdDeliCode"></td>
                            <td name="tdDeliBtn"></td>
                            `;
            }else if (el.p_type == PACKAGE_SHIP_READY) {
                delcode_html = Make_delcode(el.sn,1);
                subHhtml = `
                            <td name="tdDeliType" class="row">${delcode_html}</td>
                            <td name="tdDeliCode" class="row deli_btn"><input type="text" name="delicode"  placeholder="송장번호 입력" class="inputType1"></td>
                            <td name="tdDeliBtn"><button class="btnType1 h32" type="button" name="btnDeliveryInput"  data-pcode="${el.pcode}" >송장입력</button></td>
                        `;
                prn_html = `<button class="btnType10-1 h32" type="button" name="btnPrnDelivery"  data-pcode="${el.pcode}">재출력</button>`;
            }else if (el.p_type == PACKAGE_SHIP_START) {
                subHhtml = `
                            <td name="tdDeliCode" class="row">${Make_delcode_str(el.delitype)}</td>
                            <td name="tdDeliCode" class="row deli_btn"><a href="#" role="button" class="delicodeA">${el.delicode}</a></td>
                            <td name="tdDeliBtn"></td>
                        `;
                prn_html = `<button class="btnType10-1 h32" type="button" name="btn_print" id="btn_print_${el.sn}" onclick="Prn_Package('${el.pcode}')">재출력</button>`;
            }

            html += `
                <tr>
                    <td class="">${Package_Step_Name(el.p_type)}</td>
                    <td class="row row2"><a href="javascript:void(0);" class="btnPackageDetail" data-pcode="${el.pcode}">${el.pcode}</a></td>
                    <td>${el.cfname}</td>
                    <td>${el.t_cnt}개</td>
                    <td>${formatWeight(el.t_weight)}</td>
                    ${subHhtml}
                    <td>${prn_html}</td>
                    <td>${el.pa_regdate}</td>
                </tr>    
            `;
        });
    }else{
        html = '<td colspan="10">검색된 정보가 없습니다.</td>';
    }

    $('#packagelist').append(html);
    let options = {
        page : $('#pageArea').data('page'),
        total : mTotal,
        perpage : $('#pageArea').data('pcnt'),
        bname : 'btnLinkPaging'
    }
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#pageArea').data('page',nPage);

}


function Ini_Form(){
    $('#packagelist').empty();
    $('#packagelistinfo').empty();
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

async function Insert_delicode(deltype,delcode,pcode){
    try {
        start_spinner();
        let dataarr = {"deliType": deltype,"deliCode": delcode,"pCode": pcode};
        let url = APIURL + '/Insert_Package_Deli_Data';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            location.reload();
            console.log(result);
        } else {
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function Update_Delicode(newdelicode, td, text){
    try {
        start_spinner();
        let dataarr = {"newdelicode": newdelicode, "td":td, "text":text};
        let url = APIURL + '/Update_Delicode';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if(result.get('status') == 'ok') {
            td.text(newdelicode); // 성공 시 td에 새 값 반영
            console.log(result);
        } else {
            alert(result.get('message'));
            td.text(text); // 실패 시 원래 값 복구
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + ']');
        td.text(text); // 실패 시 원래 값 복구
        stop_spinner();
    }
}



function Insert_Package(sn,pcode){
    let delitype =  $('#delitype_' + sn).val();
    let delicode = $('#delicode_' + sn).val();

    if((delitype=='') || (delitype=='0')){
        alert('발송타입을 선택하세요.');
    }else if(delicode==''){
        alert('송장번호를 입력하세요');
    }else if(window.confirm('송장번호를 입력하시겠습니까?')==true){
        Insert_delicode(delitype,delicode,pcode);
    }

}

