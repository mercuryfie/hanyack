$(document).ready(function () {
    $('#userid , #passwd').on("keypress", function (key) {
        if (key.keyCode == 13) {
            Login_Do();
        }
    });
});


function Login_Do(){
    var userid = $('#userid').val();
    var pwd = $('#passwd').val();
    if(userid ==''){
        alert('아이디를 입력하세요');
        $('#userid').focus();
    }else if(pwd ==''){
        alert('비밀번호를 입력하세요.');
        $('#passwd').focus();
    }else{
        var iskeep = 0;
        if($('input:checkbox[name="autolg"]').is(":checked") == true){
            iskeep = 1;
        }

        var issave = 0;
        if($('input:checkbox[name="saveid"]').is(":checked") == true){
            issave = 1;
        }
        Login_proc(userid,pwd,iskeep,issave);
    }

}

async function Login_proc(userid,pwd,iskeep,issave){
    try{
        start_spinner();
        let dataarr = {"userid": userid, "passwd": pwd,'iskeep' : iskeep,'issave' : issave};
        console.log(dataarr);
        let url = "/Member/Login_Do";
        let result = await Load_API(url,dataarr);
        if(result.get('status') == 'ok') {
            let returl = $('#redirect_url').val();
            if(returl==''){
                $(location).attr('href','/');
            }else{
                $(location).attr('href',returl);
            }
        } else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    }catch(error){
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}
