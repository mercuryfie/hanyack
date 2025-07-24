
$(document).ready(function() {

    // list toggle 관련
    $('[name="faq-title"]').on('click',function () {
         // $(this).toggle('color','red');
         $('#detail-view').toggle();
     });

    // camera btn 클릭 시 input event
    $('#thum_taker').on('click',function () {
        $('#attachedFile').click();
    });

    // thumnail 관련
    $('#attachedFile').on('change', function(e) {
        let files = e.target.files;
        for (let i = 0; i < Math.min(files.length, 4); i++) {
            // 이미지 파일만 처리
            if (i>=3) {
                console.log('it is more than 3');
                $('#attachedFile').on('click', function () {
                    console.log('remove others');
                    e.preventDefault();
                    return false;
                });
            } else {
                if (files[i].type.match('image.*')) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let $thumb = $('<div class="thumBox" id="thum-preview" name="thum-preview">' +
                            '<img src="' + e.target.result + '" alt="img">' +
                            '<button type="button" class="delete-btn" id=""><i class="fa-solid fa-xmark"></i></button>' +
                            '</div>');
                        $('#thumbArea').append($thumb);
                        $thumb.find('.delete-btn').on('click', function() {
                            $(this).closest('[name="thum-preview"]').remove();
                            $('#attachedFile').val('');
                        });
                    };
                    reader.readAsDataURL(files[i]);
                }
            }
        }
    });

    $("#submitBtn").on('click',function(e){

        if ($('#notiForm').valid()) {
            if(window.confirm('등록하시겠습니까?')==true) {
                Notice_Post();
            }
        }
    });
});


// async function Notice_Post() {
//     try {
//         let result1 = await Notice_data();
//         if(result1.status='ok'){
//
//             let result2 = await Main_img(result1.code);
//             if(result2.status='ok'){
//                 if($('#attachimg').val()!=''){
//                     let result3 = await Attach_file(result1.code);
//                     if(result3.status='ok') {
//                         alert('등록 완료 하였습니다.');
//                         let url = $('#tUrl').val();
//                         $(location).attr('href',url + '/herbList');
//                     }else {
//                         alert(result3.msg);
//                     }
//                 }else{
//                     alert('등록 완료 하였습니다.');
//                     let url = $('#tUrl').val();
//                     $(location).attr('href',url + '/herbList');
//                 }
//             }else{
//                 alert(result2.msg);
//             }
//         }else{
//             alert(result1.msg);
//         }
//     } catch (error) {
//         // alert(error);
//         console.error( error );
//     }
// }




async function Load_Notice($dataarr, $temparr) {
    try {
        start_spinner();
        let dataarr = {"dataarr" : $dataarr, "temparr" : $temparr};
        let url = APIURL + '/Load_Notice';
        let result = await Load_API(url, dataarr);
        console.log(result);

        // if (result.get('status') == 'NoLogin') {
        //     go_login();
        // } else if (result.get('status') == 'ok') {
        //     let arr = result.get('data').list;
        //     let Cnt = arr.length;
        //     let html = '';
        //
        //     if (Cnt > 0) {
        //         $.each(arr, function (index, el) {
        //             if (el.bid == 1) {
        //                 html += `
        //                     <div class="contentsBox" style="border: 1px solid red;">
        //                         <p class="number">${index + 1}</p>
        //                         <a href="#" class="title">${el.bTitle}</a>
        //                         <p class="writer">${el.writer}</p>
        //                         <p class="date">${el.regidate}</p>
        //                     </div>
        //                 `;
        //             }
        //         });
        //     }
        //
        //     // 기존 내용 비우고 새로 추가
        //     $('#noticeList').append(html);
        // }
    } catch (e) {
        console.log(e);
    } finally {
        stop_spinner();
    }
}

// async function Load_Notice($param) {
//     try {
//         start_spinner();
//         let dataarr = {"param" : $param};
//         let url = APIURL + '/Load_Notice';
//         let result = await Load_API(url,dataarr);
//         if (result.get('status') == 'NoLogin') {
//             go_login();
//         }else if(result.get('status') == 'ok') {
//             let html = '';
//             let arr = result.get('data').list;
//             let Cnt = arr.length;
//             if (Cnt > 0) {
//                 $.each(arr, function (index, el) {
//                     html += '<tr >';
//                     if(el.bid == 1){
//                         html += '<td class="authStatus" style="color:green;">' + el.hn_isok_str + '</td>';
//                     }else if(el.hn_isok==0){
//                         html += '<td class="authStatus" style="color:red;">' + el.hn_isok_str + '</td>';
//                     }else if(el.hn_isok==1){
//                         html += '<td id="app_' + el.sn + '" class="authStatus" style="color:#5c5c5c;"><a href="javascript://" onclick="Re_approval(\'' + el.hn_code + '\',\'' + el.sn + '\');">' + el.hn_isok_str + '</a></td>';
//                     }
//                     html += '<td class="authStatus" >' + el.hn_code + '</td>';
//                     if(el.hn_isok==1){
//                         let hnTypeText = '';
//                         if (el.hn_type == 1) {
//                             hnTypeText = '대표이미지 미첨부';
//                         } else if (el.hn_type == 2) {
//                             hnTypeText = '시험성적서 미첨부';
//                         } else if (el.hn_type == 3) {
//                             hnTypeText = '가격 부적절';
//                         } else {
//                             hnTypeText = ''; // 또는 '기타'
//                         }
//
//                         html += '<td class="bubbleBox" name="bubbleBox" id="auth_' + el.sn + '">';
//                         html += '  <i class="fa-regular fa-comment-dots bubbleicon"></i>';
//                         html += '  <div class="bubble" name="bubble" style="display:none;"><p class="title">반려 사유: </p>' +
//
//                             '<p class="hn_type">' + hnTypeText + '</p>'+
//                             // '<p class="hn_type">' + el.hn_type + '</p>'+
//                             '<p class="hn_memo">' + el.hn_memo + '</p>'+
//                             // 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias aliquam, cumque error est et hic impedit itaque libero magni modi mollitia nemo nulla obcaecati, quam totam veniam voluptatem. Vitae?' +
//                             '</div>';
//                         html += '</td>';
//                     }else{
//                         html += '<td></td>';
//                     }
//                     html += '<td>' + el.hn_MakeDate + '</td>';
//                     html += '<td>' + el.hn_name + '</td>';
//                     html += '<td>' + el.fk_mdname + ' (' + el.fk_mdcode + ')</td>';
//                     html += '<td>' + el.n_value + '</td>';
//                     html += '<td>' + el.t1_value + '</td>';
//                     html += '<td>' + el.t2_value + '</td>';
//                     html += '<td>' + el.w_name + '</td>';
//                     html += '<td>' + Number(el.hn_gPrice).toLocaleString() + '</td>';
//                     html += '<td>' + Number(el.hn_pPrice).toLocaleString() + '</td>';
//                     html += '<td>' + Number(el.hn_stock).toLocaleString() + '</td>';
//                     html += '<td>일반구매</td>';
//                     html += '<td>';
//                     html += '<button class="editHerb" type="button" onclick="Edit_Herb(\'' + el.hn_code + '\');">수정</button>';
//                     html += '</td>';
//                     html += '</tr>';
//                 });
//             } else {
//                 let tcnt = $('#herbtable tr').length;
//                 if(tcnt > 0) alert('마지막 입니다.');
//                 $('.moreListBox').css('display','none');
//             }
//             $('#more').data('page', result.get('data').page);
//             $('#herbtable').append(html);
//         } else {
//             alert(result.get('message'));
//         }
//         stop_spinner();
//     } catch (error) {
//         alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
//         stop_spinner();
//     }
// }

async function Notice_Post() {
    try {
        let result1 = await Notice_data();
        if(result1.status='ok'){
            console.log('등록 완료 하였습니다.');
            let url = $('#tUrl').val();
            $(location).attr('href',url + '/Board/notice');

        }else{
            alert(result1.msg);
        }
    } catch (error) {
        console.log(error);
    }
}


function Notice_data(){
    return new Promise(function(resolve, reject) {
        var sHTML = theEditor.getData();
        $('#editor_data').val(sHTML);

        let formdata = new FormData($("#notiForm")[0]);
        let retarr = new Array();
        let url = $('#tUrl').val() + '/detail';

        $.ajax({
            url: url,
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
                    retarr['code'] = response.code;
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


function Attached_File(hn_code){
    return new Promise(function(resolve, reject) {
        let file = $("#attachedFile")[0].files[0];
        if(file) {
            let formdata = new FormData();
            formdata.append("attachimg", file);
            formdata.append("key", 'attachimg');
            formdata.append("hn_code", hn_code);
            formdata.append("allow", "pdf");
            formdata.append("typ", 2);

            let retarr = new Array();
            $.ajax({
                url: '/Api/Upload_file',
                type: 'post',
                data: formdata,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.result=='ok'){
                        retarr['status'] = 'ok';
                        retarr['code'] = response.code;
                        retarr['msg'] = 'success';
                        resolve(retarr);
                    }else{
                        retarr['status'] = 'error';
                        retarr['code'] = response.code;
                        retarr['msg'] = response.message;
                        reject(retarr);
                    }
                },
                error: function (error) {
                    reject(msg = '통신장애');
                }
            });
        }else{
            retarr['status'] = 'ok';
            retarr['code'] = hn_code;
            retarr['msg'] = '파일없음';
        }
    });
}

