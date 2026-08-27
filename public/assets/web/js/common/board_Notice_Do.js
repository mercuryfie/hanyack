
$(document).ready(function() {

    let bid = $('#title').data('bid');
    // console.log('bid='+ bid);
    Load_Notice(bid,1);

    // $('.contentsBox .title').on('click',function (e) {
    //     e.preventDefault();
    //     bContent_Detail(this);
    //
    // });

    let currentPage = 1;

    $("#more,#more2").on("click", function () {
        // start_spinner();
        let page = $('#more').data('page');
        Load_Notice(bid,page);
        stop_spinner();
    });
});

async function Load_Notice(bid,page) {
    try {
        start_spinner();
        // INI_Load_Notice();
        let dataarr = { 'bid': bid, 'page': page };
        let url = APIURL + '/Load_Board_List';
        let result = await Load_API(url,dataarr);
        console.log(result);

        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let html = '';
            let list = result.get('data').list;
            let data = result.get('data');
            console.log(data);
            let Cnt = list.length;
            let currentCount = $('#noticeList .contentsBox').length;
            if (Cnt > 0) {
                $.each(list, function (index, el) {
                    let mitype = $('#title').data('mitype');
                    console.log('1545',el.uid,mitype);
                    let btnBox = '';
                    if (mitype == 'master') {
                        btnBox = `
                            <div class="btnBox">
                                <button type="button" class="btnType1 mr10 deleteBtn"  
                                        name="delBTn"
                                        onclick="Del_bContent(${el.uid},${el.bid},${el.bcode});">삭제</button>  
                                <button type="button" class="btnType2 editBtn"  
                                        data-tuid="tUid"
                                        data-dbuid="${el.uid}" 
                                        onclick="go_Board_editForm(${el.bid},${el.bcode},${el.uid});">수정</button>
                            </div>  `;

                    } else {
                        btnBox = ``;
                    }
                    if (el.filePath) {
                        filePath = `
                        <img src="${el.filePath}" alt="img" class="attImg">
                        `;
                    } else {
                        filePath = ``;
                    }

                    html += `  
                            <div class="contentsBox"
                                data-dbuid="${el.uid}"
                                data-bcode="${el.bcode}"
                                type="button"
                                style="" id="" name=""
                                onclick="bContent_Detail(this);">
                                <p class="number">${currentCount + index + 1} </p>
                                <p class="type">${el.btyp}</p>
                                <p class="title">${el.bTitle}</p>
                                <p class="writer">${el.userid}</p>
                                <p class="date">${el.regidate.substring(0, 10)}</p>
                            </div>
                            <div class="bContent_Box"
                                data-bcode="${el.bcode}"
                                id="bContent_Detail" name="bContent_Detail"
                                style=""> 
                                ${btnBox}
                                <div class="innerContent">
                                    ${el.bid}/
                                    ${el.bcode}/
                                    <p class="content">                                     
                                    ${el.bContent}
                                    </p>
                                    ${filePath}
                                </div>  
                            </div>
                        `;
                });
            } else{
                `<p>there is no post</p>`;
                console.log('there is no post');
            }
            $('#more,#more2').data('page',result.get('data').page);
            $('#noticeList').append(html);
            stop_spinner();
        }
        // else if (result.get('status') == 'last') {
        //     let tcnt = $('#noticeList .contentsBox').length;
        //     if(tcnt > 0)
        //         Make_Toast('마지막입니다.');
        //     $('.moreListBox').css('display','none');
        //
        // }
        else {
            alert(result.get('message'));
            stop_spinner();
        }
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    } finally {
        stop_spinner();
    }
}


async function Del_bContent(uid,bid,bcode) {
    try {
        if (window.confirm('삭제하시겠습니까?')==true) {
            let result = await Del_bContent_Data(uid,bcode);
            if(result.status == 'ok') {
                window.location.href = BOARDURL + '/bList?bid=' + bid;
                Make_Toast('삭제 완료하였습니다.');

            } else {
                Make_Toast('삭제 완료하였습니다.');

            }
        }

    } catch (error) {
        Make_Toast('에러가 발생하였습니다.'+error);
        console.log( error );
    }
}

function Del_bContent_Data(uid, bcode){
    return new Promise(function(resolve, reject) {


        let formdata = new FormData($("#boardForm")[0]);

        formdata.append( "b_uid", uid);
        formdata.append( "bcode", bcode);

        let retarr = new Array();
        for (let pair of formdata.entries()) {
        }

        $.ajax({
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

function handleDelete(keyValue) {
    if (window.confirm('삭제하시겠습니까?')) {
        // 사용자가 확인을 누르면 API 호출
        fetch('/api/updateTable', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ key: keyValue, isDel: 0 })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // 여기서 테이블 갱신 등 추가 작업 가능
            })
            .catch(error => {
                console.error('Error:', error);
            });
    } else {
        // 취소 시 동작 (선택)
        console.log('Deletion cancelled');
    }
}

async function del_Content(bid,bcode) {
    try {
        if (window.confirm('해당 게시글을 삭제하시겠습니까?') == true) {
            start_spinner();
            let dataarr = {"bid" : bid,"bcode" : bcode};
            let url = APIURL + '/del_Content';
            let result = await Load_API(url,dataarr);
            if (result.get('status') == 'NoLogin') {
                go_login();
            }else if(result.get('status') == 'ok') {
                window.location.href = BOARDURL + '/bList?bid=' + bid;
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

// async function Delete_Content(bid,bcode) {
//     if (window.confirm('삭제하시겠습니까?')) {
//         let dataarr = { 'bid': bid, 'bcode': bcode };
//         let url = APIURL + '/Load_Board_List';
//         let result = await Load_API(url,dataarr);
//         console.log('hello',result);
//         fetch('/api/updateTable', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({ key: keyValue, isDel: 0 })
//         })
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error('Network response was not ok');
//                 }
//                 return response.json();
//             })
//             .then(data => {
//                 console.log('Success:', data);
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//     } else {
//         console.log('Deletion cancelled');
//     }
//
// }

async function Delete_Board(bid,bcode) {

    try {
        start_spinner();
        let bid = $('#title').data('bid');
        let bcode = $('.contentsBox').data('bcode');
        let dataarr = { 'bid': bid, 'page': page };
        let url = APIURL + '/Load_Board_List';
        let result = await Load_API(url,dataarr);
        console.log(result);

        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let html = '';
            let list = result.get('data').list;
            let data = result.get('data');
            console.log(data);
            let Cnt = list.length;
            let currentCount = $('.contentsBox').length;
            if (Cnt > 0) {
                $.each(list, function (index, el) {
                    html += `  
                            <div class="contentsBox"
                                data-dbuid="${el.uid}"
                                data-bcode="${el.bcode}"
                                type="button"
                                style="" id="" name=""
                                onclick="bContent_Detail(this);">
                                <p class="number">${currentCount + index + 1} </p>
                                <p class="type">${el.btyp}</p>
                                <p class="title">${el.bTitle}</p>
                                <p class="writer">${el.userid}</p>
                                <p class="date">${el.regidate.substring(0, 10)}</p>
                            </div>
                            <div class="bContent_Box"
                                data-bcode="${el.bcode}"
                                id="bContent_Detail" name="bContent_Detail"
                                style="">
                                <div class="innerContent">
                                ${el.bid},
                                    ${el.bcode}
                                    ${el.bContent} <br>
                                    ${el.filePath ? `<img src="${el.filePath}" alt="img" class="attImg">` : ''} 
                                </div>
                                <div class="btnBox">
                                    <button type="button" class="btnType2" 
                                           id="deleteBtn" name="deleteBtn"
                                           onclick="Delete_Content(${el.bid},${el.bcode});">삭제</button> 
                                    <button type="button" class="btnType1" 
                                            id="editBtn" name="editBtn" 
                                            onclick="go_Board_editForm(${el.bid},${el.bcode});">수정</button> 
                                </div>
                            </div>
                        `;
                });
            } else{
                `<p>there is no post</p>`;
                console.log('there is no post');
            }
            $('#more,#more2').data('page',result.get('data').page);
            $('#noticeList').append(html);
            stop_spinner();
        }
            // else if (result.get('status') == 'last') {
            //     let tcnt = $('#noticeList .contentsBox').length;
            //     if(tcnt > 0)
            //         Make_Toast('마지막입니다.');
            //     $('.moreListBox').css('display','none');
            //
        // }
        else {
            alert(result.get('message'));
            stop_spinner();
        }
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    } finally {
        stop_spinner();
    }
}

function bContent_Detail(btn,e){
    if(e) e.preventDefault();

    let bcode = $(btn).data('bcode');
    $('[name="bContent_Detail"]').each(function(){
        if($(this).data('bcode') == bcode){ // 여기서 this 는 bContent 상자
            $(this).toggle();
        } else {
            $(this).hide();
        }
    });
}

function INI_Load_Notice(){
    $('#noticeList').empty();
}


