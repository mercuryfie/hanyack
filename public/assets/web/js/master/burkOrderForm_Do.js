$(document).ready(function() {

    $("#txtHD").on("keypress", function (key) {
        if (key.keyCode == 13) {
            $word = $('#txtHD').val();
            if ($word == '') {
                alert('검색어를 입력하세요.');
                $('#txtHD').focus();
            } else {
                Search_HnCode($word);
            }
        }
    });

    $(document).on('click','button[name="btn_hndata"]',function(){
        let hncode = $(this).data('hncode');
        let hntxt = $(this).text();
        $('#txtHD').val(hntxt);
        Load_HnInfo(hncode);
    });

    $(document).on('click','#submitBtn',function(){
        let hncode = $(this).data('hncode');
        let boxcnt = $(this).data('boxcnt');
        let wicode = $(this).data('wicode');
        let micode = $('#micode').val();
        let pPrice = $('#txtpPrice').val();
        let tBox = $('#txttBox').val();
        let pType = 3;
        let tCnt = 0;
        let tPrice = 0;
        let items = [];

        if(hncode=='' || boxcnt==''){
            Make_Toast('잘못된 접근입니다.');
        }else if(micode==''){
            Make_Toast('구매요청 탕전실을 선택하세요.');
            $('#micode').focus();
        }else if(pPrice==''){
            Make_Toast('대량구매 포장단위가격 입력하세요.');
            $('#txtpPrice').focus();
        }else if(tBox == ''){
            Make_Toast('대량구매 총박스량을 입력하세요.');
            $('#txttBox').focus();
        }else if(window.confirm('주문하시겠습니까?')==true){
            tCnt = Number(boxcnt) * Number(tBox);
            items.push({code: hncode, cnt: tCnt, ptyp: pType, price:pPrice,wicode:wicode,micode:micode});
            let str = JSON.stringify(items);
            Insert_Order(str);
        }
    });
});

async function Insert_Order(str){
    try {
        start_spinner();
        let dataarr = {"str" : str};
        let url = APIURL + '/Insert_BigOrder';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            Make_Toast('주문등록 하였습니다.')
            ini_Form1();
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error.get('message') + '}');
        stop_spinner();
    }
}



async function Load_HnInfo(hncode){
    try {
        start_spinner();
        ini_Form2();
        let dataarr = {'hncode' : hncode};
        let url = APIURL + "/Load_Herb_Info";
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            let data = result.get('data').list;
            if (data!='') {
                $('#miname').text(data.mi_name);
                $('#mdname').text(data.fk_mdname);
                $('#hnname').text(data.hn_name);
                $('#option').text((data.t1_value + '/' + data.t2_value));
                $('#hnnumber').text(data.hn_number);
                $('#makedate').text(data.hn_MakeDate);
                $('#selledate').text(data.hn_sellEDate);
                $('#nation').text(data.n_value);
                $('#option2').text((number_format(data.w_value) + 'g'));
                $('#gPrice').text(number_format((data.price[0]['hn_pPrice']) + '원'));
                $('#submitBtn').data('hncode',data.hn_code);
                $('#submitBtn').data('boxcnt',data.hn_boxCnt);
                $('#submitBtn').data('wicode',data.wi_code);

            }else{
                Make_Toast(result.get('message'));
            }
        }else{
            ini_Form1();
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function Search_HnCode(hnname){
    try {
        start_spinner();
        ini_Form1();
        let dataarr = {'name' : hnname};
        let url = APIURL + "/Load_Medicine2";
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            let html = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr,function (index,el){
                    html += `<button class="herboption" type="button" name="btn_hndata" data-hncode="${el.hn_code}" >${el.hn_name} [${el.mi_name} / ${el.hn_code}]</button>`;
                });
                $('#HD_List').append(html);
                $('#HD_List').css('display','flex');
            }else{
                Make_Toast(result.get('message'));
            }
        }else{
            ini_Form1();
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요. [ERROR : ' + error + '}');
        stop_spinner();
    }
}

function ini_Form1(){
    $('#HD_List').empty();
    $('#HD_List').css('display','none');
    $('#txtHD').val('');
    $('#miname').text('');
    $('#mdname').text('');
    $('#hnname').text('');
    $('#option').text('');
    $('#hnnumber').text('');
    $('#makedate').text('');
    $('#selledate').text('');
    $('#nation').text('');
    $('#option2').text('');
    $('#gPrice').text('');
    $('#micode').val('0');
    $('#txtpPrice').val('');
    $('#txttBox').val('');
    $('#submitBtn').data('hncode','');
    $('#submitBtn').data('boxcnt','');
    $('#submitBtn').data('wicode','');
}

function ini_Form2(){
    $('#HD_List').empty();
    $('#HD_List').css('display','none');
}
