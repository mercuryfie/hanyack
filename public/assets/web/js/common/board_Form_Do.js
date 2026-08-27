$(document).ready(function() {

    console.log ('start');
    let bid = $('#title').data('bid');
    // Load_Faq(bid,1);


    $('#deleteBtn').on('click',function () {
        $(this).closest('.thumCon').remove();
        $('#attachImg').val('');

    });

    $('#attachedImg').on('click', function(e) {
        let thumbCount = $('[name="thumPreview"]').length;
        if (thumbCount >= 3) {
            Make_Toast('이미지는 최대 3장까지 등록 가능합니다.');
            e.preventDefault(); // 파일 선택창 안 뜨게 막음
            return false;
        }
    });

    $('#attachedImg').on('change', function(e) {
        let files = e.target.files;
        let thumbCount = $('[name="thumPreview"]').length;

        if (thumbCount + files.length > 3) {
            Make_Toast('이미지는 최대 3장까지 등록 가능합니다.');
            $(this).val(''); // 파일 선택 취소
            return;
        }
        for (let i = 0; i < files.length; i++) {
            if (files[i].type.match('image.*')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let $thumb = $('<div class="thumBox" name="thumPreview">' +
                        '<img src="' + e.target.result + '" alt="img" class="addedImg">' +
                        '<button type="button" class="delete-btn"><i class="fa-solid fa-xmark"></i></button>' +
                        '</div>');
                    $('#thumbArea').append($thumb);
                    $thumb.find('.delete-btn').on('click', function() {
                        $(this).closest('.thumBox').remove();
                    });
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });




    $("#hello").on('click',function(bcode){

        // let abc = Attached_Img(bcode);
        console.log('hello'+ bcode);
        console.log('bcode:', bcode)
        // let files = $("#attachedImg")[0].files;
        // for (let i = 0; i < 3; i++) {
        //     console.log(files[i]); // 파일 객체 정보 출력
        // }
        // for (let pair of formdata.entries()) {
        //     console.log(pair[0],f pair[1]); // key, value 모두 확인
        // }


        // if (result2.status == 'ok') {

    });

    $("#submitBtn").on('click',function(e){
        let bTitle = $('#bTitle').val();
        let bContent = $('#bContent').val();

        if(bTitle==''){
            $('#bTitle').focus();
            Make_Toast('제목을 입력해주세요.');
        }else if(bContent=='') {
            $('#bContent').focus();
            Make_Toast('내용을 입력해주세요.');
        }else if(window.confirm('등록하시겠습니까?')==true) {
            // console.log('hello1052');
            Upload_Content();
        }
    });
});

async function Upload_Content() {
    try {
        let result1 = await Board_data();
        let bid = $('#title').data('bid');
        if(result1.status = 'ok'){
            let bcode = result1.code;
            let files = $("#attachedImg")[0].files[0];
            if(files.size > 0){
                let result2 = await Attached_Img(bcode);
                if (result2.status = 'ok') {
                    Make_Toast('등록하였습니다.');
                    window.location.href = BOARDURL + '/bList?bid=' + bid;
                } else {
                    alert(result2.msg);
                }
            } else{
                Make_Toast('등록하였습니다.');
                window.location.href = BOARDURL + '/bList?bid=' + bid;
            }
        }else{
            alert(result1.msg);
        }
    } catch (error) {
        alert(error);
        console.log( error );
    }
}

function Board_data(){
    return new Promise(function(resolve, reject) {

        let puid = $('#p_uid').val();
        let formdata = new FormData($("#boardForm")[0]);
        let retarr = new Array();

        $.ajax({
            // url: BOARDURL + '/boardForm_Do',
            url: APIURL + '/Insert_BContent',
            type : 'POST',
            data: formdata,
            dataType: "JSON",
            cache : false,
            processData : false,
            contentType : false,
            success : function(response) {
                if(response.result=='ok'){
                    retarr['status'] = 'ok';
                    retarr['code'] = response.code;
                    retarr['msg'] = 'success';
                    resolve(retarr);
                }else{
                    retarr['status'] = 'error';
                    retarr['code'] = '';
                    retarr['msg'] = response.message;
                    reject(retarr);
                }
            },
            error: function(error) {
                retarr['code'] = 'ConnERR';
                retarr['msg'] = error;
                reject(retarr);
            }
        });
    });
}


function Attached_Img(bcode){
    return new Promise(function(resolve, reject) {

        let ext = $('#attachedImg').data('ext');
        let formdata = new FormData();

        let files = $("#attachedImg")[0].files[0];

        formdata.append( "bcode", bcode);
        formdata.append("attachedImg",files);
        formdata.append( "key", 'attachedImg');
        formdata.append( "allow", ext);
        formdata.append( "typ",  1);

        let retarr = new Array();
        $.ajax({
            url: APIURL + '/Upload_Board_Attachment',
            type : 'POST',
            data: formdata,
            enctype		: 'multipart/form-data',
            processData : false,
            contentType : false,
            success : function(response) {
                console.log(response);
                if(response.result=='ok'){
                    retarr['status'] = 'ok';
                    retarr['msg'] = 'success';
                    resolve(retarr);
                }else{
                    retarr['status'] = 'error';
                    retarr['msg'] = response.msg;
                    reject(retarr);
                }
            },
            error: function(error) {
                retarr['code'] = 'DBERROR';
                retarr['msg'] = error;
                resolve(retarr);
            }
        });
    });
}

async function del_Content(bid,bcode) {
    try {
        if (window.confirm('선택되신 약재의 매칭을 삭제하시겠습니까?') == true) {
            start_spinner();
            let dataarr = {"bid" : bid,"bcode" : bcode};
            let url = APIURL + '/del_Content';
            let result = await Load_API(url,dataarr);
            if (result.get('status') == 'NoLogin') {
                go_login();
            }else if(result.get('status') == 'ok') {
                $(location).attr('href', '/Order/SmartOrder');
            }else{
                alert(result.get('message'));
            }
            stop_spinner();
        }
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}


function INI_Load_BoardForm(){
    $('#boardForm').empty();
}

function on_notiTypeMethod(val){
    $('#notiTypeMethod').val(val);
}

function on_faqTypeMethod(val){
    $('#faqTypeMethod').val(val);
}

function on_inqTypeMethod(val){
    $('#inqTypeMethod').val(val);
}