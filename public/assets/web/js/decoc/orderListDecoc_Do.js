$(document).ready(function () {

    $('button[name="btnPeriod"]').click(function(e) {
        e.preventDefault();
        $('button[name="btnPeriod"]').removeClass('active');
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

        $('#s_date').val(formatDate(startDate));
        $('#e_date').val(formatDate(endDate));
    });

    $("#s_date , #e_date").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });

    $('#hnName').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            Ini_Form();
            $('#pageArea').data('page',1);
            Load_OrderList(Make_Option());
        }
    })

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Ini_Form();
        Load_OrderList(Make_Option());
    });

    $('#selectView').on('click', function (e) {
        $('input[name="chkproduct"]').each(function (e) {
            if ($(this).is(':checked') == false) {
                $(this).parent().parent().css('display', 'none');
            }
        });
    });

    $('#AllView').on('click', function (e) {
        $('input[name="chkproduct"]').each(function (e) {
            $(this).parent().parent().css('display', '');
        });
    });

    $('#btnOrderSearch').on('click',function(){
        Ini_Form();
        $('#pageArea').data('page',1);
        Load_OrderList(Make_Option());
    });


    $(document).on('click', 'button[name="btn_cancle"]', async function() {
        let sn = $(this).data('sn');
        if(!sn){
            Make_Toast('잘못된 접근입니다.');
            return;
        }
        if(window.confirm('해당 주문을 취소하시겠습니까?')==true){
            let params = {sn:sn};
            let response = await Model.decoc_m.Delete_Decoc_Order(params);
            let eCnt = response.effect;
            if(eCnt > 0){
                $('#gdr_' + sn).empty();
                Make_Toast('선택하신 주문을 취소하였습니다.');
            }
        }
    });

    $(document).on('click', 'button[name="btn_cart"]', async function() {
        const hncode = $(this).data('code');
        let rCountVal = $(this).data('cnt');
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

    $(document).on('click','button[name="btn_income"]',async function(){
        if(window.confirm('해당 주문을 입고처리 하시겠습니까?')==true) {
            let sn = $(this).data('sn');
            let bool = Incoming_order(sn);
            if (bool == true) {
                Make_Toast('입고 완료 하였습니다.');
            }
        }
    });

    $(document).on('click','button[name="btn_return"]',function(){
        let sn = $(this).data('sn');
        let url = DECOCURL + '/return?gd=' + sn;
        $(location).attr('href',url);
    });

    Load_OrderList(Make_Option());
});

function Make_Option(){
    return {
        'name' : $('#hnName').val(),
        'sdate' : $('#s_date').val(),
        'edate' : $('#e_date').val(),
        'cfcode' : $('#orderListDecoc').data('cf'),
        'page' : $('#pageArea').data('page'),
        'pcnt' : $('#pageArea').data('pcnt')
    }
}

function Ini_Form(){
    $('#orderListDecoc').empty();
}


async function Incoming_order(sn){
    let retval = false;
    try {
        start_spinner();
        let dataarr = {"sn": sn};
        let url = APIURL + '/Incoming_Do';
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            let busTrack = `
                    <div class="busBox flexType2  "> 
                        <i class="fa-regular fa-hourglass-half busColor1"></i>
                        <i class="fa-solid fa-receipt  busColor1"></i>
                        <i class="fa-solid fa-boxes-stacked busColor1"></i>
                        <i class="fa-solid fa-van-shuttle busColor1"></i>
                        <i class="fa-solid fa-circle-check busColor2"></i>
                    </div>
            `;
            let status_name = Order_Step_Name(4);
            $("#bus_" + sn).html(busTrack);
            $("#status_" + sn).html(status_name);
            $("#income_" + sn).remove();

            let canclestr = `<button type="button" name="btn_return" id="return_${sn}" data-sn="${sn}" class="btnType1-1 mr10 cnxlBtn">반품신청</button>`;;
            $("#cancel_" + sn).html(canclestr);
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

async function Load_OrderList(params) {
    INI_Load_Order_Decoc();
    const response = await Model.decoc_m.Load_Decoc_OrderList(params);
    console.log('old', response);
    let html = '';
    const total = response.total;
    const mTotal = response.totalRs;
    const nPage= response.nPage;
    if(total>0){
        let busTrack = '';
        let match_tag = '';
        let delidate2 = '';
        let status_str = '';
        let status_str_css = '';
        $.each(response.list, function(index, el) {
            let match_tag2 = '';
            let html_sub = '';
            let goods = el.goods;
            let cnxlBox = '';
            let goodsCount = 0;
            let delidate = '';
            let cancle = '';

            goodsCount = goods.length;
            if (goodsCount == 1) {
                let buyType_css = '';
                let item = goods[0];

                let inner_html1 = (item.gd_status == ORDER_UNCONFIRM) ? `<i class="fa-regular fa-hourglass-half busColor2"></i>` : `<i class="fa-regular fa-hourglass-half busColor1"></i>`;
                let inner_html2 = (item.gd_status == ORDER_PROCESSING) ? '<i class="fa-solid fa-receipt busColor2"></i>' : `<i class="fa-solid fa-receipt  busColor1"></i>`;
                let inner_html3 = (item.gd_status == ORDER_DELIVERY_READY) ? '<i class="fa-solid fa-boxes-stacked busColor2"></i>' : `<i class="fa-solid fa-boxes-stacked busColor1"></i>`;
                let inner_html4 = (item.gd_status == ORDER_DELIVERING) ? '<i class="fa-solid fa-van-shuttle busColor2"></i>' : `<i class="fa-solid fa-van-shuttle busColor1"></i>`;
                let inner_html5 = (item.gd_status >= ORDER_DELIVERED) ? '<i class="fa-solid fa-circle-check busColor2"></i>' : `<i class="fa-solid fa-circle-check busColor1"></i>`;

                busTrack = `
                    <div class="busBox flexType2 "> 
                        ${inner_html1}
                        ${inner_html2}
                        ${inner_html3}
                        ${inner_html4}
                        ${inner_html5}
                    </div>
                `;

                const gdStatus = Number(item.gd_status);
                const $statusStr = $(`
                        <div class="stt_str_box flexType3">
                            <p class="data">출하준비중</p>
                            <p class="data">출하확인</p>
                            <p class="data">출하완료</p>
                            <p class="data">배송중</p>
                            <p class="data">배송완료</p>
                        </div>
                    `);

                $statusStr.find('.data')
                    .eq(gdStatus)
                    .each(function () {
                        $(this)
                            .addClass('active')
                            .siblings('.data')
                            .removeClass('active');
                    });

                status_str = $statusStr.prop('outerHTML');
                cnxlBox = `
                    <div class="btnBox flexType2">
                         <button type="button" class="btnType1 mr10 fontColor1" onclick="">
                            <i class="fa-solid fa-cart-shopping "></i>
                        </button>   
                    </div>
                `;

                if(item.gd_status>=3){
                    delidate =``;
                }else if(item.diff==true){
                    delidate = '<p class=" delayed">출하지연중</p>';
                }else if(item.diff==false && item.gd_status==0) {
                    delidate =`<p class=" msg">${item.gd_delidate} 출하준비중</p>`;
                }else if(item.diff==false && item.gd_status==1){
                    delidate =`<p class=" msg">${item.gd_delidate} 출하예정</p>`;
                }else{
                    delidate =`<p class=" msg">출하완료</p>`;
                }

                let delicode = item.delicode;
                let delitype = Make_delcode_str(item.delitype);

                let delistr = '';
                if(delicode != '' && delitype != ''){
                    delistr = ` 
                        <a href="javascript://" class="delicode title mr5">송장번호:</a>
                        <a href="javascript://" class="delicode carrier mr5">${delitype}</a>
                        <a href="javascript://" class="delicode code mr5">${delicode}</a>                                     
                        <i class="fa-regular fa-copy"></i>
                       `;
                } else  {
                    delistr = ``;
                }

                if(item.gd_status==0){
                    cancle = `<button type="button" name="btn_cancle" data-sn="${item.sn}" class="btnType32 mr10 cnxlBtn" onclick="">주문취소</button>`;
                }else if(item.gd_status==1){
                    cancle = `<button type="button" name="btn_cancle" data-sn="${item.sn}" class="btnType32 mr10 cnxlBtn">주문취소</button>`;
                } else if (item.gd_status==3) {
                    cancle = `<button type="button" name="btn_income" id="income_${item.sn}" data-sn="${item.sn}" class="btnType32 mr10 cnxlBtn">입고처리</button>`;
                } else if (item.gd_status >= 4) {
                    if(item.diff2==0) {
                        cancle = `<button type="button" name="btn_return" id="return_${item.sn}" data-sn="${item.sn}" class="btnType32 mr10 cnxlBtn">반품/교환신청</button>`;
                    }
                } else {
                    cancle = ``;
                }

                let typeParts = [item.t1_value, item.t2_value];
                typeText = Join_attr_string(typeParts,'/');

                if (item.match <= 0) {
                    match_tag = `<p class="match_tag">미매칭</p>`;
                } else {
                    match_tag = `<p class="match_tag active">매칭</p>`;
                }

                html_sub = `
                    <div class="orderBox-aaa " name="block" id="gdr_${item.sn}">  
                        <div class="buyType flexType3">
                            <div class="left flexType2">
                                <p class="pharm mr10">[${item.mi_name}]</p>
                                ${match_tag}
                                <p class="h_name mr10">[${item.n_value}] ${item.hn_name} ${item.w_name}</p> 
                                <p class="type fontColor1 mr10">${typeText}</p> 
                            </div>
                            <div class="right flexType7 deli_boxe4z"> 
                                ${delistr}  
                            </div>
                        </div>
                        <div class="priceBox flexType3">
                            <div class="left flexType2">
                                <p class="status2" id="status_${item.sn}">${Order_Step_Name(item.gd_status)}</p>  
                                <p class="price ">${number_format(item.gd_price||0)}원</p>
                                <p class="count">포장단위가격:${number_format(item.gd_rPrice)}원*${item.gd_cnt}개</p>
                            </div>  
                            <div class="right flexType2">
                                <div id="cancel_${item.sn}">
                                 ${cancle}
                                 </div>
                                 <button type="button" class="btnType32 fontColor1" name="btn_cart" data-code="${item.hncode}" data-cnt="1" data-ptyp="${item.gd_pType}">
                                    <i class="fa-solid fa-cart-shopping "></i>
                                </button>   
                            </div>
                          </div>   
                          <div class="busTrack " id="bus_${item.sn}">        
                            ${busTrack}
                          </div>   
                          ${status_str}
                    </div>
                   `;
            } else if (goodsCount > 1) {
                $.each(goods, function(idx, item) {
                    const randomClass = generateRandomClassName();
                    $('#example').addClass(randomClass);

                    let inner_html1 = (item.gd_status == ORDER_UNCONFIRM) ? `<i class="fa-regular fa-hourglass-half busColor2"></i>` : `<i class="fa-regular fa-hourglass-half busColor1"></i>`;
                    let inner_html2 = (item.gd_status == ORDER_PROCESSING) ? '<i class="fa-solid fa-receipt busColor2"></i>' : `<i class="fa-solid fa-receipt  busColor1"></i>`;
                    let inner_html3 = (item.gd_status == ORDER_DELIVERY_READY) ? '<i class="fa-solid fa-boxes-stacked busColor2"></i>' : `<i class="fa-solid fa-boxes-stacked busColor1"></i>`;
                    let inner_html4 = (item.gd_status == ORDER_DELIVERING) ? '<i class="fa-solid fa-van-shuttle busColor2"></i>' : `<i class="fa-solid fa-van-shuttle busColor1"></i>`;
                    let inner_html5 = (item.gd_status >= ORDER_DELIVERED) ? '<i class="fa-solid fa-circle-check busColor2"></i>' : `<i class="fa-solid fa-circle-check busColor1"></i>`;

                    busTrack = `
                        <div class="busBox flexType2 "> 
                            ${inner_html1}
                            ${inner_html2}
                            ${inner_html3}
                            ${inner_html4}
                            ${inner_html5}
                        </div>
                    `;

                    const gdStatus = Number(item.gd_status);
                    const $statusStr = $(`
                        <div class="stt_str_box flexType3">
                            <p class="data">출하준비중</p>
                            <p class="data">출하확인</p>
                            <p class="data">출하완료</p>
                            <p class="data">배송중</p>
                            <p class="data">배송완료</p>
                        </div>
                    `);

                    $statusStr.find('.data')
                        .eq(gdStatus)
                        .each(function () {
                            $(this)
                                .addClass('active')
                                .siblings('.data')
                                .removeClass('active');
                        });

                    status_str = $statusStr.prop('outerHTML');


                    if(item.gd_status>=3){
                        delidate =``;
                    }else if(item.diff==true){
                        delidate = '<p class=" delayed">출하지연중</p>';
                    }else if(item.diff==false && item.gd_status==0) {
                        delidate =`<p class=" msg">출하준비중</p>`;
                    }else if(item.diff==false && item.gd_status==1){
                        delidate =`<p class=" msg">출하예정</p>`;
                    }else{
                        delidate =`<p class=" msg">출하완료</p>`;
                    }


                    if(item.gd_status==0){
                        cancle = `<button type="button" name="btn_cancle" data-sn="${item.sn}" class="btnType1 mr10 cnxlBtn">주문취소</button>`;
                    }else if(item.gd_status==1){
                        status_str =
                        cancle = `<button type="button" name="btn_cancle" data-sn="${item.sn}" class="btnType1 mr10 cnxlBtn">주문취소</button>`;
                    } else if (item.gd_status==3) {
                        cancle = `<button type="button" name="btn_income" id="income_${item.sn}" data-sn="${item.sn}" class="btnType1-1 mr10 cnxlBtn">입고처리</button>`;
                    } else if (item.gd_status == 4) {
                        if(item.diff2==0) {
                            cancle = `<button type="button" name="btn_return" id="return_${item.sn}" data-sn="${item.sn}" class="btnType1-1 mr10 cnxlBtn">반품/교환신청</button>`;
                        }
                    } else {
                        cancle = ``;
                    }

                    let delicode = item.delicode;
                    let delitype = Make_delcode_str(item.delitype);

                    let delistr = '';
                    if(delicode != '' && delitype != ''){
                        delistr = ` 
                            <a href="javascript://" class="delicode title mr5">송장번호:</a>
                            <a href="javascript://" class="delicode carrier mr5">${delitype}</a>
                            <a href="javascript://" class="delicode code mr5">${delicode}</a>                                     
                            <i class="fa-regular fa-copy"></i>
                                   `;
                    } else  {
                        delistr = ``;
                    }
                    if (item.match <= 0) {
                        match_tag = `<p class="match_tag">미매칭</p>`;
                    } else {
                        match_tag = `<p class="match_tag active">매칭</p>`;
                    }
                    if (item.gd_delidate) {
                        delidate2 = `<p class="date e_date">(배송 희망일 : ${item.gd_delidate})`;
                    } else {
                        delidate2 = ``;
                    }

                    let indexstr = (idx>0) ? 'hidden' : '';
                    let typeParts = [item.w_name, item.t1_value,item.t2_value];
                    typeText = Join_attr_string(typeParts,'/');
                    html_sub += `
                            <div class="orderBox-aaa mt20 ${indexstr}" name="block" id="gdr_${item.sn}">   
                                  <div class="buyType flexType3 ">
                                    <div class="left flexType2">
                                        <p class="data pharm mr10">${item.mi_name}</p> 
                                        ${match_tag}
                                        <p class="data h_name mr10"> [${item.n_value}] ${item.hn_name} 
                                        </p> 
                                        <p class="type fontColor1 mr10">${typeText}</p> 
                                    </div> 
                                    <div>${delistr}
                                    </div> 
                                  </div>
                                  <div class="priceBox flexType3">
                                    <div class="left flexType2"> 
                                        <p class="status2" id="status_${item.sn}">${Order_Step_Name(item.gd_status)}</p>  
                                        <p class="price ">${number_format(item.gd_price||0)}원</p>
                                        <p class="count">포장단위가격:${number_format(item.gd_rPrice)}원*${item.gd_cnt}개</p>
                                    </div>  
                                    <div class="right flexType2">
                                        <div id="cancel_${item.sn}">
                                        ${cancle}
                                        </div>
                                         <button type="button" class="btnType1 fontColor1" name="btn_cart" data-code="${item.hncode}" data-cnt="1" data-ptyp="${item.gd_pType}">
                                            <i class="fa-solid fa-cart-shopping "></i>
                                        </button>   
                                    </div>
                                  </div> 
                                   
                                  <div class="busTrack" id="bus_${item.sn}">        
                                    ${busTrack}
                                  </div>     
                                  ${status_str} 
                            </div>
                        `;

                });
                html_sub += `
                        <div type="button" class="decodrbb1-2-3" data-odcode="${el.od_code}">
                            <p class="odrtext">총${goodsCount}건 주문 펼쳐보기</p>
                            <i class="fa-solid fa-angle-down odrmore"></i>
                        </div>
                        `;
            } else {
                html_sub += '<p>상품이 없습니다.</p>';
            }

            html += `<div class="dec_orderli ">
                        <div class="dec_orderli1-1">
                            <div class="dec_orderli_ttl">
                                <div class="flexType2">
                                    <p class="date mr10">${el.regidate}</p>
                                    <p class="date e_date">${delidate2}</p>
                                </div>
                                    <div class="titleBox">
                                        <p class="copied title">주문번호</p>
                                        <p class="copied orderNo">${el.od_code}</p> 
                                    </div>
                            </div>
                        </div>
                        <div class="dec_orderli1-2">${html_sub}</div>
                    </div>
                    `;
        });
    }else{
        html = `<div class="orderlist_dec_con flexCol"> 
                    <p class="msg">주문 정보가 없습니다.</p> 
                    <button type="button" id="" name="" class="btnType4-1 m0a" onclick="go_smart();">스마트오더 바로가기</button>
    
                </div>
       `;

    }
    $('#orderListDecoc').append(html);

    let options = {
        page : $('#pageArea').data('page'),
        total : mTotal,
        perpage : $('#pageArea').data('pcnt'),
        bname : 'btnLinkPaging'
    }
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#pageArea').data('page',nPage);
}

$(document).on('click', '.deli_boxe4z .fa-copy', function() {
    var $box = $(this).closest('.deli_boxe4z');
    var delicode = $box.find('.code').text().trim();

    if (navigator.clipboard) {
        navigator.clipboard.writeText(delicode);
    } else {
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(delicode).select();
        document.execCommand('copy');
        tempInput.remove();
    }

    $(this)
        .removeClass('fa-copy')
        .removeClass('fa-regular')
        .addClass('fa-solid')
        .addClass('fa-check');
});


// 펼치기 버튼 클릭 시
$(document).on('click', '.decodrbb1-2-3', function() {
    var $container = $(this).closest('.dec_orderli1-2');
    var $blocks = $container.find('[name="block"]');
    var $targets = $blocks.slice(1);
    console.log('$targets is visible on first click?', $targets.is(':visible'));
    // 펼쳐져 있지 않으면 펼치기
    if ($targets.is(':visible')) {
        $targets.stop(true, true).slideUp(200).addClass('hidden');
        $(this).find('.odrtext').text(function (i, text) {
            return text.replace('접기', '펼쳐보기');
        });
        $(this).find('.odrmore').removeClass('fa-angle-up').addClass('fa-angle-down');
    } else {
        $targets.stop(true, true).removeClass('hidden').slideDown(200);
        $(this).find('.odrtext').text(function (i, text) {
            return text.replace('펼쳐보기', '접기');
        });
        $(this).find('.odrmore').removeClass('fa-angle-down').addClass('fa-angle-up');
    }
});

function INI_Load_Order_Decoc(){
    $('#orderListDecoc').empty();
}

function show_cancelOrder(){
    $('#cancelCheckPopCon').show();
}

function show_Delivery(odcode){
    $('#deliveryStatusPopCon').show();
}

function generateRandomClassName(length = 6) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for(let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * chars.length);
        result += chars.charAt(randomIndex);
    }
    return result;
}
