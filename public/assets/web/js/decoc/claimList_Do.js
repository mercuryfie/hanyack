$(document).ready(function () {
    let page = 0;
    let search = [];
    Load_Claim(page,search);


});


async function Load_Claim(page,s_arr){
    let retval = false;
    try {
        start_spinner();
        let dataarr = {"page":page,"search" : s_arr};
        let url = APIURL + '/Load_Claim_Info';
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            let html = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr, function (index, el) {
                    html += `
                        <div class="claimList_boxarv">
                            <div class="upside">
                                <p class="status">${Return_Step_Name(el.rtyp)}</p>
                                <div class="flexType2">
                                    <p class="title mr10">주문번호</p>
                                    <p class="odcode mr10">${el.fk_odcode}</p>
                                    <i class="fa-solid fa-paste"></i>
                                </div>
                            </div>
                            <div class="downside">
                                <div class="el_boxzzl">
                                    <p class="">[${Order_Type_Name(el.gd_pType)}] [${el.mi_name}] ${el.hn_name} (${el.option_str})</p>
                                    <div class="flexType2">
                                        <p class="price mr10">${number_format(el.gd_price)}원</p>
                                        <p class="unit">${number_format(el.gd_cnt)}개</p>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    `;
                });
            }else{
                Make_Toast('검색된 내용이 없습니다.');
            }
            $('#cList').append(html);
            retval = true;
        }else{
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    }catch (e) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + e + '}');
        stop_spinner();
    }
    return retval;
}
