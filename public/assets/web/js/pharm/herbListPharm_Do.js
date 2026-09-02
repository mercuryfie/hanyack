$(document).ready(function() {


    $('#pop_producelog_herb #Xbtn, #pop_producelog_herb #Xbtn2').click(function () {
        $('#pop_producelog_herb').hide();
    });

    $('#pop_produce_herb #Xbtn, #pop_produce_herb #Xbtn2').click(function () {
        $('#pop_produce_herb').hide();
    });

    $('#popSetPrice #clearPrice').click(function () {
        INI_SetPrice();
    });
    $('#popSetPrice #Xbtn, #popSetPrice #Xbtn2').click(function () {
        INI_SetPrice();
        $('#popSetPrice').hide();
    });

    $('#btnSetPrice').on('click',function(){
        $('#popSetPrice').show();
        Load_SetPrice();
    });

    $('.authStatus').each(function() {
        var value = $(this).text().trim();
        if (value === "1") {
            $(this).text('반려').css('color', '#7c7c7c');
        } else if (value === "0") {
            $(this).text('미승인').css('color', 'red');
        } else if (value === "100") {
            $(this).text('승인').css('color', 'green');
        }
    });

    $('#btnMedicineReg').on('click',function(){
        go_herbReg();
    });
    
    $(document).on('click', function(e) {
        if (!$(e.target).closest('[name="bubbleBox"]').length) {
            $('[name="bubble"]').hide();
        }
    });

    $('#btnSavePrice').on('click',function(){

        // INI_SetPrice();

        let class_a = $('#class_a').val();
        let class_b = $('#class_b').val();
        let class_c = $('#class_c').val();
        let class_d = $('#class_d').val();
        let class_e = $('#class_e').val();
        let datas = {
            grade_a:class_a,
            grade_b:class_b,
            grade_c:class_c,
            grade_d:class_d,
            grade_e:class_e,
        }
        console.log(datas);


        Insert_NewPrice(datas);

    });
    $('#btnMedicinSearch').on('click',function(){
        $('#pageArea').data('page',1);
        INI_Form();
        Make_Html(Make_Option());
    });

    $('#keyword').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            $('#pageArea').data('page',1);
            INI_Form();
            Make_Html(Make_Option());
        }
    });

    $(document).on('click', '[name="bubbleBox"]', function(e) {
        let $bubble = $(this).find('[name="bubble"]');
        let visible = $bubble.is(':visible');
        $('[name="bubble"]').hide();
        if (!visible) {
            $bubble.show();
        }
        e.stopPropagation();
    });

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        INI_Form();
        Make_Html(Make_Option());
    });

    $(document).on('click','button[name="btn_isok"]',function(){
        let sn = $(this).data('sn');
        let isok = $(this).data('isok');

        console.log(sn);
        Change_Sell(sn,isok);
    });

    $(document).on('click','button[name="btnPrdList"]',function(){
        const hncode = $(this).data('hncode');
        go_prodList(hncode);
    });



    Make_Html(Make_Option());

});

function INI_SetPrice(){
    $('#class_a').val('');
    $('#class_b').val('');
    $('#class_c').val('');
    $('#class_d').val('');
    $('#class_e').val('');
}

function INI_Form(){
    $('#herbList').empty();
}

function Make_Option(){
    return {
        'page' : $('#pageArea').data('page'),
        'skey' : $('#keyword').val()
    };
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
                $('#btn_isok_' + sn).removeClass('active');
                $('#btn_isok_' + sn).data('isok',100);
            }else{
                $('#btn_isok_' + sn).addClass('active');
                $('#btn_isok_' + sn).data('isok',0);
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

function Re_approval(hncode,sn){
    if(window.confirm('재승인 요청하시겠습니까?')==true) {
        Re_APP(hncode, sn);
    }
}

async function Re_APP(hncode,sn){
    try{
        start_spinner();
        let dataarr = {"hncode" : hncode};
        let url = APIURL + '/Re_Approval';
        let result = await Load_API(url,dataarr);
        console.log(result);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            $('#app_' + sn).text('재심사요청');
            $('#app_' + sn).css('color','red');
            $('#auth_' + sn).empty();
        }else{
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function Load_SetPrice(){
    const response = await Model.pharm_m.Load_Pharm_Medicine_GPrice( );
    let list = response.list;
    let total = response.total;
    if(total > 0) {
        $('#class_a').val(list.a);
        $('#class_b').val(list.b);
        $('#class_c').val(list.c);
        $('#class_d').val(list.d);
        $('#class_e').val(list.e);

    } else {
        INI_SetPrice();
    }


}

async function Insert_NewPrice(params){
    const response = await Model.pharm_m.Insert_Pharm_Medicine_GPrice(params);
    console.log(response);
    let eff = response.effect;
    console.log(eff);
    if (eff > 0) {
        Make_Toast(eff + '건 수정 완료하였습니다');
        $('#popSetPrice').hide();
    } else {
        Make_Toast('수정 실패 혹은 변경 사항이 없습니다');

    }

}

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Medicine_All(params);
    console.log(response);
    let list = response.list;
    let tcnt = response.total;
    let mTotal = response.totalRs;
    let nPage = response.nPage;
    let html = '';
    let subhtml = '';
    let option_str = '';
    if(tcnt > 0) {
        $.each(list, function (index, el) {
            if(!el.hp_code){
                subhtml = `<td colspan="3">생산내역없음</td>`;
            }else{
                subhtml = `
                    <td>${el.defaultCnt}(${el.packageStr})</td>
                    <td>${number_format(el.geunPrice || 0)}원</td>
                    <td>${number_format(el.totalPrice || 0)}원</td>
               `;
            }
            if(el.option_str==''){
                option_str = ``;
            }else{
                option_str = `-<p class="fontType1">${el.option_str}</p>`;
            }
            html += ` 
                      <tr id="line_${el.sn}"> 
                        <td class="firstCol">${el.hn_code}</td>
                        <td><div class="flexType1">${el.hn_name}${option_str}</div></td> 
                        <td>${el.n_value}</td>
                        <td>${el.w_name}</td>
                        ${subhtml}
                        <td>${formatWeight(el.total_stock || 0)}</td>
                        <td>${formatWeight(el.optimal_stock || 0)}</td> 
                        <td><button class="btnType1 " type="button" name="btnPrdList" data-hncode="${el.hn_code}" >내역</button></td>
                        <td><button class="btnType1 editHerb" type="button" onclick="Edit_Herb('${el.hn_code}');">수정</button></td> 
                        <td>
                            <button type="button" class="btnType1 barBtn" onclick="barcodePreview('${el.hn_code}');" >
                                <i class="fa-solid fa-barcode"></i>
                            </button>
                        </td>
                        <td class="row status stock"><p class="status active">부족</td>
                        <td>
                            <label class="toggle_btn">
                                <input type="checkbox" id="toggle_vendor" checked>
                                <span class="toggle_slider"></span>
                            </label>
                        </td>
                            
                    </tr>
               `;
        });
    }else{
        html = `<tr><td colspan="15">*검색된 정보가 없습니다.</td></tr>`;
    }
    $('#herbList').append(html);
    let options = {
        page : $('#pageArea').data('page'),
        total : mTotal,
        perpage : $('#pageArea').data('pcnt'),
        bname : 'btnLinkPaging'
    }
    $('#totalRs').html(mTotal);
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#pageArea').data('page',nPage);

}


function Log_Produce_Herb(hncode){
    $('#pop_produce_herb').hide();
    $('#pop_producelog_herb').show();
    console.log(hncode);

}
function Edit_Herb(hncode){
    let url = '/Mypharm/herb_Edit?hd=' + hncode;
    $(location).attr('href',url);

}

function show_popReject() {
    const checkedItems = $('input.approvalCheckbox:checked');
    const checkedIds = checkedItems.map(function () {
        return $(this).data('id');
    }).get();

    if (checkedIds.length === 0) {
        const confirmResult = alert("nothing is selected");
        // if (confirmResult) {
        //     console.log("사용자가 확인을 눌렀습니다.");
        // } else {
        //     console.log("사용자가 취소를 눌렀습니다.");
        // }
        return;
    }

    const popupConfig = [
        {
            popup: ".itemRejectpopcon",
            closeBtn: ".itemRejectpop1-2 .close"
        }
    ];

    $.each(popupConfig, function(_, config) {
        const $popup = $(config.popup);

        $(config.closeBtn).off('click').on('click', function() {
            $popup.hide();
        });

        $(window).off('click.popup').on('click.popup', function(event) {
            if ($(event.target).is($popup)) {
                $popup.hide();
            }
        });
    });

    $('.itemRejectpopcon').show();
}


$('.itemRejectpop1-2 .confirm').on('click', async function (event) {
    event.preventDefault();
    const checkedItems = $('input.approvalCheckbox:checked');
    const checkedIds = checkedItems.map(function () {
        return $(this).data('id');
    }).get();

    // 옵션(select) 값과 textarea 값 가져오기
    const hn_type = $('.itemRejectpop1-1 #issue').val(); // select 값
    const hn_memo = $('.itemRejectpop1-1 .contents textarea').val(); // textarea 값

    $(this).prop('disabled', true);

    try {
        for (const id of checkedIds) {
            const response = await $.ajax({
                url: '/Api/isOk',
                method: 'POST',
                data: {
                    hn_code: id,
                    hn_isok: 1,
                    hn_type: hn_type,
                    hn_memo: hn_memo
                },
                dataType: 'json'
            });
            console.log(`${id} 업데이트 성공:`, response);
        }
        alert('반려되었습니다. ');
        location.reload();
    } catch (error) {
        console.error('업데이트 실패:' +  error);
        // alert('error:isok101: ' + error);
    } finally {
        $(this).prop('disabled', false);
    }
});

