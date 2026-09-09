$(document).ready(function(){

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Ini_Form();
        Make_Html(Make_Option());
    });

    $(document).on('click','button[name="open_statement"]',function(){
        // $('#pageArea').data('page',$(this).data('page'));
        // Ini_Form();
        // Make_Html(Make_Option());
        printWindow('org_area');
        console.log('dawn12');

    });

    $("#sdate , #edate").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });

    $('#skey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            $('#pageArea').data('page',1);
            Ini_Form();
            Make_Html(Make_Option());
        }
    });

    $('.period').on('click',function(e){
        e.preventDefault();
        $('.period').removeClass('active');
        $(this).addClass('active');

        const today = new Date();
        let startDate = new Date();
        let endDate = new Date();

        const periodText = $(this).text();

        switch (periodText) {
            case '오늘':
                startDate = today;
                endDate = today;
                break;
            case '1주일':
                startDate = new Date(today);
                startDate.setDate(today.getDate() - 6);
                endDate = today;
                break;
            case '1개월':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 1);
                startDate.setDate(startDate.getDate() + 1);
                endDate = today;
                break;
            case '3개월':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 3);
                startDate.setDate(startDate.getDate() + 1);
                endDate = today;
                break;
            case '6개월':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 6);
                startDate.setDate(startDate.getDate() + 1);
                endDate = today;
                break;
            case '전체':
                startDate = '';
                endDate = '';
                break;
            default:
                startDate = today;
                endDate = today;
        }

        $('#sdate').val(startDate ? formatDate(startDate) : '');
        $('#edate').val(endDate ? formatDate(endDate) : '');
        $('#pageArea').data('page',1);
        Ini_Form();
        Make_Html(Make_Option());
    });

    $('#btnTSearch').on('click',function(){
        $('#pageArea').data('page',1);
        Ini_Form();
        Make_Html(Make_Option());
    });


    const today = new Date();
    $('#sdate').val(formatDate(today));
    $('#edate').val(formatDate(today));
    Make_Html(Make_Option());
});


function Make_Option(){
    return {
        'page' : $('#pageArea').data('page'),
        'pCnt' : $('#pageArea').data('pcnt'),
        'sdate' : $('#sdate').val(),
        'edate' : $('#edate').val(),
        'stype' : $('#stype').val(),
        'vendor' : $('#vendor').val(),
        'skey' : $('#skey').val()
    };
}

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Material_TradeList(params);
    console.log(response);
    const list = response.list;
    const listCnt = response.total;
    const nPage = response.nPage;
    const totalCnt = response.totalRs
    let html = '';
    if(listCnt > 0) {
        $.each(list, function (index, el) {
            let strstock = (el.logtype ==1) ? '구매' : '판매';

            html += `
                 <tr>
                    <td>${el.tcode}</td>
                    <td>${el.mtname}</td>
                    <td>${el.ve_name}</td>
                    <td>${strstock}</td>
                    <td>${el.ve_name}</td>
                    <td>${formatWeight(el.quantity || 0)}</td>
                    <td>${number_format(el.unit_price || 0)}원</td>
                    <td>${number_format(el.price || 0)}원</td>
                    <td>${el.reg_date}</td> 
                    <td class="row receipt">
                        <button type="button" class="btnType1 " name="open_statement"  ><i class="fa-solid fa-receipt"></i></button>
                    </td>
                </tr>
           `;
        });
    }else{
        html = `<tr><td colspan="10">검색된 정보가 없습니다.</td>`;
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

function Ini_Form(){
    $('#dataList').empty();
}































