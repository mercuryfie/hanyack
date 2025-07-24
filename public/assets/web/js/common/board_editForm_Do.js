$(document).ready(function() {

    console.log ('start');


    let bid = $('#title').data('bid');
    let bcode = $('#title').data('bcode');
    console.log('bid='+ bid);
    console.log('bcode='+ bcode);
    // Load_Content();

    $('[name="delImg"]').on('click',function(){
        $(this).closest('.thumBox').hide(); // 또는 .remove()로 완전 삭제
        // let bcode = $(this).data('bcode');
        // del_Reply(bcode);


    });

    $('#deleteBtn').on('click',function () {
        // try {
        //     removeFileFromInput();
        // } catch {
        //
        // }
        // if (removeFileFromInput()) {
        //
        //     $(this).closest('.thumCon').remove();
        //     $('#attachImg').val('');
        // }
        removeFileFromInput();
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
        // e.preventDefault();
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
                        '<button type="button" class="delete-btn" name="delImg">' +
                        '<i class="fa-solid fa-xmark"></i>' +
                        '</button>' +
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

    $("#subbitDel").on('click',function(btn){
        let bid = $('#title').data('bid');
        let bcode = $('#title').data('bcode');
        console.log('yayyyy',bcode);

        if (window.confirm('삭제하시겠습니까?')==true) {
            Del_bContent(bid,bcode);

        }
    });

    $("#submitBtn").on('click',function(e){
        let bTitle = $('#bTitle').val();
        let bContent = $('#bContent').val();
        let tUid = $('#tUid').val();
        let b_uid = $('#b_uid').val();
        let mitype = $('#title').data('mitype');
        let bid = $('#title').data('bid');
        let bcode = $('#title').data('bcode');
        console.log('hello',b_uid  ,tUid );

        if(bTitle==''){
            $('#bTitle').focus();
            Make_Toast('제목을 입력해주세요.');
        }else if(bContent=='') {
            $('#bContent').focus();
            Make_Toast('내용을 입력해주세요.');
        }else if(window.confirm('등록하시겠습니까?')==true) {
            // console.log('hello1052');
            Update_Content(tUid,bid,bcode);
        }
    });
});



function removeFileFromInput(index) {
    const input = document.getElementById('attachedImg');
    const dt = new DataTransfer();
    const files = input.files;
    for (let i = 0; i < files.length; i++) {
        if (i !== index) dt.items.add(files[i]);
    }
    input.files = dt.files;
}

async function del_Reply(bid,bcode) {
    try {
        if (window.confirm('해당 게시글을 삭제하시겠습니까?') == true) {
            start_spinner();
            let dataarr = {"bid" : bid,"bcode" : bcode};
            let url = APIURL + '/del_Reply';
            let result = await Load_API(url,dataarr);
            if (result.get('status') == 'NoLogin') {
                go_login();
            }else if(result.get('status') == 'ok') {
                $(location).attr('href', '/board/bList?bid='+bid);
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

async function Update_Content(tUid,bid,bcode) {
    try {
        let result1 = await Board_data(tUid,bid,bcode);
        // console.log(result1);
        console.log('bello1111111',bid);
        if(result1.result == 'ok'){
            // let bcode = result1.code;
            console.log('bello222222',bcode);

            // if($('#attachImg').val()!='') {
            //     let result2 = await Attached_Img(bcode);
            // }

            Make_Toast('게시글 수정 완료하였습니다.');
            // window.location.href = BOARDURL + '/bList?bid=' + bid;

        } else{
            Make_Toast('2게시글 수정 완료하였습니다.');
            // window.location.href = BOARDURL + '/bList?bid=' + bid;
        }

    } catch (error) {
        Make_Toast('bello.');
        console.log('bello333333');
        console.log( error );
    }
}

function Board_data(tUid,bid,bcode){
    return new Promise(function(resolve, reject) {

        let b_uid = $('#b_uid').val();
        let bTitle = $('#bTitle').val();
        let bContent = $('#bContent').val();
        let btyp = $('[name="btyp"]').val();
        let formdata = new FormData($("#boardForm")[0]);

        formdata.append( "tuid", tUid);
        formdata.append( "bid", bid);
        formdata.append( "bcode", bcode);
        formdata.append( "b_uid", b_uid);
        formdata.append( "btyp", btyp);

        let retarr = new Array();
        for (let pair of formdata.entries()) {
            console.log('bello 15',pair[0]+ ': ' + pair[1]);
        }
        // console.log(formdata);
        // console.log('b1514',Array.from(formdata.entries()));

        $.ajax({
            // url: BOARDURL + '/boardForm_Do',
            url: APIURL + '/Update_Edited_BContent',
            type : 'POST',
            data: formdata,
            dataType: "JSON",
            cache : false,
            // enctype		: 'multipart/form-data',
            processData : false,
            contentType : false,

            success : function(response) {
                let retarr = {};
                if(response.result=='ok'){
                    retarr['status'] = 'ok';
                    retarr['code'] = response.code;
                    retarr['message'] = 'success';
                    resolve(retarr);
                }else{
                    retarr['status'] = 'error';
                    retarr['code'] = response.code;
                    retarr['message'] = response.message;
                    reject(retarr);
                }
            },
            error: function(error) {
                retarr['code'] = 'ConnERR';
                retarr['message'] = error;
                reject(retarr);
            }
        });
    });
}

async function Del_bContent(bid,bcode) {
    try {
        let result1 = await Del_bContent_Data(bcode);
        if(result1.result == 'ok'){
            // let bcode = result1.code;
            console.log('bello222222',bcode);

            // if($('#attachImg').val()!='') {
            //     let result2 = await Attached_Img(bcode);
            // }

            Make_Toast('삭제 완료하였습니다.');
            // window.location.href = BOARDURL + '/bList?bid=' + bid;

        } else{
            Make_Toast('2삭제 완료하였습니다.');
            console.log('bello33',bcode);
            window.location.href = BOARDURL + '/bList?bid=' + bid;
        }

    } catch (error) {
        Make_Toast('bello.');
        console.log('bello333333');
        console.log( error );
    }
}

function Del_bContent_Data(bcode){
    return new Promise(function(resolve, reject) {

        let b_uid = $('#b_uid').val();
        let formdata = new FormData($("#boardForm")[0]);

        formdata.append( "b_uid", b_uid);
        formdata.append( "bcode", bcode);

        let retarr = new Array();
        for (let pair of formdata.entries()) {
            console.log('bello 15',pair[0]+ ': ' + pair[1]);
        }
        // console.log(formdata);
        // console.log('b1514',Array.from(formdata.entries()));

        $.ajax({
            // url: BOARDURL + '/boardForm_Do',
            url: APIURL + '/Del_bContent_Data',
            type : 'POST',
            data: formdata,
            dataType: "JSON",
            cache : false,
            // enctype		: 'multipart/form-data',
            processData : false,
            contentType : false,

            success : function(response) {
                let retarr = {};
                if(response.result=='ok'){
                    retarr['status'] = 'ok';
                    retarr['code'] = response.code;
                    retarr['message'] = 'success';
                    resolve(retarr);
                }else{
                    retarr['status'] = 'error';
                    retarr['code'] = response.code;
                    retarr['message'] = response.message;
                    reject(retarr);
                }
            },
            error: function(error) {
                retarr['code'] = 'ConnERR';
                retarr['message'] = error;
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
        console.log('bello',formdata);

        formdata.append( "bcode", bcode);
        formdata.append("attachedImg",files);
        formdata.append( "key", 'attachedImg');
        formdata.append( "allow", ext);
        formdata.append( "typ",  1);

        let retarr = new Array();
        $.ajax({
            url: APIURL + '/Update_Board_Attachment',
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

function INI_Load_BDetail(){
    $('#inqContentBox').empty();
}