$(document).ready(function () {


    $('#pop_buy_item #Xbtn, #pop_buy_item #Xbtn2').click(function () {
        $('#pop_buy_item').hide();
    });

    $('#matchingpop #Xbtn, #matchingpop #Xbtn2').click(function () {
        $('#matchingpop').hide();
    });

    $('i[name="plus"]').on('click', function() {
        let cnt = parseInt($('#price_cnt').text(), 10);
        console.log(cnt);
        if ( cnt < 99) {
            cnt++;
            $('#price_cnt').text(cnt);
            updateTotalPrice(cnt, unitPrice);
        }
    });

    $('i[name="minus"]').on('click', function() {
        let cnt = parseInt($('#price_cnt').text(), 10);
        if (cnt > 1) {
            cnt--;
            $('#price_cnt').text(cnt);
            updateTotalPrice(cnt, unitPrice);
        }
    });

    $('i[name="heart"]').on('click', function() {
        $(this).toggleClass('fa-solid ');
        Make_Toast('added wishlist');
        // alert('added wishlist');
    });

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

    $(document).on('click','.wishHeartBox',async function(){
        let code = $(this).data('code');
        let ptype = $(this).data('ptype');
        let act = $(this).data('act');
        if(Like_Do(code,ptype,act)){
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

    $('.herbName').hover(
        function() { $(this).addClass('hovered'); },
        function() { $(this).removeClass('hovered'); }
    );

    $('#XBtn').on('click',function(e){
        Form_ini1();
        $('#matchingpop').hide();
    });

    $('#matchingpop').on('click', function(e){
        if (e.target === this) {
            INI_Matching_pop();
            $(this).hide();
        }
    });

    $('#btn_match').on('click',function(e){
        let items = [];
        $('input[name="matchcode"]:checked').each(function() {
            let mdMedi      = $(this).data('mdmedi');
            let md_code     = $(this).data('md_code');
            let mm_medicine = $(this).data('mm_medicine');
            let mm_origin   = $(this).data('mm_origin');
            let md_title_kor= $(this).data('md_title_kor');
            let md_maker    = $(this).data('md_maker');

            items.push({mdMedi: mdMedi, md_code: md_code, mm_medicine: mm_medicine,mm_origin:mm_origin,md_title_kor:md_title_kor,md_maker:md_maker});
        });

        let Cnt = items.length;
        if(Cnt<=0){
            Make_Toast('사용하실 매칭 약재를 선택하세요.');
        }else {
            let hncode = $(this).data('hncode');
            let stock = $('#mm_stock').val();
            let str = JSON.stringify(items);
            Insert_Match_Data(hncode,stock,str);
        }
    });

    $('#btn_match_del').on('click',function(e){

        let items = [];
        $('input[name="delcode"]:checked').each(function() {
            let csn = $(this).val();
            items.push({sn:csn});
        });
        let Cnt = items.length;
        if(Cnt<=0){
            Make_Toast('삭제하실 매칭된 약재를 선택하세요.');
        }else {
            let hncode = $('#btn_match').data('hncode');
            let str = JSON.stringify(items);
            Del_Decoc_Match(hncode,str);
        }
    });

    $(document).on('click','#btn_addcart',function(){
        let pCnt = $('#price_cnt').html();
        let code = $(this).data('code');
        let ptype = $(this).data('ptype');
        if(pCnt<=0){
            pCnt = 1;
        }
        add_thum_cart(code, pCnt,ptype);
    });

    $(document).on('click','#btn_order',function(){
        let matched = $(this).data('matched');
        if(matched<=0){
            Make_Toast('사용하시는 약재로 매칭하셔야 구입이 가능합니다.');
        }else {
            let price = $('#totalprice').data('tprice');
            if (price == '') {
                Make_Toast('구매수량을 정해주세요.');
            } else if (window.confirm("주문하시겠습니까?") == true) {
                let items = [];
                let code = $(this).data('code');
                let pType = $(this).data('ptype');
                let cnt = $('#price_cnt').html();
                items.push({code: code, cnt: cnt, ptyp: pType});
                let str = JSON.stringify(items);
                Insert_Order(str);
            }
        }
    });

    $(document).on('click','#btn_matchform',function(){
        let code = $(this).data('code');

        Form_ini1();
        Load_Match_info(code);
        $('#matchingpop').show();
    });
});


function INI_Matching_pop() {
    $('#yaklist').empty();
    $('#yaknation').html('');
    $('#yakcode').html('');
    $('#yakname').html('');
    $('#yakcompany').val();
    $('#yakherb').val();
    $('#popMatch').data('hncode', '');
    $('#popMatch').data('mm_origin', '');
    $('#popMatch').data('mm_medicine', '');
    $('#popMatch').data('mm_title_kor', '');
    $('#popMatch').data('mm_origin_kor', '');
}


async function Del_Decoc_Match(code,str){
    try{
        start_spinner();
        let dataarr = {"hncode":code,"str" : str};
        let url = APIURL + '/Del_Match_Data2';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let mCnt = result.get('data').Match;
            $('#btn_matchform').text('약재매칭[' + mCnt + ']');
            $('#btn_order').data('matched',mCnt);

            Form_ini1();
            Load_Match_info(code);
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    }catch(error){
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function Insert_Match_Data(code,stock,str){
    try{
        start_spinner();
        let dataarr = {"code":code,"stock":stock,"str" : str};
        let url = APIURL + '/Insert_Match_Data2';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let mCnt = result.get('data').Match;
            $('#btn_matchform').text('약재매칭[' + mCnt + ']');
            $('#btn_order').data('matched',mCnt);

            Form_ini1();
            Load_Match_info(code);
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    }catch(error){
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

function Form_ini1(){
    $('#yaklist1').empty();
    $('#yaklist2').empty();
    $('#btn_match').data('hncode','');
}

async function Load_Match_info(hncode){
    try {
        start_spinner();
        let dataarr = {"code" : hncode};
        let url = APIURL + '/Load_Decoc_Match_Info2';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {

            let html1 = '';
            let html2 = '';
            let arr1 = result.get('data').list1;
            let arr2 = result.get('data').list2;
            let Cnt1 = arr1.length;
            let Cnt2 = arr2.length;

            let opstr = '';
            if (Cnt1 > 0) {
                $.each(arr1, function (index, el) {
                    opstr = '';
                    if((el.t1_value!='')&&(el.t2_value!='')) {
                        opstr += `/${el.t1_value}/${el.t2_value}`;
                    }else if((el.t1_value!='')&&(el.t2_value=='')){
                        opstr += `/${el.t1_value}`;
                    }else if((el.t1_value=='')&&(el.t2_value!='')){
                        opstr += `/${el.t2_value}`;
                    }

                    html1 += `
                        <div class="list flexType2"> 
                        <label for="hello" class="line" id="" name="mdmedilist">
                            <input type="checkbox" id="" name="delcode" class="checkbox" value="${el.sn}">  
                        </label>
                        <p class="herbName" id="" name="yakname2">[${el.mm_origin}]  ${el.md_title_kor}  (${el.md_maker})</p>  
                        </div> 
                    `;
                });
                $('#yaklist1').append(html1);
            }

            if (Cnt2 > 0) {
                $.each(arr2, function (index, el) {
                    opstr = '';
                    if((el.t1_value!='')&&(el.t2_value!='')) {
                        opstr += `/${el.t1_value}/${el.t2_value}`;
                    }else if((el.t1_value!='')&&(el.t2_value=='')){
                        opstr += `/${el.t1_value}`;
                    }else if((el.t1_value=='')&&(el.t2_value!='')){
                        opstr += `/${el.t2_value}`;
                    }
                    html2 += `
                        <div class="list flexType2"> 
                        <label for="hello" class="line" id="" name="mdmedilist">
                            <input type="checkbox" id="" name="matchcode" class="checkbox" value="${el.mm_seq}" data-mdMedi="${el.mdMedi}" data-md_code="${el.md_code}" data-mm_medicine="${el.mm_medicine}" data-mm_origin="${el.mm_origin}" data-md_title_kor="${el.md_title_kor}" data-md_maker="${el.md_maker}">  
                        </label>
                        <p class="herbName" id="" name="yakname2">[${el.mm_origin}]  ${el.md_title_kor}  (${el.md_maker})</p>  
                        </div> 
                    `;
                });
                $('#yaklist2').append(html2);
                $('#btn_match').data('hncode',hncode);
            }
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error.get('message') + '}');
        stop_spinner();
    }

}


async function Insert_Order(str){
    try {
        start_spinner();
        let dataarr = {"str" : str};
        let url = APIURL + '/Insert_Order';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            $('#btnorder').data('odcode',result.get('info'));
            $('#endOrder').css('display','flex');
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error.get('message') + '}');
        stop_spinner();
    }
}

async function Like_Do(code,ptype,act){
    let bool = false;
    try {
        start_spinner();
        let dataarr = {"code": code,'ptype' : ptype,"act":act};
        let url = APIURL + '/Like_Do';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            bool = true;
        }else{
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error.get('message') + '}');
        stop_spinner();
    }
    return bool;
}


async function Herb_Cart_Do(str){
    try{
        start_spinner();
        let dataarr = {"str" : str};
        let url = APIURL + '/Insert_Cart';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            $('#popcart').css('display','flex');
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();

    }catch(error){
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }

}


function updateTotalPrice(cnt, price) {
    let total = cnt * price;
    $('#ttl_price').text(number_format(total));
}


function price_minus(form,price){
    let Cnt = $('#price_cnt').html();
    let new_Cnt = Number(Cnt) - 1;
    if(new_Cnt<=0) new_Cnt=0;
    let new_tprice = Number(new_Cnt) * price;

    $('#price_cnt').html(new_Cnt);
    $('#totalprice').html(new_tprice.toLocaleString());
    $('#totalprice').data('tprice',new_tprice);
}

function price_plus(form,price){
    let Cnt = $('#price_cnt').html();
    let new_Cnt = Number(Cnt) + 1;
    let new_tprice = Number(new_Cnt) * price;

    $('#price_cnt').html(new_Cnt);
    $('#totalprice').html(new_tprice.toLocaleString());
    $('#totalprice').data('tprice',new_tprice);
}

function box_minus(form,price,boxcnt){
    let Cnt = $('#price_cnt').html();
    let box = $('#box_cnt').html();
    let new_Cnt = Number(Cnt) - Number(boxcnt);
    if(new_Cnt<=0) new_Cnt = 0;
    let new_box_Cnt = Number(box) - 1;
    if(new_box_Cnt<=0) new_box_Cnt = 0;
    let new_tprice = Number(new_Cnt) * price;


    $('#price_cnt').html(new_Cnt);
    $('#box_cnt').html(new_box_Cnt);
    $('#totalprice').html(new_tprice.toLocaleString());
    $('#totalprice').data('tprice',new_tprice);
}

function box_plus(form,price,boxcnt){
    let Cnt = $('#price_cnt').html();
    let box = $('#box_cnt').html();
    let new_Cnt = Number(Cnt) + Number(boxcnt);
    let new_box_Cnt = Number(box) +1;
    let new_tprice = Number(new_Cnt) * price;


    $('#price_cnt').html(new_Cnt);
    $('#box_cnt').html(new_box_Cnt);
    $('#totalprice').html(new_tprice.toLocaleString());
    $('#totalprice').data('tprice',new_tprice);
}

function add_thum_cart(code,cnt,ptype){
    console.log(code + '/' + cnt + '/' + ptype);

    if((code!='') && (cnt!='') && (ptype!='')) {
        let items = [];
        items.push({code: code, cnt: cnt, ptyp: ptype});
        let str = JSON.stringify(items);
        Herb_Cart_Do(str);

    }else{
        Make_Toast('잘못된 접근입니다..[Error101]');
    }

}
