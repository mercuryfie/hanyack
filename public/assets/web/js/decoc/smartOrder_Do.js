$(document).ready(function () {

    let params = {page:$('#pageArea').data('page')};
    Make_Html(params);


    $('#chulgoBtn').click(function () {
        $('#outWrap').css('display', 'block');
    });

    $('#pop_buy_item #Xbtn, #pop_buy_item #Xbtn2').click(function () {
        $('#pop_buy_item').css('display', 'none');
    });

    if($('input[id=onSale]').is(':checked')){
        let params = {page:$('#pageArea').data('page')};
        Make_Html(params);
    }else if($('input[id=onStock]').is(':checked')){
        let params = {page:$('#pageArea').data('page')};
        Make_Html(params);
    }

    $('input[name="herbFilter"]').change(function () {
        let value = $('input[name="herbFilter"]:checked').val();
        Load_Product(1, value);
    });

    $('#maching1').on('click',function () {
        $('#matchingpop2').css('display', 'flex');

    });


    $('#XBtn').on('click',function(e){
        INI_Matching_pop();
        $('#matchingpop').hide();
    });

    $('#XBtn2,#btn_close').on('click',function(e){
        INI_Matching_pop();
        $('#matchingpop2').hide();
    });

    $('#matchingpop2').on('click', function(e){
        if (e.target === this) {
            INI_Matching_pop();
            $(this).hide();
        }
    });

    $('#popMatch').on('click', function (e) {
        try{
            if (window.confirm('매칭 하시겠습니까?') == true) {
                let hn_code = $('#popMatch').data('hncode');
                let mm_origin = $('#popMatch').data('mm_origin');
                let mm_medicine = $('#popMatch').data('mm_medicine');
                let mm_title_kor = $('#popMatch').data('mm_title_kor');
                let mm_origin_kor = $('#popMatch').data('mm_origin_kor');

                if ((hn_code == '') || (mm_origin == '') || (mm_medicine == '') || (mm_title_kor == '') || (mm_origin_kor == '')) {
                    alert('매칭할 탕전실 약재를 선택 하여주세요.');
                } else {
                    let data = {
                        "typ": 2,
                        "hn_code": hn_code,
                        "mm_origin": mm_origin,
                        "mm_medicine": mm_medicine,
                        "mm_title_kor": mm_title_kor,
                        "mm_origin_kor": mm_origin_kor
                    }
                    add_Match(data);
                }
            }
        } catch (error) {
            alert(error);
            stop_spinner();
        }
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

    $('#order_reg').on('click',function(e){
        let price = $('#totalprice').data('tprice');
        if(price==''){
            alert('주문하실 약재의 수량을 선택하셔야 합니다.');
        }else if(window.confirm("주문하시겠습니까?")==true) {

            let code = '';
            let cnt = 0;
            let gPrice = 0;
            let str = '';

            $('input[name="chkproduct"]').each(function (e) {
                if ($(this).is(':checked') == true) {
                    code = $(this).val();
                    cnt = $(this).parent().parent().find('#price_cnt').html();
                    if (str == '') {
                        str = '{"code":"' + code + '","cnt":"' + cnt + '"}';
                    } else {
                        str += ',{"code":"' + code + '","cnt":"' + cnt + '"}';
                    }
                }
            });

            if (str == '') {
                alert('구매하실 약재를 선택하세요.');
            } else {
                Insert_Order(str);
            }
        }
    });

    $('#btnorder').on('click',function(e){
        let odcode = $(this).data('odcode');
        //alert('주문번호=' + odcode);

        let url = '/Mydecoc/orderList/' + odcode;
        $(location).attr('href',url);
    });

    $('#btnclose').on('click',function(e){
        $('#btnorder').data('odcode','');
        $('#endOrder').css('display','none');
    });


    async function Make_Html(page){
        let arr = await Load_Data(page);
        if(arr===null) return;
        let html = '';
        console.log(arr);
        if(arr.total > 0){
            let isMatch_html ='';
            let name_str = '';
            let match_html = '';
            let match_str = '';
            let Low_html = '';
            let Low_str = '';
            let price_html = ''
            $.each(arr.list, function (index, el) {
                if (el.isMatch == 0) {
                    isMatch_html = `disabled value="${el.hn_code}"`;
                    name_str = el.hn_name;
                    match_html = `onclick="reg_Match('${el.hn_code}')`;
                    match_str = '미매칭';
                    price_html = '';
                }else{
                    isMatch_html = `value="${el.hn_code}" onclick="chk_product(this,'${el.hn_pPrice}');" `;
                    name_str = el.hn_name + ' / ' + el.mm_title_kor;
                    match_html = `onclick="del_Match('${el.hn_code}');"`;
                    match_str = '매칭';
                    price_html = `
                            <i class="fa-regular fa-square-minus" onclick="price_minus(this,'${el.hn_pPrice}')"></i>
                            <p id="price_cnt">0</p>
                            <i class="fa-regular fa-square-plus" onclick="price_plus(this,'${el.hn_pPrice}')"></i></td>
                        `;
                }

                if (el.LowCnt <= 0) {
                    Low_html = '';
                    Low_str = '최저가';
                }else{
                    Low_html = `onclick="show_pop('${el.hn_code}');"`;
                    Low_str = '더보기';
                }

                html += `
                         <tr>
                            <td><input type="checkbox" class="column-1" name="chkproduct" ${isMatch_html}/></td>
                            <td>${el.hn_code}</td>
                            <td class="hbname mached"><p>${name_str}</p></td>
                            <td><button class="colorRed machingOption btntype2" type="button" ${match_html}">${match_str}</button></td>
                            <td><button class="bestpri btntype2" onclick="pop_Buy_Item();" ${Low_html}>${Low_str}</button></td>
                            <td>${el.mi_name}</td>
                            <td>${el.n_value}</td>
                            <td>${el.t1_value}</td>
                            <td>${el.t2_value}</td>
                            <td>${el.w_name}</td>
                            <td>${(el.hn_gPrice)}원</td>
                            <td>${(el.hn_pPrice)}원</td>
                            <td class="countBox">
                                ${price_html}
                            </td>    
                            <td>${el.stock}</td>
                            <td>${el.common_stock}</td>
                            <td>${el.month_stock}</td>
                            <td>${el.recommand_stock}</td> 
                        </tr>
                    `;
            });
        } else {
            html = '<td colspan="17">사용하실 약제정보가 없습니다.</td>';
        }

        let params = {
            page : page,
            total : arr.ptotal,
            perPage : 30
        }
        let pagehtml = await Make_Page_Html(params);
        $('#pageArea').html(pagehtml);


        $('#selllist').append(html);
        $('#pageArea').data('page',arr.page);
    }


    async function Load_Data(params){
        let arr = { list: [], total: 0 };
        const res = await Fetch_API('/Load_PharmHerbList',{"params" : params});
        if (res.status === 'ok') {
            const [item = {}] = res.data;
            arr = {
                list: item.list || [],
                total: item.tcnt || 0,
                page: item.page || [],
                ptotal : item.pageTotal || 0
             };
        }else if (res.status !== 'NoLogin') {
            Make_Toast(res.message);
        }
        return arr;
    }

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        let page = $(this).data('page');
        $('#pageArea').data('page',page);

        let params = {page:page};
        Make_Html(params);

    });

});


function pop_Buy_Item() {
    $('#pop_buy_item').css('display', 'block');
}

function show_pop(){
    $('#bestprice').show();
}
function show_confirmOrder(){
    $('#confirmOrder').show();
}

// dd

async function add_Match(data){
    try {
        start_spinner();
        let dataarr = data;
        let url = APIURL + '/Match_Proc';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            $(location).attr('href', '/Order/SmartOrder');
        }else{
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error.get('message') + '}');
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
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error.get('message') + '}');
        stop_spinner();
    }
}

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

function INI_Load_Product(){
    $('#selllist').empty();
    let str_price = "총 0원";
    $('#totalprice').html(str_price);
    $('#totalprice').data('tprice',0);
}




async function Make_Html1(page,MaxCnt) {
    try {
        start_spinner();
        INI_Load_Product();
        let url = APIURL + '/Load_PharmHerbList';
        let dataarr = {"page": page};
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
                let isMatch_html ='';
                let name_str = '';
                let match_html = '';
                let match_str = '';
                let Low_html = '';
                let Low_str = '';
                let price_html = ''
                $.each(arr, function (index, el) {
                    if (el.isMatch == 0) {
                        isMatch_html = `disabled value="${el.hn_code}"`;
                        name_str = el.hn_name;
                        match_html = `onclick="reg_Match('${el.hn_code}')`;
                        match_str = '미매칭';
                        price_html = '';
                    }else{
                        isMatch_html = `value="${el.hn_code}" onclick="chk_product(this,'${el.hn_pPrice}');" `;
                        name_str = el.hn_name + ' / ' + el.mm_title_kor;
                        match_html = `onclick="del_Match('${el.hn_code}')`;
                        match_str = '매칭';
                        price_html = `
                            <i class="fa-regular fa-square-minus" onclick="price_minus(this,'${el.hn_pPrice}')"></i>
                            <p id="price_cnt">0</p>
                            <i class="fa-regular fa-square-plus" onclick="price_plus(this,'${el.hn_pPrice}')"></i></td>
                        `;
                    }

                    if (el.LowCnt <= 0) {
                        Low_html = '';
                        Low_str = '최저가';
                    }else{
                        Low_html = `onclick="show_pop('${el.hn_code}')`;
                        Low_str = '더보기';
                    }

                    html += `
                         <tr>
                            <td><input type="checkbox" class="column-1" name="chkproduct" ${isMatch_html}/></td>
                            <td>${el.hn_code}</td>
                            <td class="hbname mached"><p>${name_str}</p></td>
                            <td><button class="colorRed machingOption btntype2" type="button" ${match_html}">${match_str}</button></td>
                            <td><button class="bestpri btntype2" ${Low_html}>${Low_str}</button></td>
                            
                            <td>${el.mi_name}</td>
                            <td>${el.n_value}</td>
                            <td>${el.t1_value}</td>
                            <td>${el.t2_value}</td>
                            <td>${el.w_name}</td>
                            
                            <td>${number_format(el.hn_gPrice )}원</td>
                            <td>${number_format(el.hn_pPrice)}원</td>
                            <td class="countBox">
                                ${price_html}
                            </td>    
                            <td>${el.stock}</td>
                            <td>${el.common_stock}</td>
                            
                            <td>${el.month_stock}</td>
                            <td>${el.recommand_stock}</td> 
                        </tr>
                    `;
                });
            } else {
                html = '<td colspan="17">사용하실 약제정보가 없습니다.</td>';
            }
            $('#selllist').append(html);
        } else {
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}



async function Load_Product_Pharm(page,MaxCnt) {
    try {
        start_spinner();
        INI_Load_Product();
        let url = APIURL + '/Load_PharmHerbList';
        let dataarr = {"page": page,'maxcnt' : MaxCnt};
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
                let isMatch_html ='';
                let name_str = '';
                let match_html = '';
                let match_str = '';
                let Low_html = '';
                let Low_str = '';
                let price_html = ''
                $.each(arr, function (index, el) {
                    if (el.isMatch == 0) {
                        isMatch_html = `disabled value="${el.hn_code}"`;
                        name_str = el.hn_name;
                        match_html = `onclick="reg_Match('${el.hn_code}')`;
                        match_str = '미매칭';
                        price_html = '';
                    }else{
                        isMatch_html = `value="${el.hn_code}" onclick="chk_product(this,'${el.hn_pPrice}');" `;
                        name_str = el.hn_name + ' / ' + el.mm_title_kor;
                        match_html = `onclick="del_Match('${el.hn_code}')`;
                        match_str = '매칭';
                        price_html = `
                            <i class="fa-regular fa-square-minus" onclick="price_minus(this,'${el.hn_pPrice}')"></i>
                            <p id="price_cnt">0</p>
                            <i class="fa-regular fa-square-plus" onclick="price_plus(this,'${el.hn_pPrice}')"></i></td>
                        `;
                    }

                    if (el.LowCnt <= 0) {
                        Low_html = '';
                        Low_str = '최저가';
                    }else{
                        Low_html = `onclick="show_pop('${el.hn_code}')`;
                        Low_str = '더보기';
                    }

                    html += `
                         <tr>
                            <td><input type="checkbox" class="column-1" name="chkproduct" ${isMatch_html}/></td>
                            <td>${el.hn_code}</td>
                            <td class="hbname mached"><p>${name_str}</p></td>
                            <td><button class="colorRed machingOption btntype2" type="button" ${match_html}">${match_str}</button></td>
                            <td><button class="bestpri btntype2" ${Low_html}>${Low_str}</button></td>
                            <td>${el.mi_name}</td>
                            <td>${el.n_value}</td>
                            <td>${el.t1_value}</td>
                            <td>${el.t2_value}</td>
                            <td>${el.w_name}</td>
                            <td>${number_format(el.hn_gPrice )}원</td>
                            <td>${number_format(el.hn_pPrice)}원</td>
                            <td class="countBox">
                                ${price_html}
                            </td>    
                            <td>${el.stock}</td>
                            <td>${el.common_stock}</td>
                            <td>${el.month_stock}</td>
                            <td>${el.recommand_stock}</td> 
                        </tr>
                    `;
                });
            } else {
                html = '<td colspan="17">사용하실 약제정보가 없습니다.</td>';
            }
            $('#selllist').append(html);
        } else {
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function reg_Match(hncode) {
    try {
        start_spinner();
        INI_Matching_pop();

        let dataarr = {"hncode" : hncode};
        let url = APIURL + '/Load_Match_Data';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let html = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr, function (index, el) {
                    html += '<buttion class="machingOption" onclick="setMatch(\'' + el.mmTitle + '\',\'' + el.mmMedicine + '\',\'' + el.mdMediName + '\',\'' + el.mmOrigin + '\')">[' + el.mmOrigin + '] [' + el.mmMedicine + '] ' + el.mdMediName + '</buttion>';
                });
            }

            console.log(html);
            $('#yaklist').html(html);
            $('#matchingpop2').css('display', 'flex');
        } else {
            alert(result.msg);
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}


async function del_Match(hncode) {
    try {
        if (window.confirm('선택되신 약재의 매칭을 삭제하시겠습니까?') == true) {
            start_spinner();
            let dataarr = {"hn_code" : hncode,"typ": 1};
            let url = APIURL + '/Match_Proc';
            let result = await Load_API(url,dataarr);
            if (result.get('status') == 'NoLogin') {
                go_login();
            }else if(result.get('status') == 'ok') {
                $(location).attr('href', '/Order/SmartOrder');
            }else{
                alert(result.get('message'));
            }
            stop_spinner();
        }
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

function price_minus(form,price){
    let Cnt =  $(form).parent().find('#price_cnt').html();
    let Chkform = $(form).parent().parent().find('input:checkbox[name="chkproduct"]');
    Chkform.prop("checked", true)

    if(Cnt >0){
        let total = $('#totalprice').data('tprice');
        let n_Cnt = Number(Cnt)-1;
        let t_price =Number(total) - Number(price);
        let str_price = "총 " + number_format(t_price) + "원";
        $('#totalprice').html(str_price);
        $('#totalprice').data('tprice',t_price);
        $(form).parent().find('#price_cnt').html(n_Cnt);
        if(n_Cnt==0) {
            Chkform.attr("checked", false);
        }
    }
}

function price_plus(form,price){
    let Cnt =  $(form).parent().find('#price_cnt').html();
    let Chkform = $(form).parent().parent().find('input:checkbox[name="chkproduct"]');
    Chkform.prop("checked", true)

    let total = $('#totalprice').data('tprice');
    let n_Cnt = Number(Cnt)+1;
    let t_price =Number(total) + Number(price);
    let str_price = "총 " + number_format(t_price) + "원";
    $('#totalprice').html(str_price);
    $('#totalprice').data('tprice',t_price);
    $(form).parent().find('#price_cnt').html(n_Cnt);

}


function setMatch(val1, val2, val3, val4) {
    $('#yakorigin').html(val4);
    $('#yakcode').html(val2);
    let tname = val3 + ' [' + val1 + ']';
    $('#yakname').html(tname);

    $('#popMatch').data('mm_origin', val4);
    $('#popMatch').data('mm_medicine', val2);
    $('#popMatch').data('mm_title_kor', val3);
    $('#popMatch').data('mm_origin_kor', val1);
}

function chk_product(form,price){
    let Cnt = $(form).parent().parent().find('#price_cnt').html();
    let total = $('#totalprice').data('tprice');
    let n_price = 0;
    let t_price = 0;
    let str_price = '';
    if($(form).is(":checked")==false){
        n_price = Number(Cnt) * Number(price);
        t_price = Number(total) - Number(n_price);
        str_price = "총 " + number_format(t_price) + "원";
        $('#totalprice').html(str_price);
        $('#totalprice').data('tprice',t_price);
        $(form).parent().parent().find('#price_cnt').html('0');
    }else{
        n_price = Number(price);
        t_price = Number(total) + Number(n_price);
        str_price = "총 " + number_format(t_price) + "원";
        $('#totalprice').html(str_price);
        $('#totalprice').data('tprice',t_price);
        $(form).parent().parent().find('#price_cnt').html('1');
    }
}

