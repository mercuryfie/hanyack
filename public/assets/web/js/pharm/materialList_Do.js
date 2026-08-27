$(document).ready(function() {

    $('#btnMtReg').on('click',function(){
        Ini_AddPop();
        $('#btnMtRegDo').show();
        $('#btnMtUpdateDo').hide();
        $('#pop_addMaterial #p_title').html('원재료 등록하기');
        $('#btnMtRegDo').show();
        $('#btnMtUpdate').hide();
        $('#pop_addMaterial').show();
    });

    $('#Xbtn2,#Xbtn').on('click',function (){
        Ini_AddPop();
        $('#pop_addMaterial').hide();
    });

    $('#pop_inMaterial #Xbtn,#pop_inMaterial #Xbtn2').on('click',function (){
        startScroll();
        Ini_InPop();
        $('#vendor1').css('display','none');
        $('#vendor2').css('display','none');
        $('#vendor3').css('display','none');
        Ini_Vendor();
        $('#pop_inMaterial').hide();
    });

    $('#pop_outMaterial #Xbtn,#pop_outMaterial #Xbtn2').on('click',function (){
        startScroll();
        Ini_OutPop();
        $('#vendor4').css('display','none');
        $('#vendor5').css('display','none');
        $('#vendor6').css('display','none');
        Ini_Vendor2();
        $('#pop_outMaterial').hide();
    });


    $('button[name="btn_edit"]').on('click',function (){
        Ini_OutPop();
        $('#vendor1').css('display','none');
        $('#vendor2').css('display','none');
        $('#vendor3').css('display','none');
        Ini_Vendor();
        $('#pop_outMaterial').hide();
    });

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Ini_Form();
        Make_Html(Make_Option());
    });

    $(document).on('click','.btnVendor' , function(){
        const vcode = $(this).data('vcode');
        const vname =$(this).text();
        $('#v_skey').val(vname);
        $('#v_skey').removeClass('active');
        $('#v_list').removeClass('active');
        $('#btnInStockDo').data('vcode',vcode);
        $('#v_list').empty();
    });

    $(document).on('click','.btnVendor2' , function(){
        const vcode = $(this).data('vcode');
        const vname =$(this).text();
        $('#vo_skey').val(vname);
        $('#vo_skey').removeClass('active');
        $('#vo_list').removeClass('active');
        $('#btnOutStockDo').data('vcode',vcode);
        $('#vo_list').empty();
    });

    $('#in_reason').on('change', function() {
        var selectedVal = $(this).val();
        if (selectedVal === '1') {
            $('#vendor1').css('display','flex');
            $('#vendor2').css('display','flex');
            $('#vendor3').css('display','flex');
            $('#v_skey').focus();
        } else {
            $('#vendor1').css('display','none');
            $('#vendor2').css('display','none');
            $('#vendor3').css('display','none');
            Ini_Vendor();
        }
    });

    $('#out_reason').on('change', function() {
        var selectedVal = $(this).val();
        if (selectedVal === '1') {
            $('#vendor4').css('display','flex');
            $('#vendor5').css('display','flex');
            $('#vendor6').css('display','flex');
            $('#vo_skey').focus();
        } else {
            $('#vendor4').css('display','none');
            $('#vendor5').css('display','none');
            $('#vendor6').css('display','none');
            Ini_Vendor2();
        }
    });


    $('#v_skey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            let skey = $(this).val();
            if(skey==''){
                Make_Toast('업체명을 입력하세요.');
                return '';
            }
            const params = {skey : skey};
            Make_Vendor_List(params);
        }
    });

    $('#vo_skey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            let skey = $(this).val();
            if(skey==''){
                Make_Toast('업체명을 입력하세요.');
                return '';
            }
            const params = {skey : skey};
            Make_Vendor_List2(params);
        }
    });


    $("#sdate , #edate, #in_indate").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });

    $(document).on('click','button[name="btnMtDelete"]',async function(){
        if(window.confirm('삭제 하시겠습니까?')==true) {
            const $row = $(this).closest('tr');
            const mtcode = $row.find('td').eq(0).text().trim();
            const params = {mtcode: mtcode};
            const response = await Model.pharm_m.Delete_Pharm_Material(params);
            if (response.effect > 0) {
                Make_Toast('삭제 하였습니다.');
                $('#tr_' + mtcode).remove();
            }
        }
    });

    $(document).on('click','button[name="btnStockInput"]',function(){
        stopScroll();
        Ini_InPop();
        const $row = $(this).closest('tr');
        const mtcode = $row.find('td').eq(0).text().trim();
        const mtname = $row.find('td').eq(1).text().trim();
        $('#in_mtname').text(mtname);
        $('#btnInStockDo').data('mtcode',mtcode);
        $('#pop_inMaterial').show();
    });

    $(document).on('click','button[name="btnStockOutout"]',function(){
        stopScroll();
        Ini_OutPop();
        const $row = $(this).closest('tr');
        const mtcode = $row.find('td').eq(0).text().trim();
        const mtname = $row.find('td').eq(1).text().trim();
        $('#out_mtname').text(mtname);
        $('#btnOutStockDo').data('mtcode',mtcode);
        $('#pop_outMaterial').show();
    });

    $(document).on('click','button[name="btnMtLog"]',function(){
        const $row = $(this).closest('tr');
        const mtcode = $row.find('td').eq(0).text().trim();
        const mtname = $row.find('td').eq(1).text().trim();
        $('#in_mtname').text(mtname);
        $('#btnInStockDo').data('mtcode',mtcode);
        const url = "/Mypharm/materialLog?mc=" + mtcode + "&mn=" + mtname;
        $(location).attr("href", url);
    });

    $('#btnMtRegDo').on('click',async function(){
        const mtname = $('#mtname').val();
        if(mtname==''){
            Make_Toast('약재명을 입력하세요.');
            $('#mtname').focus();
            return '';
        }
        const wasteRate = $('#waste_rate').val().trim();
        if (wasteRate === '' || isNaN(wasteRate)) {
            alert('기본손실률에 올바른 숫자를 입력해 주세요.');
            $('#waste_rate').focus();
            return false;
        }
        const optimalStock = $('#optimal_stock').val().trim();
        if (optimalStock === '' || isNaN(optimalStock)) {
            alert('적정재고율에 올바른 숫자를 입력해 주세요.');
            $('#optimal_stock').focus();
            return false;
        }

        if(window.confirm('등록하시겠습니까?')==true) {
            const memo = $('#memo').val();
            const stockType = $('#real_rate').val();
            const calcOptimal = formatWeightConvert(optimalStock, stockType);
            const params = {
                mtname: mtname,
                optimal_stock: calcOptimal,
                waste_rate: wasteRate,
                memo: memo
            };
            const response = await Model.pharm_m.Insert_Pharm_Material(params);
            if (response.effect > 0) {
                Make_Toast('등록하였습니다.');
                location.reload();
            }
        }
    });

    $('#btnMtUpdateDo').on('click',async function(){
        const mtcode = $(this).data('mtcode');
        const mtname = $('#mtname').val();
        if((mtcode=='') || (mtname=='')){
            Make_Toast('약재정보를 확인하세요.');
            $('#mtname').focus();
            return '';
        }
        const wasteRate = $('#waste_rate').val().trim();
        if (wasteRate === '' || isNaN(wasteRate)) {
            alert('기본손실률에 올바른 숫자를 입력해 주세요.');
            $('#waste_rate').focus();
            return false;
        }
        const optimalStock = $('#optimal_stock').val().trim();
        if (optimalStock === '' || isNaN(optimalStock)) {
            alert('적정재고율에 올바른 숫자를 입력해 주세요.');
            $('#optimal_stock').focus();
            return false;
        }

        if(window.confirm('수정하시겠습니까?')==true) {
            const memo = $('#memo').val();
            const stockType = $('#real_rate').val();
            const calcOptimal = formatWeightConvert(optimalStock, stockType);
            const params = {
                mtcode:mtcode,
                mtname: mtname,
                optimal_stock: calcOptimal,
                waste_rate: wasteRate,
                memo: memo
            };
            const response = await Model.pharm_m.Update_Pharm_Material(params);
            if (response.effect > 0) {
                Make_Toast('수정하였습니다.');
                location.reload();
            }else{
                Make_Toast('네크워크 장애로 인해 원재료 정보 수정에 실패 하였습니다.\n다시 시도하여주세요');
            }
        }
    });

    $('#btnInStockDo').on('click',async function(){
        const mtcode = $(this).data('mtcode');
        if(mtcode==''){
            Make_Toast('약재코드를 확인하세요.');
            return '';
        }
        const inReason = $('#in_reason').val();
        if(inReason==''){
            Make_Toast('입고사유를 선택하세요.');
            $('#in_reason').focus();
            return '';
        }
        const vcode = $(this).data('vcode');
        const v_price = $('#v_price').val();
        const v_unitprice = $('#v_unitprice').val();
        if(inReason==1){
            if(vcode==''){
                Make_Toast('구매 사유에서 매입처명 검색은 필수항목입니다.');
                return '';
            }
            if(v_price==''){
                Make_Toast('구매 사유에서 매입 가격은 필수항목입니다.');
                $('#v_price').focus();
                return '';
            }
            if(v_price==''){
                Make_Toast('구매 사유에서 매입단가는 필수항목입니다.');
                $('#v_unitprice').focus();
                return '';
            }
        }
        const stock = $('#in_stock').val();
        if(stock==''){
            Make_Toast('입고량을 입력하세요.');
            $('#in_stock').focus();
            return '';
        }

        if(window.confirm('입고하시겠습니까?')==true){
            const stockType  = $('#in_stockType').val();
            const in_indate = $('#in_indate').val();
            const in_memo = $('#in_memo').val();
            const params = {
                mtcode : mtcode,
                typ : 1,
                stock : formatWeightConvert(stock,stockType),
                reason : inReason,
                vcode : vcode,
                v_price : v_price,
                v_unitprice : v_unitprice,
                in_memo : in_memo,
                indate : in_indate
            };
            const response  = await Model.pharm_m.Input_Pharm_Material_InOut(params);
            if(response.effect > 0){
                Make_Toast('등록하였습니다.');
                location.reload();
            }
        }
    });

    $('#btnOutStockDo').on('click',async function(){
        const mtcode = $(this).data('mtcode');
        if(mtcode==''){
            Make_Toast('약재코드를 확인하세요.');
            return '';
        }
        const outReason = $('#out_reason').val();
        if(outReason==''){
            Make_Toast('입고사유를 선택하세요.');
            $('#out_reason').focus();
            return '';
        }
        const vcode = $(this).data('vcode');
        const v_price = $('#vo_price').val();
        const v_unitprice = $('#vo_unitprice').val();
        if(outReason==1){
            if(vcode==''){
                Make_Toast('판매사유에서 판매업체명 검색은 필수항목입니다.');
                return '';
            }
            if(v_price==''){
                Make_Toast('판매사유에서 판매가격은 필수항목입니다.');
                $('#v_price').focus();
                return '';
            }
            if(v_price==''){
                Make_Toast('판매사유에서 판매단가는 필수항목입니다.');
                $('#v_unitprice').focus();
                return '';
            }
        }
        const stock = $('#out_stock').val();
        if(stock==''){
            Make_Toast('출고량을 입력하세요.');
            $('#out_stock').focus();
            return '';
        }

            const stockType  = $('#out_stockType').val();
            const out_indate = $('#out_indate').val();
            const out_memo = $('#out_memo').val();
            const params = {
                mtcode : mtcode,
                typ : 2,
                stock : formatWeightConvert(stock,stockType),
                reason : outReason,
                vcode : vcode,
                v_price : v_price,
                v_unitprice : v_unitprice,
                in_memo : out_memo,
                indate : out_indate
            };
            const response  = await Model.pharm_m.Input_Pharm_Material_InOut(params);
            if(response.effect > 0){
                Make_Toast('등록하였습니다.');
                location.reload();
            }

    });

    $(document).on('click','button[name="btnMtUpdate"]',function(){
        $('#btnMtRegDo').hide();
        $('#btnMtUpdateDo').show();

        const mtcode = $(this).data('mtcode');
        const mtname = $(this).data('mtname');
        const optimal_stock = $(this).data('ostock');
        const waste_rate = $(this).data('wrate');
        const memo = $(this).data('memo');
        let odata = formatWeightConvertForUnit(optimal_stock);
        let real_unit = '';
        if(odata.unit=='g'){
            real_unit = 1;
        }else if(odata.unit=='kg'){
            real_unit = 2;
        }else if(odata.unit=='t'){
            real_unit = 3;
        }
        $('#mtname').val(mtname);
        $('#waste_rate').val(waste_rate);
        $('#optimal_stock').val(odata.value);
        $('#real_rate').val(real_unit);
        $('#memo').val(memo);
        $('#pop_addMaterial #p_title').html('원재료 수정하기');
        $('#btnMtUpdateDo').data('mtcode',mtcode);
        $('#btnMtUpdate').show();
        $('#pop_addMaterial').show();

    });


    Make_Html(Make_Option());
});

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Material_All(params);
    const list = response.list;
    const listCnt = response.total;
    const nPage = response.nPage;
    const totalCnt = response.totalRs
    let html = '';

    console.log(list);
    if(listCnt > 0){
        $.each(list, function (index, el) {
            let s_stats = (el.stock_status=='low') ? '<p class="stock_status active">부족</p>' : '<p class="stock_status ">정상</p>';
            html +=`
                <tr id="tr_${el.mtcode}">
                    <td>${el.mtcode}</td>
                    <td>${el.mtname}</td>
                    <td>${formatWeight(el.current_stock)}</td>
                    <td>${formatWeight(el.optimal_stock)}</td>
                    <td>
                        <button type="button" class="btnType1 mr5" name="btnStockInput" >입고</button>
                        <button type="button" class="btnType1" name="btnStockOutout" >출고</button>
                    </td>
                    <td>
                        ${s_stats}
                    </td>
                    <td>${el.last_stock_update}</td>
                    <td>
                        <button type="button" class="btnType1" name="btnMtLog"  >
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btnType1" name="btnMtUpdate" data-mtcode="${el.mtcode}" data-mtname="${el.mtname}" data-ostock="${el.optimal_stock}" data-wrate="${el.waste_rate}" data-memo="${el.memo}"  >
                            수정
                        </button>
                    </td>
                    <td class="row trash">
                        <button type="button" class="btnType1 " name="btnMtDelete"  ><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            `;
        });
    }else{
        html = `<tr><td colspan="9">등록된 원재료가 없습니다.</td>`;
    }
    $('#dataList').append(html);
    let options = {
        page : $('#pageArea').data('page'),
        total : totalCnt,
        perpage : $('#pageArea').data('pcnt'),
        bname : 'btnLinkPaging'
    }
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#pageArea').data('page',nPage);
}

function Make_Option(){
    return {
        'page' : $('#pageArea').data('page'),
        'pCnt' : $('#pageArea').data('pcnt'),
    };
}

function Ini_Form(){
    $('#dataList').empty();
}

function Ini_AddPop(){
    $('#btnMtRegDo').hide();
    $('#btnMtUpdateDo').hide();
    $('#btnMtUpdateDo').data('mtcode','');
    $('#mtname').val('');
    $('#waste_rate').val('');
    $('#optimal_stock').val('');
    $('#memo').val('');
}

function Ini_InPop(){
    $('#in_mtname').text('');
    $('#in_reason').val('');
    const today = new Date();
    $('#in_indate').val(formatDate(today));
    $('#in_stock').val('');
    $('#in_stockType').val(1);
    $('#in_memo').val('');
    $('#v_skey').removeClass('active');
    $('#v_list').removeClass('active');
    $('#btnInStockDo').data('mtcode','');
    $('#btnInStockDo').data('vcode','');
}

function Ini_OutPop(){
    $('#out_mtname').text('');
    $('#out_reason').val('');
    const today = new Date();
    $('#out_indate').val(formatDate(today));
    $('#out_stock').val('');
    $('#out_stockType').val(1);
    $('#out_memo').val('');
    $('#vo_skey').removeClass('active');
    $('#vo_list').removeClass('active');
    $('#btnOutStockDo').data('mtcode','');
    $('#btnOutStockDo').data('vcode','');
}

function Ini_Vendor(){
    $('#v_list').empty();
    $('#v_skey').val('');
    $('#v_price').val('');
    $('#v_unitprice').val('');
}


function Ini_Vendor2(){
    $('#vo_list').empty();
    $('#vo_skey').val('');
    $('#vo_price').val('');
    $('#vo_unitprice').val('');
}

async function Make_Vendor_List(params){
    const response = await Model.pharm_m.Load_Pharm_VendorForSearch(params);
    console.log(response);
    const list = response.list;
    const tcnt = response.total;
    let html = '';
    if(tcnt > 0){
        $.each(list, function (index, el) {
            html += `
                <div class="v_box">
                    <a href="javascript:void(0);" class="data btnVendor" data-vcode="${el.ve_code}" >${el.ve_name}</a>
                </div>
            `;
        });
        $('#v_skey').addClass('active');
        $('#v_list').addClass('active');
        $('#noptag').hide();
        $('#v_list').html(html);
    }else{
        $('#v_skey').removeClass('active');
        $('#v_list').removeClass('active');
        $('#noptag').show();
    }
}

async function Make_Vendor_List2(params){
    const response = await Model.pharm_m.Load_Pharm_VendorForSearch(params);
    console.log(response);
    const list = response.list;
    const tcnt = response.total;
    let html = '';
    if(tcnt > 0){
        $.each(list, function (index, el) {
            html += `
                <div class="v_box">
                    <a href="javascript:void(0);" class="data btnVendor2" data-vcode="${el.ve_code}" >${el.ve_name}</a>
                </div>
            `;
        });
        $('#vo_skey').addClass('active');
        $('#vo_list').addClass('active');
        $('#noptag2').hide();
        $('#vo_list').html(html);
    }else{
        $('#vo_skey').removeClass('active');
        $('#vo_list').removeClass('active');
        $('#noptag2').show();
    }
}

function Edit_Material(button) {
    const params = JSON.parse(
        decodeURIComponent($(button).attr('data-params'))
    );

    console.log(params);
    console.log(params[0].mtcode);
    let list = params[0];
    let mtname = $('#mtname').val(list.mtname);
    let params2= [ {
        mtname:mtname
    }
    ];

    $('#mtname').val(list.mtname);
    $('#waste_rate').val(list.waste_rate);
    $('#optimal_stock').val(list.optimal_stock).data('origin',list.optimal_stock);
    $('#real_rate').val(1);
    $('#memo').val(list.memo);
    $('#btnMtUpdate').data('params',params2);

    $('#pop_addMaterial #p_title').html('원재료 수정하기');
    $('#btnMtUpdate').show();
    $('#btnMtRegDo').hide();
    $('#pop_addMaterial').show();

}


function Update_Material(button) {
    // const params = JSON.parse(
    //     decodeURIComponent($(button).attr('data-params'))
    // );

    let params = $(button).data('params');
    console.log('1516');
    console.log(params);
    console.log(params[0].mtcode);
    let list = params[0];

    // $('#pop_addMaterial').show();
    // $('#pop_addMaterial #p_title').html('원재료 수정하기');
    // $('#mtname').val(list.mtname);
    // $('#waste_rate').val(list.waste_rate);
    // $('#optimal_stock').val(list.optimal_stock).data('origin',list.optimal_stock);
    // $('#real_rate').val(1);
    // $('#memo').val(list.memo);


}