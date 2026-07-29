$(document).ready(function() {

    $('button[name="InMaterial"]').on('click',function(e){
        $('#pop_inMaterial .in_material_con').css({
            height: '480px'
        });
        $('#pop_inMaterial').show();
    });
    // dd

    $('button[name="OutMaterial"]').on('click',function(e){
        $('#pop_outMaterial .out_material_con').css({
            height: '480px'
        });
        console.log('dawn1052');
        $('#pop_outMaterial').show();
    });

    $('button[name="prod_herb"]').on('click',function(e){
        // $('#pop_produce_herb .pop_produceherb_con').css({
        //     width: '780px',
        //     height: '600px'
        // });
        console.log('dawn105233');
        Make_Html();
        $('#pop_produce_herb').show();

    });

    $('#pop_produce_herb #Xbtn, #pop_produce_herb #Xbtn2').click(function () {
        $('#pop_produce_herb').hide();
    });


    $('#InXbtn,#InXbtn2').on('click',function(e){
        $('#pop_inMaterial').hide();
    });

    $('#Xbtn,#Xbtn2').on('click',function(e){
        $('#pop_outMaterial').hide();
    });

    // $('#v_skey').on('keypress',function(e){
    //     let skey = $(#v_skey).val();
    //     if (e.which === 13 || e.keyCode === 13) {
    //         Ini_V_List();
    //         Find_Vendor(skey);
    //     }
    // });
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
            // let params = {
            //     mtcode:el.mtcode,
            //     mtname:el.mtname,
            //     opimal_stock:el.opimal_stock,
            //     waste_rate:el.waste_rate,
            //     memo:el.memo
            //     // waste_rate:${el.waste_rate}
            // };
            const params = [
                {
                    mtcode:el.mtcode,
                    mtname:el.mtname,
                    optimal_stock:el.optimal_stock,
                    waste_rate:el.waste_rate,
                    memo:el.memo
                }
            ];
            console.log('params1:',params);
            const e_params = encodeURIComponent(JSON.stringify(params));
            console.log('params2:',e_params);
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
                        <button type="button" class="btnType1" name="btnMtEdit" data-params="${e_params}" onclick="Edit_Material(this);" >
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

// function Produce_Herb(){
//     $('#pop_producelog_herb').hide();
//     $('#pop_produce_herb').show();
//     console.log('hello?');
//
// }


function Make_Option(){
    return {
        'page' : $('#pageArea').data('page'),
        'pCnt' : $('#pageArea').data('pcnt'),
    };
}