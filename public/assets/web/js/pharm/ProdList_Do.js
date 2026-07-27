$(document).ready(function() {

    $('button[name="InMaterial"]').on('click',function(e){
        $('#pop_inMaterial .in_material_con').css({
            height: '480px'
        });
        $('#pop_inMaterial').show();
    });

    $('button[name="OutMaterial"]').on('click',function(e){
        $('#pop_outMaterial .out_material_con').css({
            height: '480px'
        });
        console.log('dawn1052');
        $('#pop_outMaterial').show();
    });

    $('#InXbtn,#InXbtn2').on('click',function(e){
        $('#pop_inMaterial').hide();
    });

    $('#Xbtn,#Xbtn2').on('click',function(e){
        $('#pop_outMaterial').hide();
    });

    $('#v_skey').on('keypress',function(e){
        let skey = $(#v_skey).val();
        if (e.which === 13 || e.keyCode === 13) {
            Ini_V_List();
            Find_Vendor(skey);
        }
    });
});
/////////////////  function ////////////////////////////////////////


function Ini_V_List(){
    $('#v_list').empty();
}

async function Find_Vendor(params){
    const response = await Model.pharm_m.Load_Pharm_VendorForSearch(params);
    const list = response.list;
    const total = response.tcnt;
    let html = '';
    if(total > 0){
        $.each(list, function (index, el) {
            let s_stats = (el.stock_status=='low') ? '<p class="stock_status active">부족</p>' : '<p class="stock_status ">정상</p>';
            html +=` 
                <a>hello?</a>
            `;
        });
    }else{
        html = `
                <a>hello?12</a>
            `;
    }
    $('#v_list').append(html);
}
