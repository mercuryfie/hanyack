$(document).ready(function(){

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Ini_Form();
        Make_Html(Make_Option());
    });

    $("#sdate , #edate").on("click", function () {
        if (this.showPicker) {
            this.blur();
            this.showPicker();
        }
    });

    $('#btnSearch').on('click',function(){
        $('#pageArea').data('page',$(this).data('page'));
        Ini_Form();
        Make_Html(Make_Option());
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
    });

    Make_Html(Make_Option());
});


function Make_Option(){
    return {
        'page' : $('#pageArea').data('page'),
        'sdate' : $('#sdate').val(),
        'edate' : $('#edate').val(),
        'pCnt' : $('#pageArea').data('pcnt'),
        'searchType' : $('#searchType').val(),
        'mtcode' : $('#mtcode').text()
    };
}

async function Make_Html(params){
    const response = await Model.pharm_m.Load_Pharm_Material_Log(params);
    const list = response.list;
    const listCnt = response.total;
    const nPage = response.nPage;
    const totalCnt = response.totalRs
    let html = '';
    if(listCnt > 0) {
        $.each(list, function (index, el) {
            let strstock = (el.m_input > 0) ? '입고' : '출고';
            html += `
                <tr>
                    <td>${el.indate}</td>
                    <td>${formatWeight(el.total)}</td>
                    <td>${strstock}</td>
                    <td>${Material_InStock_Reason(el.reason)}</td>
                    <td>${el.memo}</td>
                </tr>
                `;
        });
    }else{
        html = `<tr><td colspan="5">등록된 입출고 로그가 없습니다.</td>`;
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































