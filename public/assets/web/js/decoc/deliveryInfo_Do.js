$(document).ready(function () {
    Load_DelList();


    $(document).on('click', '[name="findAddress"]', function () {
        const $block = $(this).closest('[name="edit_address"]');
        new daum.Postcode({
            oncomplete: function (data) {
                $block.find('#postcode').val(data.zonecode);
                $block.find('#roadAddress').val(data.roadAddress);
                $block.find('#jibunAddress').val(data.jibunAddress);
            }
        }).open();
    });

    $(document).on('click', '#newDeli', function () {
        const $block = $(this).siblings('[name="deliInfoBox"]');
        new daum.Postcode({
            oncomplete: function (data) {
                $block.append(`
                <div class="newAdd flexType3 ml10" name=""> 
                        <div class="add2" name="newAddress">   
                            <input type="hidden" name="zonecode" value="${data.zonecode}"> 
                            <div class="tag flexType2">
                                <p class="title">주소</p>
                                <input type="text" class="inputType2 "  disabled id="" name="Add1" placeholder="" value="${data.roadAddress}">
                            </div>
                            <div class="tag flexType2">
                                <p class="title">상세주소</p>
                                <input type="text" class="inputType2 " id="" name="Add2" placeholder="">
                            </div>
                            <div class="tag flexType2">
                                <p class="title">받는 사람</p>
                                <input type="text" id="" name="miname" class="inputType2 " placeholder="">
                            </div> 
                            <div class="tag flexType2">
                                <p class="title">연락처</p>
                                <input type="text" name="ctc" class="inputType2 " placeholder="">
                            </div> 
                            <label for="set${data.zonecode}" class="setDefault"> 
                                <input type="checkbox" class="mr10 " name="isDefault" id="set${data.zonecode}">기본 주소지로 저장
                            </label>
                        </div> 
                        <div class="btnBox flexType6 mr10 ">
                        <button type="button" class="btnType1 mr10" 
                                name="" onclick="do_refresh();">취소</button>
                        <button type="button" class="btnType2" 
                                name="" onclick="add_NewAddress('${data.zonecode}','${data.roadAddress}');">저장</button>
                         </div>
                         
                    </div>
                      
                </div>
                 
            `);
                $block.show();

            }
        }).open();
    });

    $('#order_reg').on('click',function(e){
        let price = $('#totalprice').data('tprice');
        alert(price);

    });

    $('#newDeli').on('click',function () {

    });

    // calendar --------------
    $('[name="datePicker"]').each(function(index) {
        let $datepicker = $(this);
        let $calIcon = $('.calicon').eq(index);

        let options = {
            dateFormat: "Y-m-d",
            static: true,
            appendTo: $datepicker.parent()[0],
            onClose: function(selectedDates, dateStr, instance) {
                instance.element.blur();
            }
        };

        let fp = $datepicker.flatpickr(options);

        $calIcon.on('click', function(e) {
            e.preventDefault();
            fp.open(); // 또는 fp.toggle();
        });
    });
});




//Load_DelList
async function Load_DelList() {
    try {
        start_spinner();
        INI_Load_DelInfo();
        let result = await Load_DelInfo();
        if (result.status === 'ok') {
            $('#deliInfoBox').append(result.data);
        } else {
            alert(result.msg);
        }
        stop_spinner();
    } catch (error) {
        alert(error);
        stop_spinner();
    }
}


//Load_DelInfo
function Load_DelInfo() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: '/Api/Load_DelInfo',
            type: 'POST',
            dataType: 'JSON',
            success: function(response) {
                if (response.result === 'ok' && response.info.length > 0) {
                    let html = '';
                    $.each(response.info, function(index, el) {
                        let isDefault = '';
                        let isChecked = '';
                        let delAddress = '';
                        let setDefault = '';
                        if (el.isDefault == 1) {
                            isDefault += `<p class="basic" name="isDefault">기본배송지</p>`;
                            isChecked += `checked`;
                            delAddress += ``;
                            setDefault += ``;

                        } else {
                            isDefault += ``;
                            isChecked += ``;
                            delAddress += `<button type="button" class="btnType1 "  
                                            onclick="do_DelAddress(${el.sn});">삭제</button>`;
                            setDefault += `
                                         <div class="type flexType2">
                                            <p class="title"></p>
                                            <label for="set${el.sn}" class="setDefault"> 
                                            <input type="checkbox" class="mr10 " 
                                                   name="isDefault" id="set${el.sn}">기본 주소지로 저장
                                            </label>
                                        </div>`;
                        }
                        html += `
                            <div class="eachAddress flexType3" name="each_address">
                                <div class="left ml10">
                                    ${isDefault}
                                    
                                 <div class="flexType4 mb10">
                                    <label for="add${el.sn}" class="mr10">
                                    <input type="radio" id="add${el.sn}" name="thisAddress" ${isChecked}>
                                    </label> 
                                    <div class="flexCol">
                                        <p class="add">${el.mi_address1} ${el.mi_address2}</p>
                                        <div class="ctcBox flexType2 fontColor1">
                                            <p class="name mr10">${el.mi_name}</p>
                                            <p class="ctc">${el.mi_tel}</p>
                                        </div>
                                    </div>
                                 </div>
                                </div>
                                <div class="btnBox"> 
                                    ${delAddress}
                                    <button type="button" class="btnType1 mr10"  
                                            onclick="do_EditAddress(${el.sn});">수정</button>
                                </div>
                            </div>
                            <div class="editAddress" style="" name="edit_address"
                                data-sn="${el.sn}"> 
                                <div class="type flexType2">
                                    <p class="title">우편번호</p>
                                    <input type="text" id="" 
                                            name="zonecode"
                                            class="inputType160 mr10" value="${el.mi_zip}">
                                    <button type="button" class="btnType1" 
                                            name="findAddress" onclick="">찾기</button>
                                </div>
                                <div class="type flexType2">
                                    <p class="title">주소</p>
                                    <input type="text" id=""
                                            name="Add1" disabled
                                            class="inputType2" value="${el.mi_address1}">
                                </div>
                                <div class="type flexType2">
                                    <p class="title">상세주소</p>
                                    <input type="text" id="" 
                                            name="Add2"
                                            class="inputType2" value="${el.mi_address2}">
                                </div>
                                <div class="type flexType2">
                                    <p class="title">받는 사람</p>
                                    <input type="text" id="" 
                                            name="miname"
                                            class="inputType2" value="${el.mi_name}">
                                </div>
                                <div class="type flexType2">
                                    <p class="title">연락처</p>
                                    <input type="text" id="" 
                                            name="ctc"
                                            class="inputType2" value="${el.mi_tel}">
                                </div>
                                ${setDefault}
                                 
                                <div class="btnBox flexType5 mr10 mt20">
                                    <button type="button" class="btnType1 mr10" 
                                            name="" onclick="do_refresh();">취소</button>
                                    <button type="button" class="btnType2" 
                                            name="submitNewAddress" 
                                            onclick="edit_Address(${el.sn});">저장</button>
                                </div>
                            
                            </div>
                        `;

                    });

                    resolve({ status: 'ok', data: html });
                } else {
                    resolve({ status: 'empty', msg: '주문 정보가 없습니다.' });
                }
            },
            error: function() {
                reject('데이터 로딩 오류');
            }
        });
    });
}

async function add_NewAddress(mizip,add1) {
    try {
        if (window.confirm('저장하시겠습니까?')==true) {
            let result = await add_NewAddress_Data(mizip,add1);
            if(result.status == 'ok') {
                Make_Toast('저장하였습니다.');
                do_refresh();
                console.log('bello1');
            }
        }

    } catch (error) {
        Make_Toast('bello.');
        console.log('bello333333');
        console.log( error );
    }
}

function add_NewAddress_Data(mizip,add1){
    return new Promise(function(resolve, reject) {

        const $root = $(`[name="newAddress"]`);
        console.log('$container:', $root.length);
        console.log('$container:', mizip,add1);
        let formdata = new FormData($("#thisForm")[0]);
        let add2    = $root.find('[name="Add2"]').val();
        let miname  = $root.find('[name="miname"]').val();
        let ctc     = $root.find('[name="ctc"]').val();
        let isDefault = $root.find('[name="isDefault"]').is(':checked') ? 1 : 0;

        formdata.append("zonecode", mizip);
        formdata.append("Add1", add1);
        formdata.append("Add2", add2);
        formdata.append("miname", miname);
        formdata.append("ctc", ctc);
        formdata.append("isDefault", isDefault);

        let retarr = new Array();
        for (let pair of formdata.entries()) {
            console.log('bello 13',pair[0]+ ': ' + pair[1]);
        }

        $.ajax({
            url: APIURL + '/Insert_DeliInfo',
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


async function edit_Address(sn) {

    try {
        if (window.confirm('저장하시겠습니까?')==true) {
            let result = await edit_Address_Data(sn);
            if(result.status == 'ok') {
                Make_Toast('저장하였습니다.');
                do_refresh();
                console.log('bello1');
            }
        }

    } catch (error) {
        Make_Toast('bello.');
        console.log('bello333333');
        console.log( error );
    }
}

function edit_Address_Data(sn){
    return new Promise(function(resolve, reject) {


        let $editRoot = $(`[name="edit_address"][data-sn="${sn}"]`);
        let zonecode = $editRoot.find('[name="zonecode"]').val();
        let add1    = $editRoot.find('[name="Add1"]').val();
        let add2    = $editRoot.find('[name="Add2"]').val();
        let miname  = $editRoot.find('[name="miname"]').val();
        let ctc     = $editRoot.find('[name="ctc"]').val();
        let isDefault = $editRoot.find('[name="isDefault"]').is(':checked') ? 1 : 0;

        console.log('$root:', $editRoot.length);
        console.log('$root:', sn);
        let formdata = new FormData($("#thisForm")[0]);

// 디버깅 먼저
        console.log("zonecode=", zonecode);
        console.log("Add1=", add1);
        console.log("Add2=", add2);
        console.log("miname=", miname);
        console.log("ctc=", ctc);
        console.log("isDefault=", isDefault);

        // 값 직접 뽑아오고 append
        formdata.append("sn", sn);
        formdata.append("zonecode", zonecode ?? '');
        formdata.append("Add1", add1 ?? '');
        formdata.append("Add2", add2 ?? '');
        formdata.append("miname", miname ?? '');
        formdata.append("ctc", ctc ?? '');
        formdata.append("isDefault", isDefault);

        for (let [key, value] of formdata.entries()) {
            console.log('formdata:', key, value);
        }

        let retarr = new Array();
        for (let pair of formdata.entries()) {
            console.log('bello 14',pair[0]+ ': ' + pair[1]);
        }

        $.ajax({
            url: APIURL + '/Update_DeliInfo',
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


async function do_DelAddress(sn) {

    try {
        if (window.confirm('삭제하시겠습니까?')==true) {
            let result = await Del_Address_Data(sn);
            if(result.status == 'ok') {
                Make_Toast('삭제하였습니다.');
                do_refresh();
                console.log('bello1');
            }
        }

    } catch (error) {
        Make_Toast('bello.');
        console.log('bello333333');
        console.log( error );
    }
}

function Del_Address_Data(sn){
    return new Promise(function(resolve, reject) {

        console.log('$root:', sn);
        let formdata = new FormData($("#thisForm")[0]);

        formdata.append("sn", sn);

        let retarr = new Array();
        for (let pair of formdata.entries()) {
            console.log('bello 14',pair[0]+ ': ' + pair[1]);
        }

        $.ajax({
            url: APIURL + '/Delete_DeliInfo',
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




function do_EditAddress(sn){

    $('[name="edit_address"]').hide();
    let $target = $('[name="edit_address"][data-sn="' + sn + '"]');
    if ($target.is(':visible')) {
        $target.slideUp(100); // 200ms
    } else {
        $target.slideDown(300); // 400ms
    }
}




function INI_Load_DelInfo(){
    $('#deliInfoBox').empty();
}




