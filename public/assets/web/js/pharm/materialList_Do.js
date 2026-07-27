$(document).ready(function() {

    $('#btnMtReg').on('click',function(){
        $('#pop_addMaterial').show();
    });

    $('#Xbtn2,#Xbtn').on('click',function (){
        Ini_AddPop();
        $('#pop_addMaterial').hide();
    });

    $('#InXbtn2,#InXbtn').on('click',function (){
        Ini_InPop();
        $('#vendor1').css('display','none');
        $('#vendor2').css('display','none');
        $('#vendor3').css('display','none');
        Ini_Vendor();
        $('#pop_inMaterial').hide();
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

    $('#in_reason').on('change', function() {
        var selectedVal = $(this).val();
        if (selectedVal === '1') {
            $('#vendor1').css('display','flex');
            $('#vendor2').css('display','flex');
            $('#vendor3').css('display','flex');
        } else {
            $('#vendor1').css('display','none');
            $('#vendor2').css('display','none');
            $('#vendor3').css('display','none');
            Ini_Vendor();
        }
    });

    $('#v_skey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            const params = {skey : $(this).val()};
            Make_Vendor_List(params);
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
        Ini_InPop();
        const $row = $(this).closest('tr');
        const mtcode = $row.find('td').eq(0).text().trim();
        const mtname = $row.find('td').eq(1).text().trim();
        $('#in_mtname').text(mtname);
        $('#btnInStockDo').data('mtcode',mtcode);
        $('#pop_inMaterial').show();
    });

    $(document).on('click','button[name="btnStockOutout"]',function(){
        const $row = $(this).closest('tr');
        const mtcode = $row.find('td').eq(0).text().trim();
        const mtname = $row.find('td').eq(1).text().trim();

        $('#pop_outMaterial').show();
    });




    $(document).on('click','button[name="btnMtLog"]',function(){
        const $row = $(this).closest('tr');
        const mtcode = $row.find('td').eq(0).text().trim();
        const mtname = $row.find('td').eq(1).text().trim();

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

    $('#btnInStockDo').on('click',async function(){
        if(window.confirm('입고 하시겠습니까')==true){
            const mtcode = $(this).data('mtcode');
            if(mtcode==''){
                Make_Toast('약재코드를 확인하세요.');
                return '';
            }
            const vcode = $(this).data('vcode');
            const v_price = $('#v_price').val();
            const v_unitprice = $('#v_unitprice').val();
            if(vcode!=''){
                if(v_price==''){
                    Make_Toast('매입사유에서 매입가격은 필수항목입니다.');
                    $('#v_price').focus();
                    return '';
                }
                if(v_price==''){
                    Make_Toast('매입사유에서 매입단가는 필수항목입니다.');
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
            const inReason = $('#in_reason').val();
            if(inReason==''){
                Make_Toast('입고사유를 선택하세요.');
                $('#in_reason').focus();
                return '';
            }

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


    Make_Html(Make_Option());
});

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Material_All(params);
    const list = response.list;
    const listCnt = response.total;
    const nPage = response.nPage;
    const totalCnt = response.totalRs
    let html = '';
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
    $('#btnInStockDo').data('mtcode','');
    $('#btnInStockDo').data('vcode','');
}

function Ini_Vendor(){
    $('#v_list').empty();
    $('#v_skey').val('');
    $('#v_price').val('');
    $('#v_unitprice').val('');
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
                    <a href="javascript:void(0);" class="data btnVendor" data-vcode="${el.vecode}" >${el.vename}</a>
                </div>
            `;
            $('#v_skey').addClass('active');
            $('#v_list').addClass('active');
            $('#s_list p.nodata').removeClass('active');
        });
    }else{
        html = `<p class="nodata">검색 결과가 없습니다.</p>`
        $('#v_skey').removeClass('active');
        $('#v_list').removeClass('active');
        $('#s_list p.nodata').addClass('active');
    }

    $('#v_list').empty();
    $('#v_list').append(html);
}