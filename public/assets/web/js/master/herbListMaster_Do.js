$(document).ready(function() {
    Load_Herb(1, '');

    $('#XBtn,#cnxl').on('click',function(e){
        $('#eventPop').hide();
    });


    $('#eventPop').on('click', function(e){
        if (e.target === this) {
            $(this).hide();
        }
    });


    //popReject 시 버튼
    $('#btn_reject').on('click',function(e){
        let hncode = $('#btn_reject').data('hncode');
        let hntype = $('#reject_issue option:selected').val();
        let hnmemo = $('#reject_memo').val();
        if((hncode=='') ||(hntype=='') ||(hnmemo=='')){
            alert('반려 사유를 확인하세요.');
        }else {
            let dataarr = {'hncode':hncode,'hntype':hntype,'hnmemo':hnmemo}
            Reject_Do(dataarr);
        }
    });

    $('#btn_close').on('click',function(e){
        Ini_popReject();
        $('#itemRejectpop').hide();
    });

    $('#closeThum').on('click',function(e){
        Ini_popThum();
        $('#thumPopCon').remove();
    });


    $('#thumPopCon').on('click', function(e) {
        if (e.target === this) {
            $(this).remove();
        }
    });

    $('#itemRejectpop').on('click', function(e) {
        if (e.target === this) {
            $(this).remove();
        }
    });


    // about popEvent
    $('#btn_cancle').on('click',function(e){
        Ini_popEvent();
        location.reload();
    });

    $(document).on('click', '[data-remove="removeBtn"]', function() {
        Ini_popEvent();
        $(this).closest('[data-add="addEvent"]').remove();
    });


    $('#yakApprove').on('click',function(e){
        let checked = $('input[name=okCheck]:checked');
        let cnt = checked.length;
        let hncode = $('input[name=okCheck]:checked').map(function() {
            return $(this).data('id');
        }).get();
        let hnisok = $('input[name=okCheck]:checked').data('status');
        // alert(hncode);
        if (cnt <=0){
            alert('승인할 약재를 선택하세요.');
        } else {
            let imi = checked.filter(function() {
                return $(this).data('status') == 100;
            }).length > 0;
            if (imi) {
                alert('이미 승인한 약재가 포함되어 있습니다.');

            } else{
                if(window.confirm("승인하시겠습니까?")==true) {

                    let restr = '';
                    checked.each(function() {
                        if(restr==''){
                            restr = $(this).data('id');
                        }else{
                            restr += ',' + $(this).data('id');
                        }
                    });

                    let dataarr = {"hncode" : restr,"hntype" : 100};
                    Approval_Do(dataarr);
                }
            }
        }
    });

    //product_cancel 처리 버튼

    $('#yakCancel').on('click',function(e){
        let checked = $('input[name=okCheck]:checked');
        let cnt = checked.length;
        let hncode = $('input[name=okCheck]:checked').map(function() {
            return $(this).data('id');
        }).get();
        let hnisok = $('input[name=okCheck]:checked').data('status');
        // alert(hncode);
        if (cnt <=0){
            alert('승인 취소할 약재를 선택하세요.');
        } else {
            let imi = checked.filter(function() {
                return $(this).data('status') == 0;
            }).length > 0;
            if (imi) {
                alert('이미 미승인 상태인 약재가 포함되어 있습니다.');

            } else{
                if(window.confirm("승인 취소하시겠습니까?")==true) {

                    let restr = '';
                    checked.each(function() {
                        if(restr==''){
                            restr = $(this).data('id');
                        }else{
                            restr += ',' + $(this).data('id');
                        }
                    });

                    let dataarr = {"hncode" : restr,"hntype" : 0};
                    Cancel_Product_Do(dataarr);
                }
            }
        }
    });

    $('#yakReject').on('click',function(e){
        let cnt = $('input[name=okCheck]:checked').length;
        if (cnt <=0){
            alert('취소하실 약재를 선택하세요.');
        } else if(cnt > 1){
            alert('반려 처리는 한개씩 가능합니다.');
        } else{
            Ini_popReject();

            let hncode = $('input[name=okCheck]:checked').data('id');
            let isok = $('input[name=okCheck]:checked').data('status');
            if(isok==1){
                alert('이미 반려 상태 입니다.');
            }else{
                $('#btn_reject').data('hncode',hncode);
                $('#itemRejectpop').show();
            }
        }
    });


    $("#more,#more2").on("click", function (key) {
        let page = $('#more').data('page');
        Load_Herb(page,'');
    });

    $(document).on('click','button[name="btn_isok"]',function(){
        let sn = $(this).data('sn');
        let isok = $(this).data('isok');

        console.log(sn);
        Change_Sell(sn,isok);
    });


    $(document).on('click','#btnSearch',function(){
        let sname = $('#search_name').val();
        Form_ini();
        Load_Herb(1, sname);
    });

    $(document).on('keydown','#search_name',function(e) {
        if (e.key === "Enter" || e.keyCode === 13) {
            e.preventDefault(); // 폼 전송 방지 (필요시)

            let sname = $('#search_name').val();
            Form_ini();
            Load_Herb(1, sname);
        }
    });

    $(document).on('click','#btn_event',function(){
        let hncode = $('#hncode').html();
        let eType = $('#eventType').val();
        Reg_Event(hncode,eType);
    });


});

async function Reg_Event(hncode,etype){
    try {
        start_spinner();
        let url = APIURL + '/Insert_Product_Event';
        let dataarr = { "code":hncode, "etype": etype };
        let result = await Load_API(url,dataarr);
        if(result.get('status')=='NoLogin'){
            go_login();
        }else if(result.get('status')=='ok'){
            let type_str = '';
            let html = '';
            if(etype==1){
                type_str = '인기 약재';
            }else if(etype==2){
                type_str = '추천 약재';
            }else if(etype==3) {
                type_str = '신규 약재';
            }
            let hnname = $('#hnname').html();
            console.log(result.get('data').sn);
            html = ` 
                <tr id="node_${result.get('data').sn}">
                    <td class="hncode" name="hncode" >${hncode}</td>
                    <td class="hnname"  >${hnname}</td>
                    <td class="" >${type_str}</td>
                    <td class="delete">
                        <i class="fa-solid fa-xmark " name="btn_eDelete" data-code="${hncode}"></i>
                    </td> 
                </tr>
            `;
            $('#eventlist').append(html);
        }else{
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}



async function Change_Sell(sn,isok){
    try {
        start_spinner();
        let url = APIURL + '/Update_Product_isSale';
        let dataarr = { "sn":sn, "issale": isok };
        let result = await Load_API(url,dataarr);
        if(result.get('status')=='NoLogin'){
            go_login();
        }else if(result.get('status')=='ok'){
            let chkval = result.get('data').chk;
            if(chkval==100) {
                $('#btn_isok_' + sn).text('판매중');
                $('#btn_isok_' + sn).css('color', '');
                $('#btn_isok_' + sn).data('isok',100);

                $('#auth_' + sn).text('승인');
                $('#auth_' + sn).css('color', 'green');
            }else{
                $('#btn_isok_' + sn).text('판매중지');
                $('#btn_isok_' + sn).css('color', 'red');
                $('#btn_isok_' + sn).data('isok',0);

                $('#auth_' + sn).text('미승인');
                $('#auth_' + sn).css('color', 'red');
            }
        }else{
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}


async function Reject_Do(dataarr) {
    try {
        start_spinner();
        let url = APIURL + '/Update_Product_Reject';
        let result = await Load_API(url,dataarr);
        if(result.get('status')=='NoLogin'){
            go_login();
        }else if(result.get('status')=='ok'){
            location.reload();
            alert('해당 약재를 반려했습니다.');
        }else{
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function Approval_Do(dataarr) {
    try {
        start_spinner();
        let url = APIURL + '/Update_Product_IsOk';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            alert('해당 약재를 승인했습니다.');
            location.reload();
        }else{
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function Cancel_Product_Do(dataarr) {
    try {
        start_spinner();
        let url = APIURL + '/Update_Product_IsOk';
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            alert('해당 약재를 승인 취소 하였습니다.');
            location.reload();
        } else {
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

function Ini_popReject(){
    $('#reject_issue').val(0);
    $('#reject_memo').val('');
    $('#btn_reject').data('hncode','');
}

function Ini_popThum(){
    $('#thumPopCon').data('hncode','');
}

function Ini_popEvent(){
    $('[data-hncode]').data('hncode','');
    $('[data-type]').data('type','');
    $('#thumPopCon').data('hncode','');
    $('#miname').val('');
    $('#hncode').val('');
    $('#hnname').val('');
}


function INI_Form(){
    $('#herbtable').empty();
}

function imageload(fname){
    let url = '/assets/product/image/' + fname;
    $('#hn_thum').attr('src',url);
    // $('#hn_thum').src = url;
    $('#thumPopCon').show();
}

function pdfload(fname){
    let url = '/assets/product/data/' + fname;
    window.open(url);
}

function go_itemDetail(hn_code) {
    let url = '/Product/itemDetail/' + hn_code;
    window.open(url, '_blank');
}

async function setEvent(miname,hncode, hnname) {
    Form_ini2();
    try {
        start_spinner();
        let html = await setEvent_Data(hncode);
        if(html=='') {
            $('#miname').text(miname);
            $('#hncode').text(hncode);
            $('#hnname').text(hnname);
        }else{
            $('#miname').text(miname);
            $('#hncode').text(hncode);
            $('#hnname').text(hnname);
            $('#eventlist').append(html);
        }

        $('#eventPop').show();
        stop_spinner();

    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.[ERROR : ' + error + '}');
        stop_spinner();
    }
}


async function setEvent_Data(hncode){
    let html = '';
    try{
        start_spinner();
        let dataarr = {"code" : hncode};
        let url = APIURL + '/Load_ProductEvent';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            console.log(arr);
            let Cnt = arr.length;
            if(Cnt > 0){
                $.each(arr, function(index, el) {
                    console.log(el.sn);
                    console.log(el.fk_hncode);
                    console.log(el.f_type);
                    let eventTypeStr = '';
                    if (el.f_type == 1) {
                        eventTypeStr += '인기 약재';
                    } else if (el.f_type == 2) {
                        eventTypeStr += '추천 약재';
                    } else if (el.f_type == 3) {
                        eventTypeStr += '신규 약재';

                    }
                    html += `
                            <tr name="addEvent${el.sn}" id="" data-sn="">
                                <input type="hidden" name="ftype" value="${el.f_type}">
                                <input type="hidden" name="sn" value="${el.sn}">
                                <td class="herbCode" name="hncode">`+el.fk_hncode+`</td>
                                <td class="herbCode" name="hnname">`+el.fk_mdname+`</td> 
                                <td class="herbCode" name="ftypeStr"  >${eventTypeStr}</td> 
                                <td class="herbCode" onclick="delete_Event(${el.sn});">
                                <i class="fa-solid fa-xmark"></i> 
                                </td> 
                            </tr>
                            
                        `;
                });
            }
            $('#popcart').css('display','flex');
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();

    }catch(error){
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
    return html;
}

function delete_Event(sn){
    $('tr[name="addEvent' + sn + '"]').remove();
}



async function Load_Herb(page, skey) {
    try {
        start_spinner();
        let dataarr = {"page": page, "skey": skey};
        let url = APIURL + '/Load_herbList';
        let result = await Load_API(url,dataarr);
        console.log(dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if(result.get('status') == 'ok') {
            let html = '';
            let firstsn = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            console.log(arr);
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr, function (index, el) {
                    let authStatus_str = '';
                    let subimg = '';
                    let subfile = '';
                    let issale = '';
                    let hn_method_str1 = '';
                    let hn_method_str2 = '';

                    if(firstsn=='' && page > 1){
                        firstsn = el.sn;
                    }

                    if(el.hn_isok==100){
                        authStatus_str = 'style="color:green;"';
                    }else if(el.hn_isok==0){
                        authStatus_str = 'style="color:red;"';
                    }else if(el.hn_isok==1){
                        authStatus_str = 'style="color:#5c5c5c;"';
                    }

                    if(el.fname.img!='') {
                        subimg = `<i class="fa-regular fa-image" id="prevThum" name="prevThum" onclick="imageload('${el.fname.img}');"></i>`;
                    }
                    if(el.fname.data!='') {
                        subfile = `<i class="fa-regular fa-file" id="prevPDF" name="prevPDF" onclick="pdfload('${el.fname.data}');"></i>`;
                    }

                    if(el.hn_isok==100) {
                        issale=`<button type="button" name="btn_isok" id="btn_isok_${el.sn}" class="btnType1" data-sn="${el.sn}" data-isok="100" >판매중</button>`;
                    }else{
                        issale=`<button type="button" name="btn_isok" id="btn_isok_${el.sn}" class="btnType1" data-sn="${el.sn}" data-isok="0" style="color:rgba(255,0,0,0);">판매중지</button>`;
                    }

                    hn_method_str1 = `
                        <div class="subCategory flexType1">
                            <p class="buyTypeData">${number_format(el.price[0].hn_gPrice)}원</p>
                            <p class="buyTypeData">${number_format(el.price[0].hn_pPrice)}원</p>
                        </div>
                    `;

                    hn_method_str2 = `
                        <div class="subCategory flexType1">
                            <p class="buyTypeData">${number_format(el.price[1].hn_period)}개월</p>
                            <p class="buyTypeData">${number_format(el.price[1].hn_gPrice)}원</p>
                            <p class="buyTypeData">${number_format(el.price[1].hn_pPrice)}원</p>
                        </div>
                    `;

                    let ctrBtn = `<button type="button" onclick="setEvent('${el.mi_name}','${el.hn_code}','${el.hn_name}');" class="btnType1" name="ctrBTn">설정</button>`;
                    html += `
                        <tr id="line_${el.sn}">
                            <td class="giveDataid"><input type="checkbox" name="okCheck" class="approvalCheckbox column-1" data-id="${el.hn_code}" data-status ="${el.hn_isok}"></td>
                            <td class="authStatus" ${authStatus_str} id="auth_${el.sn}">${el.hn_isok_str}</td>
                            <td>${el.hn_code}</td>
                            <td>${el.mi_name}</td>
                            <td>${el.hn_name}</td>
                            <td>${el.fk_mdname}</td>
                            <td>${el.n_value}</td>
                            <td>${el.t1_value}</td>
                            <td>${el.t2_value}</td>
                            <td>${el.w_name}</td>
                            <td>${hn_method_str1}</td>
                            <td>${hn_method_str2}</td>
                            <td>${ctrBtn}</td>
                            <td>${issale}</td>
                            <td class="preview">
                                ${subimg}
                                ${subfile}
                                <i class="fa-solid fa-circle-info" onclick="go_itemDetail('${el.hn_code}');"></i>
                            </td>
                        </tr>    
                    `;
                });

                $('#more').data('page', result.get('data').page);
                $('#herbList').append(html);
                if(firstsn!=''){
                    let $targetTr = $('#line_' + firstsn); // 예: 6번째 tr
                    $targetTr.attr("tabindex", -1);
                    $('html, body').animate({scrollTop: $targetTr.offset().top}, 400);
                    firstsn = '';
                }
            }else{
                Make_Toast('마지막 입니다.');
                $('.moreListBox').css('display','none');
            }

        }else{
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

function Form_ini(){
    $('#herbList').empty();
}


function Form_ini2(){
    $('#miname').text('');
    $('#hncode').text('');
    $('#hnname').text('');
    $('#eventType').val('1');
    $('#eventlist').empty();
}