$(document).ready(function () {

    $(document).on('click','.wishHeartBox',async function(){
        let code = $(this).data('code');
        let ptype = $(this).data('ptype');
        let act = $(this).data('act');
        if(Like_Do(code,ptype,act)){
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

    $(document).on('click','#addCart',function(){
        let code = $(this).data('code');
        let cnt = $(this).data('cnt');
        let ptype = $(this).data('ptype');

        if((code!='') && (cnt!='') && (ptype!='')) {
            let items = [];
            items.push({code: code, cnt: cnt, ptyp: ptype});
            let str = JSON.stringify(items);
            Herb_Cart_Do(str);
            Make_Toast('장바구니에 담았습니다.');
        }else{
            Make_Toast('잘못된 접근입니다..[Error101]');
        }
    });
});


async function Like_Do(code,ptype,act){
    let bool = false;
    try {
        start_spinner();
        let dataarr = {"code": code,'ptype' : ptype,"act":act};
        let url = APIURL + '/Like_Do';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            bool = true;
        }else{
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error.get('message') + '}');
        stop_spinner();
    }
    return bool;
}

async function Herb_Cart_Do(str){
    try{
        start_spinner();
        let dataarr = {"str" : str};
        let url = APIURL + '/Insert_Cart';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            $('#popcart').css('display','flex');
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();

    }catch(error){
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }

}