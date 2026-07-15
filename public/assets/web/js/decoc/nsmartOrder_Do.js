$(document).ready(function(){
    $(document).on('click','button[name="pCnt"]', function() {
        $(this).addClass('active').siblings().removeClass('active');
        $('#pageArea').data('page',1);
        Make_Html(Make_Option());
    });

    $('#oby').on('change',function(){
        $('#pageArea').data('page',1);
        Make_Html(Make_Option());
    });

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Make_Html(Make_Option());
    });

    $(document).on('click', 'i[name="btn_minus"], i[name="btn_plus"]', function() {
        const $buyBox = $(this).closest('.buy_box');
        const $countEl = $buyBox.find('[name="r_count"]');
        const $totalEl = $buyBox.find('[name="r_total"]');
        let count = parseInt($countEl.text()) || 0;
        const price = parseInt($countEl.data('price')) || 0;
        if ($(this).hasClass('fa-minus')) {
            count = (count > 1) ? count - 1 : 1;
        } else {
            count += 1;
        }
        $countEl.text(count);
        $countEl.attr('data-rcnt', count);
        $countEl.data('rcnt', count);
        const totalPrice = count * price;
        const formattedPrice = number_format(totalPrice);
        $totalEl.text('총 ' + formattedPrice + '원').attr('data-tprice', totalPrice);
    });

    $(document).on('click','button[name="popBuy"]',async function(){
        Ini_Buy_Pop();

        const cfcode = $('#cList').data('cfcode');
        const mm_medicine = $(this).data('mmcode');
        const medicode = $(this).data('medicode');
        const stock = $(this).data('stock') || 0;
        const stock_week = $(this).data('week') || 0;
        const stock_month = $(this).data('month') || 0;
        const title = $(this).data('title');

        $('#pbuy_title').text(title + ' 구입');
        $('#pbuy_title').data('mmcode',mm_medicine);
        $('#pbuy_title').data('medicode',medicode);
        $('#pbuy_title').data('cfcode',cfcode);

        $('#stock_week').text(number_format(stock_week || 0)+'g');
        $('#stock_week').data('val',(stock_week || 0));
        $('#stock_month').text(number_format(stock_month || 0)+'g');
        $('#stock_month').data('val',(stock_month || 0));
        $('#stock').text(number_format(stock || 0)+'g');
        $('#stock').data('val',(stock || 0));

        const params1 = {
            cfcode : cfcode,
            mm_medicine : mm_medicine
        };
        Make_Buy_Product(params1);
        let params2 = {
            cfcode : cfcode,
            code:mm_medicine,
            medicode:medicode,
            mm_medicine:mm_medicine
        };
        Make_Match_Html(params2);

        stopScroll();
        $('#pop_buy_item').show();
    });


    let org_manage = 1;
    let onchangecnt = 0;
    $(document).on('click', 'i[name="pop_SO_manage"]', function () {
        Ini_Manage_Pop();
        const sn = $(this).data('sn');
        const title = $(this).data('title');
        const ismanage = $(this).data('managed');
        const opstock = $(this).data('opstock');
        if(ismanage==1){
            $('#btnIDManage1').addClass('active')
            $('#btnIDManage2').removeClass('active');
        }else{
            $('#btnIDManage2').addClass('active')
            $('#btnIDManage1').removeClass('active');
        }
        org_manage = ismanage;
        $('#decoc_sn').val(sn);
        $('#p_so_title').text(title + ' 약제관리');
        $('#opstock').val(opstock);
        $('#SO_manage_wrap').show();
    });

    $('#btnOpStock').on('click',async function(){
        const opstock = $('#opstock').val();
        const sn = $('#decoc_sn').val();
        if(opstock==''){
            Make_Toast('수정하실 적정재고량을 입력하세요.');
            $('#opstock').focus();
            return;
        }
        let params = {optimal_stock:opstock,sn:sn};
        let response = await Model.decoc_m.Update_Decoc_Info(params);
        if(response.effect > 0){
            $('#op_' + sn).text((number_format(opstock) + 'g'));
            $('#op1_' + sn).data('opstock',opstock);
        }
    });

    $(document).on('click','button[name="btnIsManage"]',async function(){
        const ismanage = $(this).data('val');
        const sn = $('#decoc_sn').val();
        if(org_manage!=ismanage){
            let params = {is_manage:ismanage,sn:sn};
            let response = await Model.decoc_m.Update_Decoc_Info(params);
            if(response.effect > 0){
                onchangecnt = response.effect;
            }
        }
        if(ismanage==1){
            $('#btnIDManage1').addClass('active')
            $('#btnIDManage2').removeClass('active');
        }else{
            $('#btnIDManage2').addClass('active')
            $('#btnIDManage1').removeClass('active');
        }
        org_manage = ismanage;
    });

    $('#SO_manage_wrap #Xbtn, #SO_manage_wrap #Xbtn2').click(function () {
        if(onchangecnt > 0){
            $('#cList').empty();
            $('#pageArea').data('page', 1);
            Make_Html(Make_Option());
        }
        $('#SO_manage_wrap').hide();
    });

    $('#pop_buy_item #Xbtn, #pop_buy_item #Xbtn2').click(function () {
        startScroll();
        $('#pop_buy_item').hide();
    });

    $('#matchingpop #Xbtn, #matchingpop #Xbtn2').click(function () {
        $('#matchingpop').hide();
    });

    $('#btnHSearch, #btnHSSearch').on('click',function(){
        let SearchStr = '';
        if($(this).attr('id')=='btnHSearch'){
            SearchStr = $('#h_sKey').val();
        }else{
            SearchStr = $('#h_sSKey').val();
        }
        Search_Herb(SearchStr);
    });

    $('#h_sKey,#h_sSKey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            const SearchStr = $(this).val();
            Search_Herb(SearchStr);
        }
    })

    $('#txtMatchPopSearch').on('focusin',function(){
        $('#resSearch').empty();
        $('#resSearch').hide();
        $('#txtMatchPopSearch').removeClass('active');
        $('#txtMatchPopSearch').addClass('active2');
        $('#txtMatchPopSearch').val('');
    });

    $('#txtMatchPopSearch').on('focusout',function(e){
        if (e.relatedTarget && $(e.relatedTarget).closest('#resSearch').length > 0) {
            return;
        }
        $('#resSearch').empty();
        $('#resSearch').hide();
        $('#txtMatchPopSearch').removeClass('active');
        $('#txtMatchPopSearch').addClass('active2');
        $('#txtMatchPopSearch').val('');
    });


    $('#btnMatchPopSearch').on('click',function(){
        Make_Match_Search_Html();
    });

    $('#txtMatchPopSearch').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            Make_Match_Search_Html();
        }
    });

    $(document).on('click','button[name="btnMatchOff"]',async function(){
        const typ = $(this).data('typ');
        const sn = $(this).data('sn');
        const cfcode = $('#pbuy_title').data('cfcode');
        const mm_medicine = $('#pbuy_title').data('mmcode');
        const medicode = $('#pbuy_title').data('medicode');
        if((typ=='') || (cfcode=='') || (sn=='')){
            Make_Toast('필수 항목을 확인하세요.');
            return;
        }
        if(window.confirm('해제 하시겠습니까?')!=true){
            return;
        }
        let params = {typ : typ,cfcode : cfcode,sn : sn,mm_medicine:mm_medicine};
        let res = await Model.decoc_m.Update_Medicine_Decoc_Match(params);
        if(res.result=='ok'){
            let eCnt = res.eCnt;
            $('#txtMatchPopSearch').val('');
            $('#resSearch').empty();
            $('#resSearch').hide();
            $('#resMatching').empty();
            $('#productList').empty();

            const params1 = {cfcode : cfcode,mm_medicine : mm_medicine};
            Make_Buy_Product(params1);
            let params2 = {cfcode: cfcode, code: mm_medicine, medicode: medicode};
            Make_Match_Html(params2);
        }
    });

    $(document).on('click','button[name="btnMatchOn"]',async function() {
        const typ = $(this).data('typ');
        const hncode = $(this).data('hncode');
        const hntitle = $(this).data('hntitle');
        const cfcode = $('#pbuy_title').data('cfcode');
        const mm_medicine = $('#pbuy_title').data('mmcode');
        const medicode = $('#pbuy_title').data('medicode');

        if ((typ == '') || (cfcode == '') || (hncode == '') || (hntitle == '')) {
            Make_Toast('필수 항목을 확인하세요.');
            return;
        }
        if (window.confirm('매칭 하시겠습니까?') != true) {
            return;
        }

        let params = {typ: typ, cfcode: cfcode, hncode: hncode, hntitle: hntitle, mm_medicine: mm_medicine};
        let res = await Model.decoc_m.Update_Medicine_Decoc_Match(params);
        if (res.result=='ok') {
            $('#txtMatchPopSearch').val('');
            $('#resSearch').empty();
            $('#resSearch').hide();
            $('#resMatching').empty();
            $('#productList').empty();

            $('#txtMatchPopSearch').removeClass('active');
            $('#txtMatchPopSearch').addClass('active2');

            const params1 = {cfcode : cfcode,mm_medicine : mm_medicine};
            Make_Buy_Product(params1);
            let params2 = {cfcode: cfcode, code: mm_medicine, medicode: medicode};
            Make_Match_Html(params2);
        }
    });

   $(document).on('click','button[name="btnAddCart"]',async function(){
       const hncode = $(this).data('code');
       const $row = $(this).closest('.item_wrap');
       const rCountVal = $row.find('[name="r_count"]').data('rcnt');
       if(rCountVal<=0){
           Make_Toast('주문 수량을 확인하여주세요.');
       }else if(window.confirm('장바구니에 담으시겠습니까?')==true) {
           let params = {code: hncode, cnt: rCountVal};
           let response = await Model.decoc_m.Insert_Decoc_Cart(params);
           if(response.effect > 0){
               if(window.confirm("완료 하였습니다.\n장비구니로 이동하시겠습니까?")==true){
                   go_cart();
               }
           }
       }
   });

   $(document).on('click','button[name="btnBuy"]',async function(){
       const hncode = $(this).data('code');
       const rcnt = $(this).closest('tr').find('[name="r_count"]').data('rcnt');
       if(hncode==''){
           Make_Toast('잘못된 접근입니다.');
           return;
       }
       if((rcnt==0) || (rcnt=='')){
           Make_Toast('주문수량을 확인하여주세요.');
           return;
       }


       if(window.confirm('주문하시겠습니까?')==true) {
           const params = {code:hncode,cnt:rcnt};
           let response = await Model.decoc_m.Add_Decoc_OrderByList(params);
           if (response.effect > 0) {
               Make_Toast('주문완료 하였습니다.');
           }
       }
   });
    Make_Html(Make_Option());
});

function Search_Herb(SearchStr) {
    $('#cList').empty();
    $('#pageArea').data('page', 1);
    Make_Html(Make_Option(SearchStr));
}


function Make_Option(SearchStr){
    let params = {
        cfcode : $('#cList').data('cfcode'),
        pCnt : $('button[name="pCnt"].active').data('pval'),
        opt : $('#oby').val(),
        page : $('#pageArea').data('page'),
        sStr : SearchStr
    };
    return params;
}


async function Make_Html(params){
    const response = await Model.decoc_m.Load_Medicine_decoc(params);
    console.log(response);
    let html = '';
    let subHtml = '';
    const total = response.total;
    const mTotal = response.totalRs;
    const nPage= response.nPage;
    if(total>0) {
        $.each(response.list, function (index, el) {
            if(el.is_manage==1) {
                subHtml = (!el.stock_status) ? `<div class="flexType1"><p class="red">재고부족</p><i class="fa-solid fa-pen" id="op1_${el.sn}" name="pop_SO_manage" data-managed="${el.is_manage}" data-opstock="${el.optimal_stock}" data-title="${el.mm_title}" data-sn="${el.sn}"></i></div>` : `<div class="flexType1"><p class="green">정상</p><i class="fa-solid fa-pen" id="op1_${el.sn}" name="pop_SO_manage" data-managed="${el.is_manage}" data-opstock="${el.optimal_stock}" data-title="${el.mm_title}" data-sn="${el.sn}"></i></div>`;
            }else{
                subHtml = '미관리';
            }
            html += `
                    <tr>  
                        <td class=""><div class="flexType1"><p class="mr10">${el.mm_title}</p></div></td>
                        <td>${el.mm_medicine}</td>
                        <td>${number_format(el.totalStock)}g</td>
                        <td>${number_format(el.stock)}g</td>
                        <td>${number_format(el.stock_ware)}g</td>
                        <td>${number_format(el.stock_week)}g</td>
                        <td>${number_format(el.stock_month)}g</td>
                        <td id="op_${el.sn}">${number_format(el.optimal_stock)}g</td>
                        <td class="stock_status">${subHtml}</td>
                        <td><button class="bestpri btntype2" type="button" name="popBuy" data-medicode="${el.medicode}" data-mmcode="${el.mm_medicine}" data-week="${el.stock_week}" data-stock="${el.totalStock}" data-month="${el.stock_month}" data-title="${el.mm_title}">구입</button></td>
                    </tr>
            `;
        });
    }else{
        html =`<tr><td colspan="11">검색된 약재정보가 없습니다.</td></tr>`;
    }

    let options = {
        page : $('#pageArea').data('page'),
        total : mTotal,
        perpage : $('button[name="pCnt"].active').data('pval'),
        bname : 'btnLinkPaging'
    }
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#totalRs').text(number_format(mTotal || 0));
    $('#cList').empty();
    $('#cList').append(html);
    $('#pageArea').data('page',nPage);
}


function Ini_Buy_Pop(){
    $('#pbuy_title').text('');
    $('#pbuy_title').data('mmcode','');
    $('#pbuy_title').data('medicode','');
    $('#pbuy_title').data('cfcode','');
    $('#txtMatchPopSearch').val('');
    $('#stock_week').text('');
    $('#stock_week').data('val','');
    $('#stock_month').text('');
    $('#stock_month').data('val','');
    $('#productList').empty();
    $('#resMatching').empty();
}

function Ini_Manage_Pop(){
    $('#decoc_sn').val('');
    $('#opstock').val('');
    org_manage = 1;
    onchangecnt = 0;
}


async function Make_Match_Html(params){
    let response = await Model.decoc_m.Load_Medicine_Decoc_Match(params);
    console.log(response);
    let matchingCnt =  response.matchingCnt;
    let matchingHtml = response.matching;
    if(matchingCnt>0){
        $.each(response.matching, function (index, el) {
            matchingHtml += `
                <tr>
                    <td class="match_rec_box flexType3"> 
                        <div class="flexCol"> 
                            <p class="data data1">[${el.hn_origin}] ${el.hn_wname}</p>
                            <p class="data data2">${el.hn_name} / ${el.w_name}</p>
                        </div> 
                        <button type="button" class="btn_match btn_secondary" name="btnMatchOn" data-typ="2" data-hncode="${el.hn_code}" data-hntitle="${el.hn_name}">매칭</button>
                    </td>
                </tr>
            `;
        });
        $('#resMatching').append(matchingHtml);
    }
}

async function Make_Match_Search_Html() {
    const s_key = $('#txtMatchPopSearch').val();
    if (s_key == '') {
        Make_Toast('검색할 약재명을 입력하세요.');
        $('#txtMatchPopSearch').focus();
        return;
    }
    const cfcode = $('#mm_medicine').data('cfcode');
    let params = {skey: s_key};
    const response = await Model.pharm_m.Search_Medicine_Pharm(params);
    console.log(response);
    $('#txtMatchPopSearch').addClass('active');
    let html = '';
    let total = response.total;
    if (total > 0) {
        $.each(response.list, function (index, el) {
            html += `
                    <div class="item_box flexType3 "> 
                        <div class="flexCol"> 
                            <p class="data data1">[${el.hn_origin}] ${el.hn_wname} </p>
                            <p class="data data2">${el.hn_name} / ${el.w_name}</p>
                        </div>  
                        <button type="button" class="btn_match btn_primary" name="btnMatchOn" data-typ="2" data-hncode="${el.hn_code}" data-hntitle="${el.hn_name}">매칭</button>
                    </div>
            `;
        });
    }else{
        html += `
                    <div class="item_box flexType2">
                        <p class="item active mr10">검색된 약재가 없습니다.</p>
                    </div>
       `;
    }
    $('#resSearch').empty();
    $('#resSearch').append(html);
    $('#txtMatchPopSearch').removeClass('active2');
    $('#txtMatchPopSearch').addClass('active');
    $('#resSearch').show();
}

async function Make_Buy_Product(params){
    let html = '';
    let subhtml = '';
    let p_type = '';
    const datas = {cfcode:params['cfcode'],mm_medicine:params['mm_medicine']};
    const response = await Model.decoc_m.Load_Decoc_Match_Product(datas);
    console.log(response);
    if(response.total > 0){
        $.each(response.list, function (index, el) {
            subhtml = (el.option_str != '') ? (el.option_str) : '';
            p_type = (el.hn_package_type==1) ?'1개' : `${el.hn_package_cnt}/Box`;
            html += `
                    <tr>
                        <td>
                            <div class="item_wrap flexType2-1 hello?">
                                <div class="item_box   ">
                                    <div class="section name_box flexType2-1">
                                        <p class="category mr10">이름</p>
                                        <div class="sub_name_box flexCol">
                                            <p class="data data1 ">[${el.n_value}] ${el.mi_name} </p>
                                            <p class="data data2">${el.hn_name} ${el.w_name} ${subhtml}</p> 
                                        </div>
                                    </div>
                                    <div class="section price_box flexType2">
                                        <p class="category mr10">근당가격</p>
                                        <p class="data">${number_format((el.guenPrice || 0))}원</p>
                                    </div>
                                    <div class="section price_box flexType2 ">
                                        <p class="category mr10">기본가격</p>
                                        <p class="data ">${number_format((el.price || 0))}원</p>
                                    </div>
                                    <div class="section price_box flexType2 ">
                                        <p class="category mr10">기본단위</p>
                                        <p class="data ">${p_type}</p>
                                    </div>
                                </div>
                                <div class="buy_box flexType2-1">
                                    <div class=" flexCol no1 mr20"> 
                                        <div class="cal_box flexType3 mb10">
                                            <i class="fa-solid fa-minus" name="btn_minus"></i>
                                            <p class="count" name="r_count" data-rcnt="${el.need}" data-price="${el.needOne}">${el.need}</p>
                                            <i class="fa-solid fa-plus" name="btn_plus"></i>
                                        </div> 
                                        <div class="price_box flexType2 ">
                                            <a href="javascript:;" class="icon_cart mr10 flexType1 "><i class="fa-solid fa-cart-shopping "></i></a>
                                            <p class="price " name="r_total" data-tprice="">총 ${number_format((el.needPrice || 0))}원</p> 
                                        </div>
                                    </div>
                                    <div class="btn_box flexCol no2">
                                        <button class=" btn_clear btnType30-1 mb5" id="" name="btnMatchOff" data-typ="1" data-sn="${el.matchedsn}">매칭해제</button>
                                        <button class=" btn_cart btnType30-1 mb5"  name="btnAddCart" data-code="${el.hn_code}">장바구니</button>
                                        <button class="btn_buy btnType30-1 mb10"  name="btnBuy" data-code="${el.hn_code}" data-ptype="${el.hn_package_type}" data-pcnt="${el.hn_package_cnt}">즉시구매</button> 
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
        });
    } else {
        html += ` 
            <tr>
                <td class="nodata p10"> 매칭 약재가 없습니다. <br> 약재 매칭 후 구매 가능합니다.
                </td>
            </tr>`;
    }

    $('#productList').append(html);

}



