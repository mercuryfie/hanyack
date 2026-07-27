$(document).ready(function() {


    $('#pop_producelog_herb #Xbtn, #pop_producelog_herb #Xbtn2').click(function () {
        $('#pop_producelog_herb').hide();
    });

    $('#pop_produce_herb #Xbtn, #pop_produce_herb #Xbtn2').click(function () {
        $('#pop_produce_herb').hide();
    });

    //$('#totalprice').html('총 ' + n_price.toLocaleString() + '원');

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

    $("#keyword").on("keypress", function (key) {
        if (key.keyCode == 13) {
            INI_Form();
            let skey = $('#keyword').val();
            Load_Herb(1,skey);
        }
    });

    $("#searchherb").on("click", function (key) {
        INI_Form();
        let skey = $('#keyword').val();
        Load_Herb(1,skey);
    });

    $("#more,#more2").on("click", function (key) {

        let page = $('#more').data('page');
        let skey = $('#keyword').val();
        console.log('skey=' + skey);

        Load_Herb(page,skey);
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('[name="bubbleBox"]').length) {
            $('[name="bubble"]').hide();
        }
    });

    // 2. bubbleBox 클릭 시, 다른 bubble 닫고 자기 것만 토글
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

    Make_Html(Make_Option());
    //Load_Herb(1, '');

});

function INI_Form(){
    $('#v_list').empty();
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

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Medicine_All(params);
    console.log(response);
    let list = response.list;
    let tcnt = response.total;
    let mTotal = response.totalRs;
    let nPage = response.nPage;
    let html = '';
    if(tcnt > 0) {
        $.each(list, function (index, el) {
            html += ` 
                      <tr id="line_${el.sn}"> 
                        <td class="firstCol">${el.hn_code}</td>
                        <td>${el.hn_name}</td> 
                        <td>${el.n_value}</td>
                        <td>${el.option_str}</td>
                        <td>${el.defaultCnt}(${el.packageStr})</td>
                        <td>${el.w_name}</td>
                        <td>${number_format(el.geunPrice || 0)}원</td>
                        <td>${number_format(el.totalPrice || 0)}원</td>
                        <td>10,000g</td>
                        <td>10,000g</td> 
                        <td><button class="btnType1 " type="button" onclick="Produce_Herb('${el.hn_code}');"><i class="fa-solid fa-plus"></i></button></td>
                        <td><button class="btnType1 " type="button" onclick="go_prodList('${el.hn_code}');">재고</button></td>
                        <td><button class="btnType1 editHerb" type="button" onclick="Edit_Herb('${el.hn_code}');">수정</button></td> 
                        <td><button type="button" class="btnType1 barBtn" onclick="barcodePreview('${el.hn_code}');" >
                            <i class="fa-solid fa-barcode"></i>
                            </button>
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
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#pageArea').data('page',nPage);

}


async function Load_Herb(page, skey) {
    try {
        start_spinner();
        let dataarr = {"page" : page,'skey' : skey};
        let url = APIURL + '/Load_herbList';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let html = '';
            let arr = result.get('data').list;
            console.log(arr);
            let Cnt = arr.length;
            let firstsn = '';
            if (Cnt > 0) {
                $.each(arr, function (index, el) {

                    let authStatus_css = '';
                    let authStatus_str = '';
                    let hnTypeText = '';
                    let subHtml = '';
                    let method1 = '없음';
                    let method2 = '없음';
                    let method3 = '없음';
                    let hn_method_str1 = '';
                    let hn_method_str2 = '';
                    let hn_buyType = '';
                    let hn_buyTypeCss = '';
                    let issale  = '';


                    // if (firstsn == '') {
                    //     firstsn = el.sn;
                    // }

                    // if (el.hn_isok == 100) {
                    //     authStatus_css = 'style="color:green;"';
                    //     authStatus_str = '승인';
                    // } else if (el.hn_isok == 0) {
                    //     authStatus_css = 'style="color:red;"';
                    //     authStatus_str = '미승인';
                    // } else if (el.hn_isok == 1) {
                    //     authStatus_css = 'style="color:#5c5c5c;"';
                    //     authStatus_str = '반려';
                    // }

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

                    // if (el.hn_bigsell == 0) {
                    //     method3 = '미사용';
                    // } else {
                    //     method3 = '사용';
                    // }

                    if (el.hn_type == 1) {
                        hnTypeText = '대표이미지 미첨부';
                    } else if (el.hn_type == 2) {
                        hnTypeText = '시험성적서 미첨부';
                    } else if (el.hn_type == 3) {
                        hnTypeText = '가격 부적절';
                    } else {
                        hnTypeText = ''; // 또는 '기타'
                    }

                    // if (el.hn_isok == 1) {
                    //     subHtml = `
                    //         <td class="bubbleBox" name="bubbleBox" id="auth_${el.sn}">
                    //             <i class="fa-regular fa-comment-dots bubbleicon"></i>
                    //             <div class="bubble" name="bubble" style="display:none;"><p class="title">반려 사유: </p>
                    //                 <p class="hn_type">${hnTypeText}</p>
                    //                 <p class="hn_memo">${el.hn_memo}</p>
                    //             </div>
                    //         </td>
                    //     `;
                    // } else {
                    //     subHtml = `<td></td>`;
                    // }
                    if(el.hn_isok==100) {
                        issale = `<button type="button" class="btnType1 hideBtn" name="btn_isok" id="btn_isok_${el.sn}" data-sn="${el.sn}" data-isok="100" ><i class="fa-solid fa-ban"></i></button>`;
                    } else {
                        issale = `<button type="button" class="btnType1 hideBtn active" name="btn_isok" id="btn_isok_${el.sn}" data-sn="${el.sn}" data-isok="0" ><i class="fa-solid fa-ban"></i></button>`;
                    }

                    html += ` 
                          <tr id="line_${el.sn}"> 
<!--                            <td class=""><input type="checkbox" name="" id=""></td>-->
                            <td class="firstCol">${el.hn_code}</td>
                            <td>${el.hn_name}</td>
                            <td>${el.hn_MakeDate}</td> 
                            
                            <td>${el.hn_number}</td>
                            <td>${el.n_value}</td>
                            <td>${el.hn_optstr}</td>
                            <td>${el.w_name}</td>
                             
                            <td class="">
                                ${hn_method_str1}
                            </td>
                            <td class="">
                                ${hn_method_str2}
                            </td>
                            <td>${method3}</td>
                            <td>${el.hn_boxCnt}개</td>
                            <td><button class="btnType1 editHerb" type="button" onclick="Produce_Herb('${el.hn_code}');"><i class="fa-solid fa-plus"></i></button></td>
                            
                            <td><button class="btnType1 editHerb" type="button" onclick="Edit_Herb('${el.hn_code}');">수정</button></td>
                            <td>${issale}</td>
                            <td><button type="button" class="btnType1 barBtn" onclick="barcodePreview('${el.hn_code}');" >
                                <i class="fa-solid fa-barcode"></i>
                                </button>
                            </td>
                                
                        </tr>
                   `;
                });
                $('#herbtable').append(html);
                // if(firstsn!=''){
                //     let $targetTr = $('#line_' + firstsn); // 예: 6번째 tr
                //     $targetTr.attr("tabindex", -1);
                //     $('html, body').animate({scrollTop: $targetTr.offset().top}, 400);
                //     firstsn = '';
                // }
            } else {
                let tcnt = $('#herbtable tr').length;
                if(tcnt > 0)
                    Make_Toast('마지막입니다.');
                $('.moreListBox').css('display','none');
            }
            $('#more').data('page', result.get('data').page);

        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}



function Produce_Herb(hncode){
    $('#pop_producelog_herb').hide();
    $('#pop_produce_herb').show();
    console.log(hncode);

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

