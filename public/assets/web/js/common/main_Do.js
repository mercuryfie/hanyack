$(document).ready(function () {

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

    $('#btnHSearch').on('click',function(){
        const skey = $('#h_sKey').val();
        if(skey==''){
            Make_Toast('검색어를 입력하세요.');
            $('#h_sKey').focus();
            return;
        }
        Search_Product(skey);
    });

    $('#h_sKey').on('keypress',function(e){
        if (e.which === 13 || e.keyCode === 13) {
            const skey = $('#h_sKey').val();
            if(skey==''){
                Make_Toast('검색어를 입력하세요.');
                $('#h_sKey').focus();
                return;
            }
            Search_Product(skey);
        }
    })


    Make_Html();

});

async function Make_Html(){
    let response = await Model.common_m.Load_Herb_ListByMain();
    console.log(response);
    let hotList = response.hot;
    let hotCnt = response.hotCnt;
    let specialList = response.special;
    let specialCnt = response.speCnt;
    let djmediList = response.djmedi;
    let djcnt = response.djcnt;
    let hotHtml = '';
    let specialHtml = '';
    let djmediHtml = '';
    if(hotCnt > 0){
        $.each(hotList, function(index, el) {
            let AuthCss3 = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'auth-style' : 'guest-style';
            let Auth = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'agree' : 'disagree';
            let AuthCss = (!el.Auth||el.Auth == AUTH_PHARM) ? 'guest-style' : 'auth-style';
            let subhtml1 = '';
            let subhtml2 = '';
            let subhtml3 = '';
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
                subhtml3 =`
                        <div class="price_box flexType2">
                            <p class="price mr10" >${number_format(el.price || 0)}원</p>
                            <span class="calc">(근당 ${number_format(el.gunPrice || 0)}원) </span>
                        </div>    
                `;
            }


            hotHtml +=`
                <div class="mer_wrap_type4 ${AuthCss}">
                        <div class="thumbox " type="button" name="btnPDetail" data-hncode="${el.hncode}">
                            <img class="mainthum" src="/assets/product/image/${el.fname}" alt="img">
                        </div>
                        ${subhtml1}
                        <div class="itembox" onclick="">
                            <div class="ttl_box flexType3 ">
                                <p class="title" >[${el.n_value}] ${el.hn_name} ${el.w_name} </p>
                                ${subhtml2} 
                            </div>
                            ${subhtml3}
                        </div>
                        <div class="tagbox flexType2 ${el.flexType}">
                            <p style="" class="type t1_type">
                                ${el.mi_name}
                            </p>
                            <p style="" class="type ">
                                ${el.unitName}
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

            $('#mainTyp1, #mainTyp2')
                .removeClass('guest-style auth-style')
                .addClass(AuthCss);
        });
        $('#hotList').append(hotHtml);
    }


    if(specialCnt > 0){
        $.each(specialList, function(index, el) {
            let AuthCss = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'auth-style' : 'guest-style';
            let Auth = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'agree' : 'disagree';
            let subhtml1 = '';
            let subhtml2 = '';
            let subhtml3 = '';
            let like = '';
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
                subhtml3 =`
                        <div class="price_box flexType2">
                            <p class="price mr10" >${number_format(el.price || 0)}원</p>
                            <span class="calc">(근당 ${number_format(el.gunPrice || 0)}원) </span>
                        </div>    
                `;
            }

            specialHtml +=`
                <div class="mer_wrap_type4 ${AuthCss}">
                        <div class="thumbox " type="button" name="btnPDetail" data-hncode="${el.hncode}">
                            <img class="mainthum" src="/assets/product/image/${el.fname}" alt="img">
                        </div>
                        ${subhtml1}
                        <div class="itembox" onclick="">
                            <div class="ttl_box flexType3-1 ">
                                <p class="title">[${el.n_value}] ${el.hn_name} ${el.w_name}</p>
                                ${subhtml2}
                            </div>
                            ${subhtml3} 
                        </div>
                        <div class="tagbox flexType2 ${el.flexType}">
                            <p style="" class="type t1_type"> 
                                ${el.mi_name}
                            </p>
                            <p style="" class="type ">
                                ${el.unitName}
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

            $('#mainTyp1, #mainTyp2')
                .removeClass('guest-style auth-style')
                .addClass(AuthCss);
        });
        $('#specialList').append(specialHtml);
    }

    if(djcnt > 0){
        $.each(djmediList, function(index, el) {
            let AuthCss = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'auth-style' : 'guest-style';
            let Auth = ((el.Auth == AUTH_DECOC) || (el.Auth == AUTH_MASTER)) ? 'agree' : 'disagree';
            let subhtml1 = '';
            let subhtml2 = '';
            let subhtml3 = '';
            let like = '';
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
                subhtml3 =`
                        <div class="price_box flexType2">
                            <p class="price mr10" >${number_format(el.price || 0)}원</p>
                            <span class="calc">(근당 ${number_format(el.gunPrice || 0)}원) </span>
                        </div>    
                `;
            }

            djmediHtml +=`
                <div class="mer_wrap_type4 ${AuthCss}">
                        <div class="thumbox " type="button" name="btnPDetail" data-hncode="${el.hncode}">
                            <img class="mainthum" src="/assets/product/image/${el.fname}" alt="img">
                        </div>
                        ${subhtml1}
                        <div class="itembox" onclick="">
                            <div class="ttl_box flexType3-1 ">
                                <p class="title">[${el.n_value}] ${el.hn_name} ${el.w_name}</p>
                                ${subhtml2}
                            </div>
                            ${subhtml3} 
                        </div>
                        <div class="tagbox flexType2 ${el.flexType}">
                            <p style="" class="type t1_type"> 
                                ${el.mi_name}
                            </p>
                            <p style="" class="type ">
                                ${el.unitName}
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
        $('#djmediList').append(djmediHtml);
    }
}


































