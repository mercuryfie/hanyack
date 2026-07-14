$(document).ready(function () {

    $(document).on('click','button[name="btnLinkPaging"]',function(){
        Form_ini();
        $('#pageArea').data('page',$(this).data('page'));
        Make_Html(Make_Option());
    });

    $('#btnHSearch').on('click',function(){
        Form_ini();
        $('#pageArea').data('page',$(this).data('page'));
        Make_Html(Make_Option());
    });

    $('#h_sKey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            Form_ini();
            $('#pageArea').data('page',$(this).data('page'));
            Make_Html(Make_Option());
        }
    })

    $(document).on('click','div[name="btnPDetail"]',async function(){
        const hncode = $(this).data('hncode');
        go_detail(hncode,1);
    });

    $(document).on('click','button[name="addCart"]',async function(){
        const hncode = $(this).data('code');
        let rCountVal = $(this).data('cnt');
        if(window.confirm('장바구니에 담으시겠습니까?')==true) {
            let params = {code: hncode, cnt: rCountVal};
            let response = await Model.decoc_m.Insert_Decoc_Cart(params);
            if(response.effect > 0){
                if(window.confirm("완료 하였습니다.\n장비구니로 이동하시겠습니까?")==true){
                    go_cart();
                }
            }
        }
    });

    $(document).on('click','div[name="btnLike"]',async function(){
        let code = $(this).data('code');
        let act = $(this).data('act');
        let params = {code:code,act:act};
        let response = await Model.decoc_m.Process_Herb_Like(params);
        console.log(response);
        if(response.effect > 0){
            if(act==1){
                $(this).addClass('active');
                $(this).find('.wishHeart').removeClass('fa-regular').addClass('fa-solid fa-heart wishHeart active');
                $(this).data('act',2);
            }else{
                $(this).removeClass('active');
                $(this).find('.wishHeart').removeClass('active fa-solid').addClass('fa-regular fa-heart wishHeart');
                $(this).data('act',1);
            }
        }
    });


    Make_Html(Make_Option());
});


function Make_Option(){
    return {
        'pcnt' : $('#pageArea').data('pcnt'),
        'page' : $('#pageArea').data('page'),
        'skey' : $('#h_sKey').val()
    };
}

function Form_ini(){
    $('#herblist').empty();
}



async function Make_Html(params){
    let response = await Model.common_m.Load_Herb_ListAll(params);
    console.log(response);
    let tcnt = response.total;
    let list = response.list;
    let mTotal = response.totalRs;
    let nPage = response.nPage;
    let html = '';
    if(tcnt > 0){
        $.each(list, function(index, el) {
            let AuthCss = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'auth-style' : 'guest-style';
            let Auth = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'agree' : 'disagree';
            let subhtml1 = '';
            let subhtml2 = '';
            let like = '';
            let like1 = '';
            let likeDo = 1;
            let flexType = '';
            let t1_str = (el.t1_value=='') ? 'display: none;' : '';
            let t2_str = (el.t2_value=='') ? 'display: none;' : '';
            if(Auth=='disagree'){
                flexType = 'pt10';
            }
            if(el.hn_like == 0){
                like = '';
                like1 = 'fa-regular fa-heart wishHeart';
                likeDo = 1;
            }else{
                like = 'active';
                like1 = 'fa-solid fa-heart wishHeart active';
                likeDo = 2;
            }
            if(Auth=='agree'){
                subhtml1 = `
                        <div class="cartbtn_box flexType1">
                            <button type="button" class="cartbtn flexType1" name="addCart" data-code="${el.hncode}" data-cnt="1">
                                <i class="fa-solid fa-cart-shopping icon2"></i>
                                <p class="text">담기</p>
                            </button>
                        </div>
                    `;
                subhtml2=`
                            <div class="wishHeartBox flexType1 ${like}" name="btnLike" data-code="${el.hncode}" data-act="${likeDo}">
                                <i class="${like1}" id=""></i>
                            </div>
                    `;
            }


            html +=`
                    <div class="mer_wrap_type4 ${AuthCss}">
                            <div class="thumbox " type="button" name="btnPDetail" data-hncode="${el.hncode}">
                                <img class="mainthum" src="/assets/product/image/${el.fname}" alt="img">
                            </div>
                            ${subhtml1}
                            <div class="itembox" onclick="">
                                <div class="ttl_box flexType3 ">
                                    <p class="title" >[${el.n_value}] ${el.hn_name} ${el.w_name}</p>
                                    ${subhtml2} 
                                </div>
                                <div class="price_box flexType2">
                                    <p class="price mr10">${number_format(el.price || 0)}원</p>
                                    <span class="calc">(근당 ${number_format(el.gunPrice || 0)}원) / (기본단위: ${el.unitName})</span>
                                </div>
                            </div>
                            <div class="tagbox flexType2 ${el.flexType}">
                                <p style="" class="type t1_type">
                                    ${el.mi_name}
                                </p>
                                <p style="${t1_str}" class="type ">
                                    ${el.t1_value}
                                </p>
                                <p style="${t2_str}" class="type ">
                                    ${el.t2_value}
                                </p>
                            </div>
                        </div>
                `;
        });
        $('#herblist').append(html);
        $('#totalRs').text(mTotal);
        let options = {
            page : $('#pageArea').data('page'),
            total : mTotal,
            perpage : $('button[name="pCnt"].active').data('pval'),
            bname : 'btnLinkPaging'
        }
        $('#pageArea').html(Make_Page_Html('simple',options));
    }else{
        html = `검색된 약재가 없습니다. `;
        $('#r_txt').text('');
        $('#totalRs').text('0');
        $('#herblist').append(html);
    }
}