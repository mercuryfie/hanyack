$(document).ready(function() {
    let today = addDays(3)
    $("#p_deli_date").val(today).attr("min", today);

    $("#p_deli_date").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });

    $('#Xbtn,#Xbtn2').on('click',function(e){
        $('#pop_del_order').hide();
    });

    $(document).on('change', 'input[type="checkbox"].chkproduct', function(e) {
        let tpriceclass = $(this).closest('.cartgds').find('.tPrice');

        if ($(this).is(':checked')) {
            let total = $('#totalprice').data('tprice');
            let t_price = tpriceclass.data('tprice');
            let n_price = Number(total) + Number(t_price);
            $('#totalprice').html('총 ' + n_price.toLocaleString() + '원');
            $('#totalprice').data('tprice', n_price);
        } else {
            let total = $('#totalprice').data('tprice');
            let t_price = tpriceclass.data('tprice');
            let n_price = Number(total) - Number(t_price);
            if (n_price < 0) n_price = 0;
            $('#totalprice').html('총 ' + n_price.toLocaleString() + '원');
            $('#totalprice').data('tprice', n_price);
        }
    });

    $(document).on('change', 'input[type="checkbox"].ChkMaker', function(e) {
        let code = $(this).attr('data-code');
        let chk_name = 'chk_' + code;
        let isChecked = $(this).is(':checked');
        $('input[type="checkbox"][name="' + chk_name + '"]').each(function(index, element) {
            $(element).prop('checked', isChecked).trigger('change');
        });
    });

    $(document).on('click','#btn_delEdit',function(e){
        let url = '/Mydecoc/deliveryInfo';
        $(location).attr("href", url);
    });

    $(document).on('click','#btn_cartOrder',async function(e){
        let orderList = [];
        $('input.chkproduct:checked').each(function () {
            let nsn  = $(this).data('sn');
            let code  = $(this).data('code');
            let cnt   = $(this).closest('.goodsbox').find('.price_cnt').html();
            let delidate = $('#p_deli_date').val();
            orderList.push({code: code,cnt: cnt,cartsn:nsn,delidate:delidate});
        });

        let Cnt = orderList.length;
        if(Cnt <=0){
            Make_Toast('주문하실 약재를 선택하세요.');
        }else if(window.confirm('주문하시겠습니까?')==true){
            console.log(orderList);
            let response = await Model.decoc_m.Add_Decoc_OrderByCart(orderList);
            if(response.total > 0){
                Ini_Form();
                Load_Data(Make_Option());
                $('#endOrder').show();
            }
        }
    });

    $(document).on('click','.dltbtn',function(e){
        let sn = $(this).data('sn');
        $('#cart_del').data('sn',sn);
        $('#pop_del_order').show();

    });

    $(document).on('click','.close_dltmer',function(e){
        $('#cart_del').data('sn','');
        $('#pop_del_order').hide();
    });

    $(document).on('click','#cart_del',async function(e){
        let sn = $(this).data('sn');
        const params = {sn: sn};
        let response = await Model.decoc_m.Del_Decoc_Cart(params);
        if(response.effect > 0){
            $('#pop_del_order').hide();
            Ini_Form();
            Load_Data(Make_Option());
            Make_Toast('삭제 완료 하였습니다.');
        }
    });

    Load_Data(Make_Option());

});

function Make_Option(){
    return {
        page : $('#pageArea').data('page')
    };
}

function price_minus(form,price){
    let cntClass = $(form).closest('.right').find('.price_cnt');
    let now_cnt = cntClass.html();
    let new_cnt = Number(now_cnt)-1;
    let new_price = new_cnt * price;
    if(now_cnt<=0) now_cnt = 0;
    if(new_cnt<=0) new_cnt = 0;
    if(new_price<=0) new_price = 0;

    cntClass.html(new_cnt);

    let tclass = $(form).closest('.count_boxy2w').find('.left .tPrice');
    tclass.data('tprice',new_price);
    tclass.html(Number(new_price).toLocaleString() + '원');

    let chkclass = $(form).closest('.cartgds').find('.chkproduct');
    let checked = chkclass.prop('checked');
    if(checked==true){
        let totalprice = $('#totalprice').data('tprice');
        let new_tprice =  Number(totalprice) - Number(price);
        if(new_tprice<=0) new_tprice = 0;
        $('#totalprice').data('tprice',new_tprice);
        $('#totalprice').html('총 ' + Number(new_tprice).toLocaleString() + '원');
    }
}

function price_plus(form,price){
    let cntClass = $(form).closest('.right').find('.price_cnt');
    let now_cnt = cntClass.html();
    let new_cnt = Number(now_cnt)+1;
    let new_price = new_cnt * price;

    cntClass.html(new_cnt);

    let tclass = $(form).closest('.count_boxy2w').find('.left .tPrice');
    tclass.data('tprice',new_price);
    tclass.html(Number(new_price).toLocaleString() + '원');

    let chkclass = $(form).closest('.cartgds').find('.chkproduct');
    let checked = chkclass.prop('checked');
    if(checked==true){
        let totalprice = $('#totalprice').data('tprice');
        let new_tprice =  Number(totalprice) + Number(price);
        $('#totalprice').data('tprice',new_tprice);
        $('#totalprice').html('총 ' + Number(new_tprice).toLocaleString() + '원');
    }
}


function box_minus(form,price,boxcnt){
    let cntClass = $(form).closest('.right').find('.price_cnt');
    let now_cnt = cntClass.html();

    let boxclass = $(form).closest('.right').find('.box_cnt');
    let now_box = boxclass.html();
    let new_cnt = Number(now_cnt) - Number(boxcnt);
    let new_box = Number(now_box) - 1;
    if(now_cnt<=0) now_cnt = 0;
    if(now_box<=0) now_box = 0;
    if(new_box<=0) new_box = 0;
    if(new_cnt<=0) new_cnt = 0;
    let new_price = Number(new_cnt) * price;
    let tclass = $(form).closest('.count_boxy2w').find('.left .tPrice');

    boxclass.html(new_box);
    cntClass.html(new_cnt);

    tclass.data('tprice',new_price);
    tclass.html(Number(new_price).toLocaleString() + '원');

    let chkclass = $(form).closest('.cartgds').find('.chkproduct');
    let checked = chkclass.prop('checked');
    if(checked==true){
        let totalprice = $('#totalprice').data('tprice');
        let new_tprice =  Number(totalprice) - (Number(price) * boxcnt);
        if(new_tprice<=0) new_tprice = 0;
        $('#totalprice').data('tprice',new_tprice);
        $('#totalprice').html('총 ' + Number(new_tprice).toLocaleString() + '원');
    }


}

function box_plus(form,price,boxcnt){
    let cntClass = $(form).closest('.right').find('.price_cnt');
    let now_cnt = cntClass.html();
    let boxclass = $(form).closest('.right').find('.box_cnt');
    let now_box = boxclass.html();
    let new_box = Number(now_box) + 1;
    let new_cnt = Number(now_cnt) + Number(boxcnt);
    let new_price = new_cnt * price;
    let tclass = $(form).closest('.count_boxy2w').find('.left .tPrice');

    boxclass.html(new_box);
    cntClass.html(new_cnt);

    tclass.data('tprice',new_price);
    tclass.html(Number(new_price).toLocaleString() + '원');

    let chkclass = $(form).closest('.cartgds').find('.chkproduct');
    let checked = chkclass.prop('checked');
    if(checked==true){
        let totalprice = $('#totalprice').data('tprice');
        let new_tprice =  Number(totalprice) + (Number(price) * boxcnt);
        $('#totalprice').data('tprice',new_tprice);
        $('#totalprice').html('총 ' + Number(new_tprice).toLocaleString() + '원');
    }
}

function Ini_Form(){
    $('#cartlist').empty();
    $('#totalprice').text('총 0원').data('tprice',0);
}


async function Load_Data(params) {
    let response = await Model.decoc_m.Load_Decoc_Cart(params);
    console.log(response);
    let html = '';
    if( response.total > 0){
        $.each(response.list, function (index, el) {
            let subhtml = '';
            let lowhtml = '';
            let strUnit = '';
            let cntUnit = 0;
            let totalPrice = 0;
            let priceUnit = 0;
            let strUnitPrice = 0;
            $.each(el.list, function (index, sub){
                if(sub.LowCnt<=0) {
                    lowhtml = `<span class="lowest">최저가</span>`;
                }
                if(sub.hn_package_type==1){
                    strUnit = '단위 : 개';
                    cntUnit = sub.t_cnt;
                    totalPrice = sub.t_tPrice;
                    priceUnit = sub.t_gPrice;
                    strUnitPrice = '단위당 가격 : ' + number_format(priceUnit || 0) + '원';
                }else{
                    strUnit = '단위 : 박스 [박스당 ' + sub.hn_package_cnt + '개]';
                    cntUnit = parseInt(sub.t_cnt) / parseInt(sub.hn_package_cnt);
                    totalPrice = parseInt(sub.t_gPrice) * parseInt(sub.t_cnt);
                    priceUnit = parseInt(sub.t_gPrice) * parseInt(sub.hn_package_cnt);
                    strUnitPrice = '단위당 가격 : ' + number_format(priceUnit || 0) + '원';
                }
                subhtml += `
                    <div class="cartgds cartgoods1-2" id="sub_${sub.sn}">
                        <div class="goodsbox flexType4">
                            <div class="goodsleft flexType4">
                                <input type="checkbox" class="chkproduct" name="chk_${sub.macode}" data-sn="${sub.sn}" data-code="${sub.hncode}" data-ptyp="${sub.ptype}">
                                <div class="imgBox">
                                    <img class="cartgoodsimg" src="${PRODUCT_IMG_URL}/${sub.thumnail}" alt="img">
                                </div> 
                            </div>
                            <div class="goodsright">
                                <div class="goodsttl flexType3">
                                    <div class="goodsttl1-1 flexType4">
                                        <p class="hbname">[${sub.n_value}] ${sub.hnname} ${sub.w_name}</p>
                                        ${lowhtml}
                                    </div> 
                                </div>
                                <p class="option">${sub.hn_option}</p>
                                <div class="count_boxy2w flexType3 ">  
                                
                                  <div class="right "> 
                                    <div class="right2 flexType3  ">
                                        <p class="title">${strUnit}</p>
                                        <div class="cartcounter flexType3">
                                            <i class="fa-solid fa-minus" onclick="price_minus(this,'${priceUnit}')"></i>  
                                            <p class="price_cnt" data-nprice="${priceUnit}">${cntUnit}</p>
                                            <i class="fa-solid fa-plus" onclick="price_plus(this,'${priceUnit}')"></i> 
                                        </div>
                                    </div>
                                    <div class="right2 flexType3">
                                        <p class="title">${strUnitPrice}</p> 
                                    </div>
                                  </div>
                                  <div class="left flexType4"> 
                                    <p class="tPrice" data-tprice="${totalPrice}">${number_format(totalPrice || 0)}원</p>  
                                  </div>  
                                </div> 
                            </div>
                        </div>
                    </div>
                `;
            });

            html += `
            <div class="clbox cartleft1-1">
                <div class="cartgds cartgoods1-1 flexType3"> 
                    <div class="area flexType2">
                        <input type="checkbox" class="ChkMaker" data-code="${el.macode}">
                        <p class="h_name">${el.maname}</p> 
                    </div>  
                    
                </div>
                ${subhtml}
            </div>
            `;


        });
    } else {
        html = `
            <div class="emptyCart">
                <i class="fa-solid fa-circle-info"></i>
                <p class="msg">장바구니에 담긴 상품이 없습니다</p>
            </div>
        `;

    }
    $('#cartlist').append(html);
}


function morelist(key){
    let url = '/Product/pList?lp=2&skey=' + key;
    $(location).attr('href',url);
}