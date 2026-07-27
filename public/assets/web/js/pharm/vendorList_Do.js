$(document).ready(function() {
    let params = {
        page: 1,
        pcnt: 30,
        skey: ''
    };
    Load_VendorList(params);

    $("#v_skey").on("keypress", function () {
        INI_VendorList();
        let skey = $('#v_skey').val();
        Load_VendorList(skey);
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

        $('#pop_AddVendor').show();
        $('#pop_AddVendor .input_type.v_name').focus();
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


function INI_VendorList(){
    $('#v_list').empty();
}

function INI_CustomerList(){
    $('#c_list').empty();
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
            let html = ` 
            
                <tr class="status ">
                    <td>${el.ve_name}</td>
                    <td>${el.ve_busino}</td>
                    <td>${el.ve_busitel}</td>
                    <td>${el.ve_email}</td>
                    <td>${el.ve_busiemail}</td>
                    <td>${el.ve_busiaddr1}</td>
                    <td>${el.ve_busiaddr2}</td>
                    <td>${el.ve_desc}</td>
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

