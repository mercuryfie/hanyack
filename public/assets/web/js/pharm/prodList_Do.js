$(document).ready(function() {
    $(document).on('click','button[name="InProduct"]',function(){
        stopScroll();
        Ini_InPop();
        let hnname = $('#hnname').text();
        let hpcode = $(this).data('hpcode');
        let hncode = $('#hncode').text();
        $('#in_hnname').html(hnname);
        $('#btnInStockDo').data('hncode',hncode);
        $('#btnInStockDo').data('hpcode',hpcode);
        $('#pop_inMedicine').show();
    }) ;

    $(document).on('click','button[name="btnPrdLog"]',function(){
        let hpcode = $(this).data('code');
        console.log(hpcode);
        go_medicineLog(hpcode);
    }) ;

    // $('#realPrice').on('input', function() {
    $(document).on('click','#realPrice',function(){
        // $('#realPrice, #defaultPrice').css('color','red');
        $('#realPrice, #defaultPrice').removeClass('active');
        $('#realPrice').addClass('active');
        console.log('dawn21');
        // $('#realPrice').attr('hello');
        $('#p_PriceA').val('');
        $('#p_PriceB').val('');
        $('#p_PriceC').val('');
        $('#p_PriceD').val('');
        $('#p_PriceE').val('');
    });

    $(document).on('click','#defaultPrice',function(){
        const p_gPrice = $.trim($('#p_gPrice').val());
        if (p_gPrice === '') {
            alert('근당 가격을 입력하세요.');
            $('#p_gPrice').focus();
            return;
        }

        $('#realPrice').removeClass('active');
        $('#defaultPrice').addClass('active');

        updateGradePrices(p_gPrice);
    });

    $('#p_gPrice').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        const gPrice = $(this).val();
        const wValue = $('#p_hnname').data('wvalue');
        console.log(wValue);
        if (!gPrice || !wValue) {
            $('#p_packagePrice').text('');
            return;
        }

        const packagePrice = calculateTotalPriceByWeight(wValue, gPrice);
        $('#p_packagePrice').text(packagePrice);
    });


    $('#InXbtn, #InXbtn2').on('click',function(){
        startScroll();
        Ini_InPop();
        $('#vendor1').css('display','none');
        $('#vendor2').css('display','none');
        $('#vendor3').css('display','none');
        Ini_Vendor();
        $('#pop_inMedicine').hide();
    });

    $('#OutXbtn2,#OutXbtn').on('click',function (){
        startScroll();
        Ini_OutPop();
        $('#vendor4').css('display','none');
        $('#vendor5').css('display','none');
        $('#vendor6').css('display','none');
        Ini_Vendor2();
        $('#pop_outMedicine').hide();
    });

    $('#pop_produce_herb #Xbtn,#pop_produce_herb #Xbtn2').on('click',function (){
        stopScroll();
        INI_ProdHerb();
        $('#pop_produce_herb').hide();
    });

    $('#EditProdHerbWrap #Xbtn,#EditProdHerbWrap #Xbtn2').on('click',function (){
        stopScroll();
        INI_ProdHerb();
        $('#EditProdHerbWrap').hide();
    });


    $('#test_file').on('change', function () {
        const file = this.files[0];

        if (file) {
            $('#test_file_name').text(file.name);
        } else {
            $('#test_file_name').text('선택된 파일 없음');
        }

        const hasFile = this.files && this.files.length > 0;

        $('.pop_produceherb_con .f_name_box i')
            .toggleClass('active', hasFile);
    });

    $('#test_file_clear').on('click', function () {
        $('#test_file').val('');
        $('#test_file_name').text('선택된 파일 없음');
        $(this).hide();
    });


    $(document).on('click','button[name="OutProduct"]',function(){
        stopScroll();
        Ini_OutPop();
        const hnname = $('#hnname').text();
        const hpcode = $(this).data('hpcode');
        const hncode = $('#hncode').text();
        $('#out_hnname').html(hnname);
        $('#btnOutStockDo').data('hncode',hncode);
        $('#btnOutStockDo').data('hpcode',hpcode);
        $('#pop_outMedicine').show();
    }) ;

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#mlist, #m_skey').length) {
            $('#mlist').removeClass('active');
        }
    });

    $('#p_InputMaterail, #p_OutputMaterail').on('input', function() {
        let val = this.value;
        val = val.replace(/[^0-9.]/g, '');
        val = val.replace(/^\./, '');
        const parts = val.split('.');
        if (parts.length > 2) {
            val = parts[0] + '.' + parts.slice(1).join('');
        }
        this.value = val;
    });

    $('#p_InputMaterail').on('focusout',function(){
        const skey = $('#p_InputMaterail').val();
        if(skey==''){
            alert('원재료 투입량을 입력하서야 합니다.');
            setTimeout(function() {
                $('#p_InputMaterail').focus();
            }, 10);
        }
    });

    $(document).on('click','a[data-role="mtname"]',function(){
        $('#m_skey').val($(this).text().trim());
        $('#mlist').removeClass('active');
        let mtcode = $(this).data('mtcode');
        $('#m_skey').data('mtcode',mtcode);
        $('#p_InputMaterail').prop('disabled',false);
        $('#p_InputMaterail').focus();
    });

    $('#m_skey').on('focusin',function(){
        $('#m_skey').addClass('active');
    });

    $('#m_skey').on('focusout',function(){
        $('#m_skey').removeClass('active');

    });

    $('#m_skey').on('keypress',async function(e){
        if (e.which === 13 || e.keyCode === 13) {
            const skey = $(this).val();
            if(skey==''){
                Make_Toast('원재료명을 입력하세요.');
                $(this).focus();
                return '';
            }

            const params = {
                'page' : 1,
                'pcnt' : 100,
                'skey' : skey
            };

            const response = await Model.pharm_m.Load_Pharm_Material_All(params);
            const list = response.list;
            const listCnt = response.total;
            let html = '';

            if(listCnt > 0){
                $.each(list, function (index, el) {
                    html +=`
                        <a href="javascript:;" class="data" data-mtcode="${el.mtcode}" data-role="mtname">${el.mtname}</a>  
                    `;
                });
            }else{
                html = `
                    <a href="javascript:;" class="mname" data-mcode="">등록된 원재료가 없습니다.</a> 
                `;
            }
            $('#mlist').addClass('active');
            $('#mlist').empty();
            $('#mlist').append(html);
        }
    });

    $('#prod_herb').on('click',function(e){
        stopScroll();

        INI_ProdHerb();
        let hnname = $(this).data('hnname');
        $('#p_hnname').html(hnname);
        let wvalue = $(this).data('wvalue');
        $('#p_hnname').data('wvalue',wvalue);

        $('#pop_produce_herb #mainTitle').html('생산하기');
        $('#pop_produce_herb #btnProdHerb').show();

        $('#pop_produce_herb').show();

    });

    $('#periodDate, #birthDate').on('click', function() {
        if (typeof this.showPicker === 'function') {
            this.showPicker();
        }
    });

    $(document).on('click','button[name="btnEditPrice"]',async function(e){

        let hpcode = $(this).data('code');
        INI_ProdHerb();
        // $('#defaultPrice').addClass('active');

        $('#EditProdHerbWrap').show();

    });


    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Ini_Form();
        Make_Html(Make_Option());
    });

    $('#pop_produce_herb #Xbtn, #pop_produce_herb #Xbtn2').click(function () {
        startScroll();
        INI_ProdHerb();
        // Ini_Form();
        $('#pop_produce_herb').hide();
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
            const params = {skey : $(this).val()};
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
            const params = {skey : $(this).val()};
            Make_Vendor_List2(params);
        }
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

    $("#sdate , #edate, #in_indate").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });

    $('#btnInStockDo').on('click',async function(){
        const hncode = $(this).data('hncode');
        const hpcode = $(this).data('hpcode');
        if((hncode=='') || (hpcode=='')){
            Make_Toast('약재정보를 확인하세요.');
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
                Make_Toast('구매 사유에서 매입업체명 검색은 필수항목입니다.');
                return '';
            }
            if(v_price==''){
                Make_Toast('구매 사유에서 매입가격은 필수항목입니다.');
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
                hncode : hncode,
                hpcode : hpcode,
                typ : 1,
                stock : formatWeightConvert(stock,stockType),
                reason : inReason,
                vcode : vcode,
                v_price : v_price,
                v_unitprice : v_unitprice,
                in_memo : in_memo,
                indate : in_indate
            };
            const response  = await Model.pharm_m.Input_Pharm_Medicine_InOut(params);
            if(response.effect > 0){
                Make_Toast('등록하였습니다.');
                location.reload();
            }else{
                Make_Toast('네트워크 장애로 인해 입고처리에 실패 하였습니다.\n다시시도하여주세요.');
            }
        }
    });

    $('#btnOutStockDo').on('click',async function(){
        const hncode = $(this).data('hncode');
        const hpcode = $(this).data('hpcode');
        if((hncode=='') || (hpcode=='')){
            Make_Toast('약재정보를 확인하세요.');
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

        if(window.confirm('출고 하시겠습니까')==true){
            const stockType  = $('#out_stockType').val();
            const out_indate = $('#out_indate').val();
            const out_memo = $('#out_memo').val();
            const params = {
                hncode : hncode,
                hpcode : hpcode,
                typ : 2,
                stock : formatWeightConvert(stock,stockType),
                reason : outReason,
                vcode : vcode,
                v_price : v_price,
                v_unitprice : v_unitprice,
                in_memo : out_memo,
                indate : out_indate
            };
            const response  = await Model.pharm_m.Input_Pharm_Medicine_InOut(params);
            if(response.effect > 0){
                Make_Toast('등록하였습니다.');
                location.reload();
            }
        }
    });

    $('#btnProdHerb').on('click',async function(){
        let hncode = $('#hncode').text();
        if (!formValidate(hncode, '생산하실 약재를 선택하세요.',$('#hncode'))) return;

        let mtcode = $('#m_skey').data('mtcode');
        if (!formValidate(mtcode, '생산에 필요한 원재료를 검색하세요.')) return;

        let tempMweight = $('#p_InputMaterail').val();
        if (!formValidate(tempMweight, '생산에 필요한 원재료 투입량을 입력하세요.',$('#p_InputMaterail'))) return;
        let pUnitType = $('#p_MUnitType').val();
        let inputMaterial = formatWeightConvert(tempMweight,pUnitType);

        let p_batchno = $('#p_batchno').val();
        if (!formValidate(p_batchno, '제조번호를 입력하세요.',$('#p_batchno'))) return;

        let birthDate = $('#birthDate').val();
        if (!formValidate(birthDate, '제조일자를 선택하세요.',$('#birthDate'))) return;

        let periodDate = $('#periodDate').val();
        if (!formValidate(periodDate, '유통기한를 선택하세요.',$('#periodDate'))) return;

        let tempOweight = $('#p_OutputMaterail').val();
        if (!formValidate(tempOweight, '생산량을 입력하세요.',$('#p_OutputMaterail'))) return;
        let oUnitType = $('#p_PUintType').val();
        let outputMaterial = formatWeightConvert(tempOweight,oUnitType);

        let p_gPrice = $('#p_gPrice').val();
        if (!formValidate(p_gPrice, '근당가격을 입력하세요.',$('#p_gPrice'))) return;

        let p_PriceA = $('#p_PriceA').val();
        if (!formValidate(p_PriceA, '등급A 가격을 입력하세요.',$('#p_PriceA'))) return;

        let p_PriceB = $('#p_PriceB').val();
        if (!formValidate(p_PriceB, '등급B 가격을 입력하세요.',$('#p_PriceB'))) return;

        let p_PriceC = $('#p_PriceC').val();
        if (!formValidate(p_PriceC, '등급C 가격을 입력하세요.',$('#p_PriceC'))) return;

        let p_PriceD = $('#p_PriceD').val();
        if (!formValidate(p_PriceD, '등급D 가격을 입력하세요.',$('#p_PriceD'))) return;

        let p_PriceE = $('#p_PriceE').val();
        if (!formValidate(p_PriceE, '등급E 가격을 입력하세요.',$('#p_PriceE'))) return;

        const fileInput = $('#test_file')[0];
        if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
            Make_Toast('시험성적서 파일을 선택해주세요.');
            return;
        }
        let test_file = fileInput.files[0];
        if(window.confirm('생산을 진행하시겠습니까?')==true) {
            let params = {
                hncode: hncode,
                mtcode: mtcode,
                inputMaterial: inputMaterial,
                outputMaterial: outputMaterial,
                p_batchno: p_batchno,
                birthDate: birthDate,
                periodDate: periodDate,
                price: $('#p_packagePrice').text(),
                gPrice: p_gPrice,
                grade_a: p_PriceA,
                grade_b: p_PriceB,
                grade_c: p_PriceC,
                grade_d: p_PriceD,
                grade_e: p_PriceE,
                test_file: test_file
            };

            let response = await Model.pharm_m.Insert_Pharm_Medicine_Product(params);
            let effect = response.effect;
            if (effect > 0) {
                Make_Toast('생산을 등록하였습니다.');
                startScroll();
                INI_ProdHerb();
                $('#pop_produce_herb').hide();
                $('#pageArea').data('page',1);
                Make_Html(Make_Option());
            }
        }
    });

    let params = {hncode:$('#hncode').html()};
    Make_Html(params);
});



async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Medicine_Product(params);
    const list = response.list;
    const tcnt = response.total;
    let html = '';
    let status = '';
    console.log(response);
    if(tcnt>0){
        $.each(list, function (index, el) {
            status = (el.is_del==0) ? '활성화' : '비활성화';
            html +=`
                <tr class="status ">
                    <td>${el.hp_code}</td>
                    <td>${el.hn_batch_no}</td>
                    <td>${el.hn_product_date}</td>
                    <td>${el.hn_expired_date}</td>
                    <td>${formatWeight(el.hn_produce_stock || 0)}</td>
                    <td>${formatWeight(el.latest_total || 0)}</td>
                    <td>
                        <p class="status ">${status}</p>
                    </td>
                    <td>
                        <div class="flexType1"> 
                            <button type="button" class="btnType1 mr5" name="InProduct"  data-hpcode="${el.hp_code}" >입고</button>
                            <button type="button" class="btnType1" name="OutProduct" data-hpcode="${el.hp_code}">출고</button>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btnType1 mr5" name="btnPrdLog" data-code="${el.hp_code}" >
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btnType1" name="btnPrdExam" data-fname="${el.hn_exam}">
                            <i class="fa-solid fa-file"></i>
                        </button>
                    </td>   
                    <td>
                        <button type="button" class="btnType1 " name="btnEditPrice" data-hpcode="${el.hp_code}" data-hnname="${el.hp_code}" >
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                    </td>
                    <td class="">
                        <button type="button" class="btnType1 " name="btnPrdBarcode" data-code="${el.hp_code}" >
                            <i class="fa-solid fa-barcode"></i>
                        </button>
                    </td> 
                </tr>
            `;


        });
    } else {
        html=`<tr><td colspan="12">데이터가 없습니다.</td></tr>`;
    }
    $('#dataList').empty();
    $('#dataList').append(html);
    let options = {
        page : $('#pageArea').data('page'),
        total : tcnt,
        perpage : $('#pageArea').data('pcnt'),
        bname : 'btnLinkPaging'
    }
    $('#pageArea').html(Make_Page_Html('simple',options));
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

function Ini_OutPop(){
    $('#out_hnname').text('');
    $('#out_reason').val('');
    const today = new Date();
    $('#out_indate').val(formatDate(today));
    $('#out_stock').val('');
    $('#out_stockType').val(1);
    $('#out_memo').val('');
    $('#vo_skey').removeClass('active');
    $('#vo_list').removeClass('active');
    $('#btnOutStockDo').data('hncode','');
    $('#btnOutStockDo').data('hpcode','');
    $('#btnOutStockDo').data('vcode','');
}

function INI_ProdHerb() {
    clearTestFile();
    $('#p_MUnitType').val(1);
    $('#p_PUintType').val(1);
    // $('#realPrice, #defaultPrice').removeClass('active');
    $('#m_skey').val('');
    $('#m_skey').data('mtcode','');
    $('#p_InputMaterail').val('');
    $('#p_InputMaterail').prop('disabled',true);
    $('#p_OutputMaterail').val('');
    $('#mlist').empty();
    $('#p_batchno').val('');

    const today = new Date();
    $('#birthDate').val(formatDate(today));
    $('#periodDate').val(formatDate(today));

    $('#p_gPrice').val('');
    $('#p_packagePrice').html('');
    $('#p_PriceA').val('');
    $('#p_PriceB').val('');
    $('#p_PriceC').val('');
    $('#p_PriceD').val('');
    $('#p_PriceE').val('');
}


function Make_Option(){
    return {
        page : $('#pageArea').data('page'),
        pCnt : $('#pageArea').data('pcnt'),
        hncode:$('#hncode').html()
    };
}


function updateGradePrices(p_gPrice) {
    const $btn = $('#defaultPrice');
    const gradeA = $btn.data('gradea');
    const gradeB = $btn.data('gradeb');
    const gradeC = $btn.data('gradec');
    const gradeD = $btn.data('graded');
    const gradeE = $btn.data('gradee');

    $('#p_PriceA').val(getDiscountPrice(p_gPrice, gradeA));
    $('#p_PriceB').val(getDiscountPrice(p_gPrice, gradeB));
    $('#p_PriceC').val(getDiscountPrice(p_gPrice, gradeC));
    $('#p_PriceD').val(getDiscountPrice(p_gPrice, gradeD));
    $('#p_PriceE').val(getDiscountPrice(p_gPrice, gradeE));
}

function clearTestFile() {
    $('#test_file').val('');
    if ($('#test_file')[0]) {
        $('#test_file')[0].value = '';
    }

    $('#test_file_name').text('선택된 파일 없음');
}