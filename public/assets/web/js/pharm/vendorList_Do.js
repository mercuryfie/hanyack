$(document).ready(function() {
    let v_data = null;

    let params = {
        page: 1,
        pcnt: 30,
        skey: ''
    };
    Load_VendorList(params);

    $("#v_skey").on("keypress", function (e) {
        let skey = $('#v_skey').val();
        let params = {
            skey:skey
        };

        if (e.which === 13 || e.keyCode === 13) {
            INI_VendorList();
            console.log('skey:',skey);
            console.log('skey2:',params);
            Find_Vendor(params);
        }
    });

    $("#v_skey").on("keypress", function (e) {
        let skey = $('#v_skey').val();
        let params = {
            skey:skey
        };

        if (e.which === 13 || e.keyCode === 13) {
            INI_VendorList();
            console.log('skey:',skey);
            console.log('skey2:',params);
            Find_Vendor(params);
        }
    });

    $(document).on('click','button[name="btn_del"]',async function(){
        if(window.confirm('삭제 하시겠습니까?')==true) {
            const $row = $(this).closest('tr');
            const vecode = $row.data('vecode');
            console.log('dawn1735',vecode)
            const params = {vecode: vecode};
            const response = await Model.pharm_m.Delete_Pharm_Vendor(params);

            console.log('dawn17351',response)
            if (response.effect > 0) {
                Make_Toast('삭제 하였습니다.');
                $('#tr_' + vecode).remove();
            }
        }
    });

    // $("#fkey").on("click", function (e) {
    //     let skey = $('#v_skey').val();
    //     let params = {
    //         skey:skey
    //     };
    //     if (e.which === 13 || e.keyCode === 13) {
    //         INI_VendorList();
    //         console.log('skey33:',skey);
    //         console.log('skey233:',params);
    //         Find_Vendor(params);
    //     }
    // });

    $(document).on('click','button[name="btn_log"]',function(){
        const vcode = $(this).data('vcode');
        const url = '/Mypharm/transactionList?cd=' + vcode;
        $(location).attr('href',url);
    });

    $(document).on('change', '#input_cause ', function () {
        if ($(this).val() === '2') {
            $('.in_material_con .area.price ').css('display','flex');
            $('.in_material_con .area.vendor ').css('display','flex');
        } else {
            $('.in_material_con .area.price ').css('display','none');
            $('.in_material_con .area.vendor ').css('display','none');
        }
    });

    $(document).on('change', '#output_cause', function () {
        if ($(this).val() === '2') {
            // $('.out_material_con .area.price ').addClass('active');
            $('.out_material_con .area.price ').css('display','flex');
            $('.out_material_con .area.customer ').css('display','flex');
        } else {
            // $('.out_material_con .area.price ').removeClass()Class('active');
            $('.out_material_con .area.price ').css('display','none');
            $('.out_material_con .area.customer ').css('display','none');
        }
    });

    $(function () {
        const today = new Date();

        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        $('.in_material_con .input_date').val(`${year}-${month}-${day}`);
        $('.out_material_con .input_date').val(`${year}-${month}-${day}`);
    });

    $(document).on('click', '[name="findAddress"]', function () {
        const $block = $('[name="edit_address"]');
        const $block2 = $('[name="edit_address2"]');
        new daum.Postcode({
            oncomplete: function (data) {
                $block.find('#postcode').val(data.zonecode);
                $block2.find('#roadAddress').val(data.roadAddress);
                $block2.find('#jibunAddress').val(data.jibunAddress);
            }
        }).open();
    });

    $('#add_vendor').click(function () {
        INI_AddVendor();
        $('#p_title').html('거래처 등록');
        $('#pop_AddVendor').show();
        $('#pop_AddVendor .input_type.v_name').focus();
    });

    $('#btn_edit').click(function () {

        // $('#p_title').html('거래처 수정');
        // const list = JSON.parse(
        //     decodeURIComponent($(this).attr('data-list'))
        // );
        //
        // Edit_Vendor(list);
    });

    $('button[name="h_input"]').click(function () {
        console.log('bello,world!');
        $('#pop_inMaterial').show();
        $('#pop_inMaterial').css('display', 'block');
    });

    $('#Xbtn,#Xbtn2').on('click',function(e){
        // INI_Matching_pop();
        $('#pop_AddVendor').hide();
    });

});

function INI_AddVendor(){
    $('#ve_name').val('');
    $('#ve_code1').val('');
    $('#ve_code2').val('');
    $('#ve_code3').val('');
    $('#ve_ctc1').val('');
    $('#ve_ctc2').val('');
    $('#ve_ctc3').val('');
    $('#ve_email').val('');
    $('#ve_busiemail').val('');
    $('#ve_postcode').val('');
    $('#jibunAddress').val('');
    $('#ve_desc').val('');

}

function INI_VendorList(){

    $('#v_list').empty();
}

async function Load_VendorList(params){
    // params > pcnt : 페이지당갯수, page : 현재 페이지
    // let pcnt = '';
    // let pcnt = '';
    // let params { }
    console.log('dawn', params);
    const response = await Model.pharm_m.Load_Pharm_Vendor_All(params);
    let list = response.list;
    let tcnt = response.total;
    let vTotal = response.totalRs;
    let nPage = response.nPage;
    let html = '';
    let v_data = encodeURIComponent(JSON.stringify(list));
    console.log('dawn2', list);
    console.log('dawn23', tcnt);
    console.log('dawn24', vTotal);
    console.log('dawn25', nPage);
    let options = {
        page : $('#pageArea').data('page'),
        total : vTotal,
        perpage : $('#pageArea').data('pcnt'),
        bname : 'btnLinkPaging'
    }
    if(tcnt > 0) {
        $.each(list, function (index, el) {

            let v_no = String(el.ve_busino ?? '').replace(/\D/g, '');
            let dashed_v_no = `${v_no.slice(0, 3)}-${v_no.slice(3, 5)}-${v_no.slice(5, 10)}`;

            let p_no = String(el.ve_busitel ?? '').replace(/\D/g, '');
            let dashed_p_no = `${p_no.slice(0, 3)}-${p_no.slice(3, 7)}-${p_no.slice(7, 11)}`;

            console.log(p_no,dashed_p_no);
            console.log('dawn2233', list);
            let html = ` 
            
                <tr class="status " data-vecode="${el.ve_code}" id="tr_${el.ve_code}">
                    <td>${el.ve_name}</td>
                    <td>${dashed_v_no}</td>
                    <td>${dashed_p_no}</td>
                    <td>${el.ve_email}</td>
                    <td>${el.ve_busiemail}</td>
                    <td>${el.ve_busiaddr1}</td>
                    <td>${el.ve_busiaddr2}</td>
                    <td>${el.ve_desc}</td>
                    <td class="" data-vecode="${el.ve_code}"> 
                        <button type="button" class="btnType1 " name="btn_log" data-vcode="${el.ve_code}"><i class="fa-solid fa-receipt"></i></button>
                    </td>
                    <td class="" data-vecode="${el.ve_code}"> 
                        <button type="button" class="btnType1 " name="btn_edit" data-list="${v_data}" onclick="Edit_Vendor('{${list}}');" ><i class="fa-solid fa-pencil"></i></button>
                    </td>
                    <td class="" data-vecode="${el.ve_code}"> 
                        <button type="button" class="btnType1 " name="btn_del" ><i class="fa-solid fa-trash"></i></button>
                    </td> 
                </tr> 
            `;

            $('#v_list').append(html);
        });
    }else{
        html = `
            <tr>
                <td colspan="9">데이터가 없습니다.</td>
            </tr>`;
    }
    $('#v_list').append(html);
    $('#pageArea').html(Make_Page_Html('simple',options));
    $('#pageArea').data('page',nPage);
}

async function Find_Vendor(params){
    const response = await Model.pharm_m.Load_Pharm_VendorForSearch(params);
    const list = response.list;
    const total = response.total;
    let html = '';
    console.log(response);
    if(total > 0){
        $.each(list, function (index, el) {
            let s_stats = (el.stock_status=='low') ? '<p class="stock_status active">부족</p>' : '<p class="stock_status ">정상</p>';
            let v_no = String(el.ve_busino ?? '').replace(/\D/g, '');
            let dashed_v_no = `${v_no.slice(0, 3)}-${v_no.slice(3, 5)}-${v_no.slice(5, 10)}`;

            console.log({
                original: el.ve_busino,
                v_no,
                dashed_v_no
            });
            html +=` 
                <tr id="sn_${el.ve_code}"> 
                    <td id="">${el.ve_name}</td>
                    <td id="">${dashed_v_no}</td>
                    <td id="">${el.ve_busitel}</td>
                    <td id="">${el.ve_email}</td>
                    <td id="">${el.ve_busiemail}</td>
                    <td id="">${el.ve_busiaddr1}</td>
                    <td id="">${el.ve_busiaddr2}</td>
                    <td id="">${el.ve_desc}</td> 
                    <td class="" data-vecode="${el.ve_code}"> 
                        <button type="button" class="btnType1 " name="btn_log" ><i class="fa-solid fa-receipt"></i></button>
                    </td>
                    <td class="" data-vecode="${el.ve_code}"> 
                        <button type="button" class="btnType1 " name="btn_edit" ><i class="fa-solid fa-pencil"></i></button>
                    </td>
                    <td class="" data-vecode="${el.ve_code}"> 
                        <button type="button" class="btnType1 " name="btn_del" ><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr >
            `;
        });
    }else{
        html = `
                <tr>
                    <td colspan="9">데이터가 없습니다</td>
                </tr>
            `;
    }
    $('#v_list').append(html);
}


async function Edit_Vendor({list}){
    console.log('dawn1700',list);

    $('#pop_AddVendor').show();
    $('#pop_AddVendor .input_type.v_name').focus();
    // console.log('dawn1700',list.ve_code);
    // let params = {
    //     vcode: vcode
    // };
    // console.log('params:',params);
    // const response = await Model.pharm_m.Load_Pharm_VendorForSearch(params);
    // const list = response.list;
    // const total = response.total;
    // console.log('response:',response);
    let html = '';
    // let p_title =
    // $('#p_title').html('거래처 수정');
    // console.log(response);
    // console.log(response.list);
    // if(total > 0){
    //     $.each(list, function (index, el) {
    //         let v_no = String(el.ve_busino ?? '').replace(/\D/g, '');
    //         let p_no = String(el.ve_busitel ?? '').replace(/\D/g, '');
    //
    //         console.log('1:', v_no.slice(0, 3));
    //         console.log('2:', v_no.slice(3, 5));
    //         console.log('3:', v_no.slice(5, 10));
    //         $('#identifier').val(el.ve_code);
    //         $('#ve_name').val(el.ve_name);
    //         $('#ve_no1').val(v_no.slice(0, 3));
    //         $('#ve_no2').val(v_no.slice(3, 5));
    //         $('#ve_no3').val(v_no.slice(5, 10));
    //         $('#ve_ctc1').val(p_no.slice(0, 3));
    //         $('#ve_ctc2').val(p_no.slice(3, 7));
    //         $('#ve_ctc3').val(p_no.slice(7, 11));
    //         $('#ve_email').val(el.ve_email);
    //         $('#ve_busiemail').val(el.ve_busiemail);
    //         $('#ve_postcode').val(el.ve_busizip);
    //         $('#roadAddress').val(el.ve_busiaddr1);
    //         $('#jibunAddress').val(el.ve_busiaddr2);
    //         $('#ve_desc').val(el.ve_desc);
    //     });
    //     $('#pop_AddVendor').show();
    //     $('#pop_AddVendor .input_type.v_name').focus();
    //     console.log('bello1');
    // } else {
    //     alert('dd')
    //     $('#pop_AddVendor').hide();
    //     console.log('bello12');
    // }

}
// function Validate_Vendor() {
//     const $popup = $('#pop_AddVendor');
//
//     const vNo1 = $popup.find('#ve_no1').val().trim();
//     const vNo2 = $popup.find('#ve_no2').val().trim();
//     const vNo3 = $popup.find('#ve_no3').val().trim();
//
//     const pNo1 = $popup.find('#ve_ctc1').val().trim();
//     const pNo2 = $popup.find('#ve_ctc2').val().trim();
//     const pNo3 = $popup.find('#ve_ctc3').val().trim();
//
//     const validations = [
//         {
//             value: vNo1,
//             rule: /^\d{3}$/,
//             message: '사업자번호 첫 번째 칸은 숫자 3자리로 입력해주세요.',
//             target: '#ve_no1'
//         },
//         {
//             value: vNo2,
//             rule: /^\d{2}$/,
//             message: '사업자번호 두 번째 칸은 숫자 2자리로 입력해주세요.',
//             target: '#ve_no2'
//         },
//         {
//             value: vNo3,
//             rule: /^\d{5}$/,
//             message: '사업자번호 세 번째 칸은 숫자 5자리로 입력해주세요.',
//             target: '#ve_no3'
//         },
//         {
//             value: pNo1,
//             rule: /^\d{2,3}$/,
//             message: '전화번호 앞자리는 숫자 2~3자리로 입력해주세요.',
//             target: '#ve_ctc1'
//         },
//         {
//             value: pNo2,
//             rule: /^\d{3,4}$/,
//             message: '전화번호 중간자리는 숫자 3~4자리로 입력해주세요.',
//             target: '#ve_ctc2'
//         },
//         {
//             value: pNo3,
//             rule: /^\d{4}$/,
//             message: '전화번호 마지막 칸은 숫자 4자리로 입력해주세요.',
//             target: '#ve_ctc3'
//         }
//     ];
//
//     const invalid = validations.find(function (item) {
//         return !item.rule.test(item.value);
//     });
//
//     if (invalid) {
//         Make_Toast(invalid.message);
//         $popup.find(invalid.target).focus();
//
//         return {
//             valid: false,
//             data: null
//         };
//     }
//
//     const vendorData = {
//         vcode: String(originalVendorData?.vcode ?? ''),
//         name: $popup.find('#ve_name').val().trim(),
//         busino: vNo1 + vNo2 + vNo3,
//         busitel: pNo1 + pNo2 + pNo3,
//         email: $popup.find('#ve_email').val().trim(),
//         busiemail: $popup.find('#ve_busiemail').val().trim(),
//         busizip: $popup.find('#ve_postcode').val().trim(),
//         busiaddr1: $popup.find('#roadAddress').val().trim(),
//         busiaddr2: $popup.find('#jibunAddress').val().trim(),
//         desc: $popup.find('#ve_desc').val().trim()
//     };
//
//     return {
//         valid: true,
//         data: vendorData
//     };
// }
//
// async function Update_Vendor() {
//     const $popup = $('#pop_AddVendor');
//
//     // 1. 검증
//     const validation = Validate_Vendor();
//
//     if (!validation.valid) {
//         return;
//     }
//
//     const currentVendorData = validation.data;
//
//     // 2. 기존 값과 현재 값 비교
//     const isChanged = Object.keys(currentVendorData).some(function (key) {
//         const oldValue = String(originalVendorData?.[key] ?? '');
//         const newValue = String(currentVendorData[key] ?? '');
//
//         return oldValue !== newValue;
//     });
//
//     // 3. 변경된 값이 없을 때
//     if (!isChanged) {
//         Make_Toast('변경된 값이 없습니다.');
//         $popup.hide();
//
//         await Load_Data();
//         return;
//     }
//
//     // 4. 수정 요청
//     try {
//         const response =
//             await Model.pharm_m.Update_Pharm_Vendor(currentVendorData);
//
//         if (response.result === 'ok') {
//             Make_Toast('저장하였습니다.');
//             $popup.hide();
//
//             await Load_Data();
//         } else {
//             Make_Toast(response.message || '저장에 실패하였습니다.');
//         }
//
//     } catch (error) {
//         console.error(error);
//         Make_Toast('저장 중 오류가 발생하였습니다.');
//     }
// }

// async function Update_Vendor(){
//     let vcode = $('#identifier').val();
//
//     let v_no =
//         $('#ve_no1').val() +
//         $('#ve_no2').val() +
//         $('#ve_no3').val();
//
//     let p_no =
//         $('#ve_ctc1').val() +
//         $('#ve_ctc2').val() +
//         $('#ve_ctc3').val();
//     let params = {
//         vecode: $('#identifier').val(),
//         vename: $('#ve_name').val(),
//         vedesc: $('#ve_desc').val(),
//         veemail: $('#ve_email').val(),
//         vebusino: v_no,
//         vebusiemail:  $('#ve_busiemail').val(),
//         vebusizip: $('#ve_postcode').val(),
//         vebusiaddr1:$('#roadAddress').val(),
//         vebusiaddr2:$('#jibunAddress').val(),
//         vebusitel:p_no,
//         veisdel:0
//
//     };
//     console.log('params12:',params);
//     const response = await Model.pharm_m.Update_Pharm_Vendor(params);
//     const list = response.list;
//     const total = response.total;
//     const effect = response.effect;
//     console.log('response:',response);
//     console.log('effect:',effect);
//     if (effect>0) {
//         console.log('bello113');
//         Make_Toast('저장하였습니다.');
//         do_refresh();
//
//     } else {
//         console.log('bello123');
//         Make_Toast('저장 실패하였습니다.');
//         do_refresh();
//     }
//     let html = '';
//     // let p_title =
//     $('#p_title').html('거래처 수정');
// }
