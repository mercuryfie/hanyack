$(document).ready(function() {

    $('#hn_add_2').on('change', function() {
        if ($(this).is(':checked')) {
            $('#buyWrap2').slideDown(400);
        } else {
            ini_Form5();
            $('#buyWrap2').slideUp(100);
        }
    });

    $('#hn_add_3').on('change', function() {
        if ($(this).is(':checked')) {
            $('#buyWrap3').slideDown(400);
        } else {
            ini_Form6();
            $('#buyWrap3').slideUp(100);
        }
    });


    $('#mainarea').on("drop", function (e) {
        let extval = $(this).data('ext');
        let files = e.originalEvent.dataTransfer.files[0];
        let ext = extval.split(',');
        if(!uploadFile(files,ext)){
            e.stopPropagation();
            e.preventDefault();
            alert('대표이미지는 [' + extval + "] 만 가능합니다.");
        }else{
            $('#mainimg').files = files;
        }
    });

    $('#attacharea').on("drop", function (e) {
        let extval = $(this).data('ext');
        let files = e.originalEvent.dataTransfer.files[0];
        let ext = extval.split(',');
        if(!uploadFile(files,ext)){
            e.stopPropagation();
            e.preventDefault();
            alert('시험성적서는 [' + extval + "] 만 가능합니다.");
        }else{
            $('#attachimg').files = files;
        }
    });

    $('#cancelBtn').on('click',function(){
        go_HList();
    });

    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }
        abort() {
            if (this.xhr) { this.xhr.abort(); }
        }
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open('POST', '/Api/Upload_file_editor', true);
            xhr.responseType = 'json';
        }

        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }
                resolve({
                    default: response.url
                });
            });
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }
        _sendRequest(file) {
            const data = new FormData();
            data.append('upload', file);
            this.xhr.send(data);
        }
    }




// hn_DateMethod 1,2,3년 radio click 시 유통기한 변경 --------------
    $('input[name="hn_DateMethod"]').each(function() {
        $(this).on('change', function() {
            Make_Period(this.value);
        });
    });

// 시작일 변경 시에도 종료일 자동 계산
    $('#hn_sellSDate').on('change', function() {
        let checkedRadio = $('input[name="hn_DateMethod"]:checked');
        if (checkedRadio) {
            Make_Period(checkedRadio.value);
        }
    });

    // ckeditor
    ClassicEditor.create(document.querySelector(".infockeditor"), {
        toolbar: {
            items: [
                "heading",
                "|",
                "imageUpload",
                "|",
                "mediaEmbed",
                "|",
                "bold",
                "italic",
                "link",
                "bulletedList",
                "numberedList",
                "|",
                "indent",
                "outdent",
                "|",
                "blockQuote",
                "undo",
                "redo",
            ],

        },
        image: {
            upload: {
                types: ['jpeg', 'png', 'gif']
            }
        },
        ckfinder: {
            uploadUrl: '/Api/Upload_file_editor'
        },
        codeBlock: {
            languages: [
                { language: 'javascript', label: 'JavaScript' },
                { language: 'html', label: 'HTML' }
            ]
        },
        language:'ko'
    })
        .then((editor) => {
            const editableElement = editor.ui.view.editable.element;
            editableElement.style.height = "220px";

            editableElement.addEventListener("focus", () => {
                editableElement.style.height = "220px";
            });
            editableElement.addEventListener("blur", () => {
                editableElement.style.height = "220px";
            });

            theEditor = editor;

            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        })
        .catch((error) => {
            console.error(error);
        });


    $("#makedate").on("propertychange keyup paste input", function () {
        Make_Period(1);
    });


    $('#o_gPrice, #o_pPrice, #o_stock').on('focus', function() {
        // 값에서 쉼표(,)를 모두 제거
        $(this).val('');
    });

    $('#attachImg').on('click', function(e) {
        let thumbCount = $('[name="thumPreview"]').length;
        if (thumbCount >= 1) {
            Make_Toast('이미지는 최대 1장까지 등록 가능합니다.');
            e.preventDefault(); // 파일 선택창 안 뜨게 막음
            return false;
        }
    });

    $('#attachImg').on('change', function(e) {
        let files = e.target.files;
        let thumbCount = $('[name="thumPreview"]').length;

        if (thumbCount + files.length > 1) {
            Make_Toast('이미지는 1장만 등록 가능합니다.');
            $(this).val(''); // 파일 선택 취소
            return;
        }
        for (let i = 0; i < files.length; i++) {
            if (files[i].type.match('image.*')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let $thumb = $(

                        '<div class="thumCon" >' +
                        '<div class="thumBox" name="thumPreview">' +
                        '<img src="' + e.target.result + '" alt="img" class="addedImg">' +
                        // '<p class="file-name" >' + files[i].name + '</p>' +
                        '<button type="button" class="delete-btn">' +
                        '<i class="fa-solid fa-xmark"></i></button>' +
                        '</div>' +
                          '<p class="file-name" >' + files[i].name + '</p>' +
                          '</div>' );
                    $('#thumbArea').append($thumb);
                    $thumb.find('.delete-btn').on('click', function() {
                        $(this).closest('.thumCon').remove();
                        $('#attachImg').val('');
                    });
                };
                reader.readAsDataURL(files[i]);
            }
        }
    });

    $('#attachFile').on('click', function(e) {
        let thumbCount = $('[name="thumPreview2"]').length;
        if (thumbCount >= 1) {
            Make_Toast('파일은 최대 1장까지 등록 가능합니다.');
            e.preventDefault(); // 파일 선택창 안 뜨게 막음
            return false;
        }
    });

    $('#attachFile').on('change', function(e) {
        let files = e.target.files;
        let thumbCount = $('[name="thumPreview2"]').length;

        if (thumbCount + files.length > 1) {
            Make_Toast('파일은 1장만 등록 가능합니다.');
            $(this).val(''); // 파일 선택 취소
            return;
        }
        for (let i = 0; i < files.length; i++) {
            if (files[i].type === 'application/pdf') {
                let $thumb = $(
                    '<div class="thumCon" name="">' +
                    '<div class="thumBox" name="thumPreview2">' +
                    '<img src="/assets/web/src/pdfSample.png" alt="pdf" class="addedImg">' +
                    // '<p class="file-name">' + files[i].name + '</p>' +
                    '<button type="button" class="delete-btn">' +
                    '<i class="fa-solid fa-xmark"></i></button>' +
                    '</div>' +
                    '<p class="file-name">' + files[i].name + '</p>' +
                    '</div>'
                );
                $('#thumbArea2').append($thumb);
                $thumb.find('.delete-btn').on('click', function() {
                    $(this).closest('.thumCon').remove();
                    $('#attachFile').val('');
                });
            } else {
                Make_Toast('PDF 파일만 등록 가능합니다.');
                $(this).val(''); // 파일 선택 취소
                return;
            }
        }
    });

    $('#deleteBtn').on('click',function () {
        $(this).closest('.thumCon').remove();
        $('#attachImg').val('');

    });

    $('#deleteBtn2').on('click',function () {
        $(this).closest('.thumCon').remove();
        $('#attachFile').val('');

    });



    $("#submitBtn").on('click',function(e){
        let hn_gPrice_1 = $('#hn_gPrice_1').val();
        let hn_pPrice_1 = $('#hn_pPrice_1').val();
        let hn_stock_1 = $('#hn_stock_1').val();
        let hn_add2= 0;
        if($('input[id=hn_add_2]').is(':checked')==true){
            hn_add2= 1;
        }
        let hn_period = $("#hn_period option:selected").val();
        let hn_gPrice_2 = $('#hn_gPrice_2').val();
        let hn_pPrice_2 = $('#hn_pPrice_2').val();
        let hn_stock_2 = $('#hn_stock_2').val();
        let hn_add3 = 0;
        if($('input[id=hn_add_3]').is(':checked')==true){
            hn_add3= 1;
        }
        let hn_sellmethod = $('#hn_sellmethod').val();
        let hn_weight = $('#hn_weight').val();
        let hn_pPrice_3 = $('#hn_pPrice_3').val();
        let makedate = $('#makedate').val();

        if (hn_gPrice_1 == '') {
            $('#hn_gPrice_1').focus();
            Make_Toast('근당 가격을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if (hn_pPrice_1 == '') {
            $('#hn_pPrice_1').focus();
            Make_Toast('포장 가격을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if (hn_stock_1 == '') {
            $('#hn_stock_1').focus();
            Make_Toast('재고 수량을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if ((hn_add2 == 1) && (hn_period == '')) {
            $('#hn_period').focus();
            Make_Toast('정기 구독 기간을 선택하여 주세요.');
        }else if ((hn_add2 == 1) && (hn_gPrice_2 == '')) {
            $('#hn_gPrice_2').focus();
            Make_Toast('정기구독의 근당 가격을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if ((hn_add2 == 1) && (hn_pPrice_2 == '')) {
            $('#hn_pPrice_2').focus();
            Make_Toast('정기구독의 포장 가격을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if ((hn_add2 == 1) && (hn_stock_2 == '')) {
            $('#hn_stock_2').focus();
            Make_Toast('정기구독의 재고 수량을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if ((hn_add3 == 1) && (hn_sellmethod == '')) {
            $('#hn_sellmethod').focus();
            Make_Toast('대량구매의 판매단위를 입력하여 주세요.');
        } else if ((hn_add3 == 1) && (hn_weight == '')) {
            $('#hn_weight').focus();
            Make_Toast('대량구매의 총 무개를 입력하여 주세요.');
        } else if ((hn_add3 == 1) && (hn_pPrice_3 == '')) {
            $('#hn_pPrice_3').focus();
            Make_Toast('대량구매의 가격을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if(window.confirm('수정 하시겠습니까?')==true) {
            Product_Edit_Proceed();
        }
    });

    $('#makedate').on('ropertychange keyup paste input', function() {
        console.log('1');
        Make_Period(1);
    });

    $('#hn_gPrice_1').on('input',function(){
        let price = $('#hn_gPrice_1').val();
        let weight = $('#w_value').val();
        let r_price = 0;
        if(weight==''){
            $('#o_weight').focus();
            Make_Toast('포장 단위를 선택하여 주세요.');
        }else{
            r_price = calcPricePerGeun(price,weight);
            $('#hn_pPrice_1').val(r_price);
        }
    });

    $('#hn_gPrice_2').on('input',function(){
        let price = $('#hn_gPrice_2').val();
        let weight = $('#w_value').val();
        let r_price = 0;
        if(weight==''){
            $('#o_weight').focus();
            Make_Toast('포장 단위를 선택하여 주세요.');
        }else{
            r_price = calcPricePerGeun(price,weight);
            $('#hn_pPrice_2').val(r_price);
        }
    });

    $('#o_weight').on('change',function(e){
        $('#hn_pPrice_1').val('');
        $('#hn_pPrice_2').val('');
        $('#hn_gPrice_1').val('');
        $('#hn_gPrice_2').val('');
    });

});

async function Product_Edit_Proceed() {
    try {
        start_spinner();
        let result1 = await Edited_data();
        if((result1.status=='ok') && (result1.status!='undefined')){
            let hncode = result1.code;
            if($('#attachImg').val()!='') {
                let result2 = await Main_img(hncode);
            }
            if($('#attachFile').val()!='') {
                let result3 = await Attach_file(hncode);
            }
            Make_Toast('약재 수정 완료  하였습니다.');
            let url = $('#tUrl').val();
            $(location).attr('href',url + '/herbList');
            stop_spinner();
        }else{
            stop_spinner();
            Make_Toast(result1.msg);
        }
    } catch (error) {
        stop_spinner();
        Make_Toast('오류가 발생했습니다: ' + error.message);
    }
}

async function Main_img(hncode){
    let retarr = {};
    try{
        if(hncode==''){
            retarr['status'] = 'error';
            retarr['msg'] = '잘못된 접근입니다.';
        }else {
            let formdata = new FormData();
            formdata.append("attachImg", $("#attachImg")[0].files[0]);
            formdata.append("key", 'attachImg');
            formdata.append("hn_code", hncode);
            formdata.append("allow", $('#attachImg').data('ext'));
            formdata.append("typ", 1);
            formdata.append("method", 'edit');

            let url = APIURL + '/Upload_file';
            let result = await Load_API_File(url, formdata);
            if (result.get('status') == 'ok') {
                retarr.status = 'ok';
                retarr.msg = '';
            } else {
                retarr.status = 'error';
                retarr.msg = result.message;
            }
        }
    }catch(error){
        retarr.status = 'catch';
        retarr.msg = '오류가 발생했습니다: ' + error.message;
    }
    return retarr;
}

async function Attach_file(hncode){
    let retarr = {};
    try{
        if(hncode==''){
            retarr['status'] = 'error';
            retarr['msg'] = '잘못된 접근입니다.';
        }else {
            let formdata = new FormData();
            formdata.append("attachFile", $("#attachFile")[0].files[0]);
            formdata.append("key", 'attachFile');
            formdata.append("hn_code", hncode);
            formdata.append("allow", $('#attachFile').data('ext'));
            formdata.append("typ", 2);
            formdata.append("method", 'edit');

            let url = APIURL + '/Upload_file';
            let result = await Load_API_File(url, formdata);
            if (result.get('status') == 'ok') {
                retarr.status = 'ok';
                retarr.msg = '';
            } else {
                retarr.status = 'error';
                retarr.msg = result.message;
            }
        }
    }catch(error){
        retarr.status = 'catch';
        retarr.msg = '오류가 발생했습니다: ' + error.message;
    }
    return retarr;
}

async function Edited_data() {
    let retarr ={};
    try {
        var sHTML = theEditor.getData();
        $('#editor_data').val(sHTML);
        let formdata = new FormData($("#editForm")[0]);
        let url = PHARMURL + '/Herb_Edit_Do';
        let result = await Load_API_Form(url, formdata);
        if(result.get('status')=='ok'){
            retarr.status = 'ok';
            retarr.code = result.get('data')['code'];
            retarr.msg = '';
        }else{
            retarr.status = 'error';
            retarr.code = '';
            retarr.msg = result.message;
        }
    }catch(error){
        retarr.status = 'catch';
        retarr.code = '';
        retarr.msg = '오류가 발생했습니다: ' + error.message;
    }
    return retarr;
}

function on_method(method){
    Make_Period(method);
}

function Make_Period(method){
    $('#method').val(method);
    let c_date = $('#makedate').val();

    console.log('hello'+c_date);
    if(c_date!='') {
        let date = '';
        let s_date = new Date(c_date);
        let period = 0;
        if (method == 1) {
            period = 12 * 3;
        }else if (method == 2) {
            period = 12 * 2;
        }else if (method == 3) {
            period = 12 * 1;
        } else if (method == 4) {
            period = 6;
        } else {
            period = 12 * method;
        }

        date = new Date(s_date.setMonth(s_date.getMonth() + (period + 1)));
        let e_date = date.getFullYear() + '-' + String(date.getMonth()).padStart(2, "0") + '-' + String(date.getDate()).padStart(2, "0");

        console.log(c_date);
        console.log(e_date);

        $('#s_date').val(c_date);
        $('#e_date').val(e_date);

    }
}


function uploadFile(fileVal,extarr) {
    let retval = false;
    let filename = fileVal["name"];
    if( filename != "" ){
        var ext = filename.split('.').pop().toLowerCase(); //확장자분리
        if($.inArray(ext, extarr) == -1) {
            retval = false;
        }else{
            retval = true;
        }
    }
    return retval;
}

function show_HDList2(){
    $('#HD_List2').toggle();
}

function ini_Form5(){
    $('#hn_gPrice_2').val('');
    $('#hn_pPrice_2').val('');
}

function ini_Form6(){
    $('#hn_sellmethod').val('');
    $('#hn_weight').val('');
    $('#hn_pPrice_3').val('');
}