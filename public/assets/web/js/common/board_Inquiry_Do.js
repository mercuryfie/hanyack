
$(document).ready(function() {

    console.log('start');

    $('#hello').on('click',function () {
        console.log('tUid = ',$('#tUid').val());
        console.log('b_uid = ',$('#b_uid').val());

    });

    let bid = $('#title').data('bid');
    console.log('bid='+ bid);
    console.log('tUid = ',$('#tUid').val());
    console.log('b_uid = ',$('#b_uid').val());
    Load_Inquiry(bid,1);


    $('#closeThum').on('click',function(e){
        Ini_popThum();
        $('#thumPopCon').hide();
    });

    $('#thumPopCon').on('click', function(e) {
        if (e.target === this) {
            $(this).hide();
        }
    });

    $("[name='delBtn']").on('click',function(btn){
        let bid = $('#title').data('bid');
        let bcode = $('#title').data('bcode');
        console.log('yayyyy',bcode);

        if (window.confirm('삭제하시겠습니까?')==true) {
            Del_bContent(bid,bcode);

        }
    });


    $('[name="inqTitle"]').on('click', function() {
        let bcode = $(this).data('bcode');
        let $target = $('[name="bContent_Detail"][data-bcode="' + bcode + '"]');

        $('[name="bContent_Detail"]').not($target).slideUp(100);

        $target.stop(true, true).slideToggle(400);
    });



    // $('#titi_box').css('color','red');
});



async function Load_Inquiry(bid,page) {
    try {
        start_spinner();
        INI_Load_Inquiry();
        let dataarr = { 'bid': bid, 'page': page };
        let tUid = $('#tUid').val();
        let url= APIURL + '/Load_Board_List';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            let html = '';
            let list = result.get('data').list;
            let Cnt = list.length;

            if (Cnt > 0) {
                $.each(list, function (index, el) {

                    let mitype = $('#title').data('mitype');
                    // let mitype = $('#title').data('bid');
                    let replybtn = '';

                    let matchCount = list.filter(el => el.uid == tUid).length;
                    if (matchCount <= 0) {
                        $('#moreBox').html('<p class="ifNull">게시글이 없습니다. </p>');
                    } else if (matchCount >= 1 && matchCount <= 15) {
                        $('#moreBox').hide();
                    }

                    if (mitype == 'master') {
                        // const rContent1 = reply.rContent;
                        replybtn = `
                            <div class="status">
                                <button type="button" class="btnType1" 
                                data-bcode="" 
                                name=""
                                onclick="go_replyForm('${bid}','${el.bcode}');">답변</button>
                            </div>`;

                    }

                    if (tUid == el.uid) {
                        console.log(el.uid);
                        // const rContent1 = reply.rContent;
                        btnBox = `
                            <div class="btnBox">
                                <button type="button" class="btnType1 mr10 deleteBtn"  
                                        name="delBTn"
                                        onclick="Del_bContent(${el.bid},${el.bcode});">삭제</button>  
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
                        <button class="glassBtn" type="button" 
                                id="glassBtn" name="glassBtn"
                                onclick="imageload('${el.filePath}');">
                          <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <img src="${el.filePath}" alt="img" class="attImg"> 
                        `;
                    } else {
                        filePath = ``;
                    }

                    let reply = '';

                    let list2 = el.reply;
                    let Cnt2 = list2.length;
                    let rContent2 ='';
                    if (Cnt2 > 0) {
                        $.each(list2, function (index2, el2) {
                            rContent2 += `
                            <div class="det-inquiry-a flexCol">
                                <div class="flexType2 flexType4">
                                    <p class="icon">A</p>
                                    <p class="a-desc">${el2.rContent}
                                    </p>
                                </div>
                                <p class="p40 color5c">
                                ${el2.regidate.split(' ')[0]}
                                </p> 
                            </div>   `;
                        });
                        console.log('1731',Cnt2);
                    }


                    // ${el.reply.regidate.split(' ')[0]}

                    html += ` 
                        ${el.mitype === 'master' || el.uid === tUid ? `
                        <div class="contentsBox"
                            data-dbuid="${el.uid}"
                            data-bcode="${el.bcode}"
                            type="button"
                            style="" id="" name="inqTitle"
                            onclick="bContent_Detail(this);">
                            <p href="#" class="title">${el.bTitle}</p>
                            <p class="date">${el.regidate.substring(0, 10)}</p>
                            <p class="writer">${el.userid}</p>
                            ${replybtn}
                        </div>
                        <div class="bContent_Box"
                            data-bcode="${el.bcode}"
                            id="" name="bContent_Detail"
                            style="">  
                            ${btnBox}
                            <div class="answerBox " id="answer-view" name="answer-view">
                                <div class="det-inquiry-q">
                                    <p class="icon">Q</p>
                                    <p class="q-desc"> ${el.bid},${el.bcode}, ${el.bContent}
                                    </p>
                                </div>   
                                ${rContent2}
                            </div>     
                            <div class="thumCon" id="" name="">
                                <div class="thumBox" name="thumPreview">  
                                    ${filePath}
                                     
                                </div>
                           </div>
                            
                           </div>` : ''}
                               
                        `;

                });
            }
            else {
                console.log('there is no post');
            }
            $('#inquiryList').append(html);
        } else {
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

async function Del_bContent(bid,bcode) {
    try {
        if (window.confirm('삭제하시겠습니까?')==true) {
            let result = await Del_bContent_Data(bcode);
            if (result.status == 'ok') {
                // console.log(result.data);
                // window.location.href = BOARDURL + '/bList?bid=' + bid;
                // Make_Toast('삭제 완료하였습니다.');
                location.reload();
            } else {
                alert(result.msg);
            }
        }


    } catch (error) {
        console.log( error );
    }
}

function Del_bContent_Data(bcode){
    return new Promise(function(resolve, reject) {

        let b_uid = $('#b_uid').val();

        let data = {
            "b_uid":b_uid,
            "bcode":bcode,
        };
        console.log (data);
        let formdata = new FormData($("#boardForm")[0]);

        formdata.append( "b_uid", b_uid);
        formdata.append( "bcode", bcode);

        let retarr = new Array();
        // for (let pair of formdata.entries()) {
        //     console.log('bello 15',pair[0]+ ': ' + pair[1]);
        // }

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



async function Load_BContent_Reply(bid,page) {
    try {
        console.log('hello', url);
        start_spinner();
        INI_Load_bContent();
        let dataarr = { 'bid': bid, 'page': page };
        let tUid = $('#tUid').val();
        let url= APIURL + '/Load_Board_List';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        }else if(result.get('status') == 'ok') {
            console.log('1901', result.get('data').list);
            let list = result.get('data').list;
            let Cnt = list.length;

            let html = '';

            if (Cnt > 0) {
                $.each(list, function (index, el) {

                    let mitype = $('#title').data('mitype');
                    let bContent = '';

                    if (mitype == 'master') {
                        url = "/Board/editForm?bid=" + bid +"&bcode="+bcode;
                        $(location).attr("href", url);
                        bContent = `
                           <div class="inq_box1"
                                data-dbuid="${el.uid}"
                                data-bcode="${el.bcode}"
                            
                            >
                                <p class="title">문의 제목</p>
                                <p class="">${el.bTitle}</p>
                            </div>
                            <div class="inq_box1 ">
                                <p class="title">문의 내용</p>
                                <p class="bContent inq_box_scroll"> 
                                </p>
            
                            </div> 
                    `;
                    }
                    html += `  
                            ${el.mitype === 'master' ? `
                            ${bContent}
                              `:''} 
                            
                            `;


                });
            }
            else {
                console.log('there is no post');
            }
            $('#inqContentBox').append(html);
        } else {
            alert(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
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

function imageload(filepath){
    let url = filepath;
    $('#hn_thum').attr('src',url);
    // $('#hn_thum').src = url;
    $('#thumPopCon').show();
}



function Ini_popThum(){
    $('#hn_thum').attr('src','');
}

function bContent_Detail(btn){
    var bcode = $(btn).data('bcode');
    $('[name="bContent_Detail"]').each(function(){
        if($(this).data('bcode') == bcode){ // 여기서 this 는 bContent 상자
            $(this).toggle();
        } else {
            $(this).hide();
        }
    });
}

function INI_Load_bContent(){
    $('#bContentBox').empty();
}

function INI_Load_Inquiry(){
    $('#inquiryList').empty();
}