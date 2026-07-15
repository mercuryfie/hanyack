$(document).ready(function() {

    $("#txtHD").on("keypress", function (key) {
        if (key.keyCode == 13) {
            $word = $('#txtHD').val();
            if ($word == '') {
                alert('검색어를 입력하세요.');
                $('#txtHD').focus();
            } else {
                Search_HDMedicine(2, $word);
            }
        }
    });

    $("#txtHD").focusout(function () {
        ini_Form4();
    });

    $("#txtHD").focusin(function () {
        $('#HD_List2').empty();
        $('#HD_List2').css('display','none');
    });

    $("#makedate").on("propertychange keyup paste input", function () {
        Make_Period(1);
    });


    $("#submitBtn").on('click',function(e){
        let mdcode = $('#mdcode').val();
        let medicode = $('#medicode').val();
        let mdname = $('#mdname').val();
        let method = $('#method').val();
        let buymethod = $('#buymethod').val();
        let salemethod = $('#salemethod').val();
        let tax = $('#tax').val();
        let o_name = $('#o_name').val();
        let gubun = $("#gubun1 option:selected").val();
        let o_option2 = $("#o_option2 option:selected").val();
        let o_weight = $("#o_weight option:selected").val();
        let o_nation = $("#o_nation option:selected").val();
        let o_gPrice = $('#o_gPrice').val();
        let o_pPrice = $('#o_pPrice').val();
        let o_stock = $('#o_stock').val();
        let makedate = $('#makedate').val();
        let fname = $('#mainimg').val();

        if(medicode==''){
            $('#txtHD').focus();
            Make_Toast('본초를 검색하여 주세요.');
        }else if(o_name=='') {
            $('#o_name').focus();
            Make_Toast('약초명을 입력하여 주세요.');
        }else if(o_weight==''){
            $('#o_weight').focus();
            Make_Toast('포장 단위를 선택하여 주세요.');
        }else if(o_nation==''){
            $('#o_nation').focus();
            Make_Toast('원산지를 선택하여 주세요.');
        }else if(o_gPrice==''){
            $('#o_gPrice').focus();
            Make_Toast('근당 가격을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if(o_pPrice==''){
            $('#o_pPrice').focus();
            Make_Toast('포장 가격을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if(o_stock=='') {
            $('#o_stock').focus();
            Make_Toast('재고 수량을 입력하여 주세요.  [반드시 숫자만 입력하세요.]');
        }else if(!checkValidDate(makedate)) {
            Make_Toast('제조 일자를 확인하여 주세요.');
        }else if(fname=='') {
            $('#mainimg').focus();
            Make_Toast('대표 이미지를 선택 하세요.');
        }else if(window.confirm('등록하시겠습니까?')==true) {
            Product_Reg();
        }
    });


    $("#o_name").on("keyup", function (e) {
        $(this).css('outline','');
        $(this).css('border','solid 1px #cccccc');
    });

    $("#o_weight, #o_nation", "#mainimg", "#attachimg" ).on("change", function (e) {
        $(this).css('outline','');
        $(this).css('border','solid 1px #cccccc');
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

    // $('#addBtn').on('click', function() {
    //     $('#buyWrap2').slideToggle();
    //
    // });

    $('#addBtn').on('click', function() {
        if ($('#buyWrap2').is(':visible')) {
            $('#buyWrap2').slideUp(100); // 200ms
        } else {
            $('#buyWrap2').slideDown(400); // 400ms
        }
    });

    $('#addBtn2').on('click', function () {
        $('#buyWrap2').toggle();
    });

    $('#addBtn3').on('change', function() {
        if ($(this).is(':checked')) {
            $('#buyWrap2').slideDown(400);
        } else {
            $('#buyWrap2').slideUp(100);
        }
    });

    // ckeditor
    ClassicEditor
        .create(document.querySelector("#ckeditor"), {
        removePlugins: ['ImageCaption'],
        image: {
            toolbar: [ 'imageStyle:full', 'imageStyle:side' ]
        },
        toolbar: {
            // licenseKey: '<YOUR_LICENSE_KEY>',
            label: 'Basic styles',
            icon: 'text',
            initialData: '<p>dd</p>',
            items:
                [
                    "selectAll",
                    "undo",
                    "redo",
                    "bold",
                    "italic",
                    "blockQuote",
                    "|",
                    "todoList",
                    "paragraph",
                    "pasteFormat",
                    // "numberedList",
                    // "bulletedList",
                    "uploadImage",
                    "|",
                    "link",
                    // "ckfinder",
                    // "heading",
                    "imageStyle:full",
                    "imageStyle:side",
                    "indent",
                    "outdent",
                    "mediaEmbed"
                ]

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

            console.log('Editor initialized', editor);
            theEditor = editor;

            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        })
        .catch((error) => {
            console.log(error);
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
});
/////////////////  function ////////////////////////////////////////


async function Product_Reg() {
    try {
        let result1 = await Reg_data();
        if(result1.status='ok'){
            let result2 = await Main_img(result1.code);
            if(result2.status='ok'){
                if($('#attachimg').val()!=''){
                    let result3 = await Attach_file(result1.code);
                    if(result3.status='ok') {
                        alert('등록 완료 하였습니다.');
                        let url = $('#tUrl').val();
                        $(location).attr('href',url + '/herbList');
                    }else {
                        alert(result3.msg);
                    }
                }else{
                    alert('등록 완료 하였습니다.');
                    let url = $('#tUrl').val();
                    $(location).attr('href',url + '/herbList');
                }
            }else{
                alert(result2.msg);
            }
        }else{
            alert(result1.msg);
        }
    } catch (error) {
        // alert(error);
        console.error( error );
    }
}


function Reg_data(){
    return new Promise(function(resolve, reject) {
        var sHTML = theEditor.getData();
        $('#editor_data').val(sHTML);

        let formdata = new FormData($("#regForm")[0]);
        let retarr = new Array();
        let url = PHARMURL + '/herbReg_Do';

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

function Main_img(hn_code){
    return new Promise(function(resolve, reject) {

        let ext = $('#mainarea').data('ext');
        let formdata = new FormData();
        formdata.append( "mainimg", $("#mainimg")[0].files[0] );
        formdata.append( "key", 'mainimg');
        formdata.append( "hn_code",  hn_code);
        formdata.append( "allow",  ext);
        formdata.append( "typ", 1);

        let retarr = new Array();
        $.ajax({
            url: APIURL + '/Upload_file',
            type : 'POST',
            data: formdata,
            enctype		: 'multipart/form-data',
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
                retarr['code'] = 'DBERROR';
                retarr['msg'] = error;
                resolve(retarr);
            }
        });
    });
}

function Attach_file(hn_code){
    return new Promise(function(resolve, reject) {
        let file = $("#attachimg")[0].files[0];
        if(file) {
            let formdata = new FormData();
            formdata.append("attachimg", file);
            formdata.append("key", 'attachimg');
            formdata.append("hn_code", hn_code);
            formdata.append("allow", "pdf");
            formdata.append("typ", 2);

            let retarr = new Array();
            $.ajax({
                url: APIURL + '/Upload_file',
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

function updateOptions(list) {
    const gubun1 = $('#gubun1');
    gubun1.empty();

    if (list.length > 0) {
        gubun1.append('<option value="0">선택안함</option>');
        $.each(list, function(index, el) {
            gubun1.append('<option value="' + el.t1_code + '">' + el.t1_value + '</option>');
        });
    } else {
        gubun1.append('<button class="herboption" style="color: red;">옵션없음</button>');
    }
}

async function Search_HDMedicine(target,val){
    try {
        start_spinner();
        let dataarr = { "word" : val,"target" : target};
        let url = APIURL + "/Load_Medicine";
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            let html = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr,function (index,el){
                    html += '<button class="herboption" type="button" onclick="Select_HD(\'' + el.mdCode + '\',\''+el.mdMediName+'\',\''+el.mdMedi+'\');">' + el.mdMediName + ' [' + el.mdCode  + '] </button>';
                });
                $('#HD_List').append(html);
                $('#HD_List').css('display','flex');
            }else{
                alert(result.get('message'));
            }
        }
        stop_spinner();
    } catch (error) {
        alert('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

function ini_Form1(){
    $('.HDName').html('-');
    $('.HDName').text('-');
    $('#mdcode').val('');
    $('#medicode').val('');
    $('#mdname').val('');
    $('#HD_List').empty();
    $('#HD_List').css('display','none');
    $('#txtHD').val('');
    $('#gubun1').empty();
    $('#gubun1').append('<button value="0">옵션없음</button>');
}

function ini_Form2(){
    $('.HDName').html('-');
    $('#mdcode').val('');
    $('#medicode').val('');
    $('#mdname').val('');
    $('#HD_List').empty();
    $('#HD_List').css('display','none');
}

function ini_Form3(){
    $('#HD_List').css('display','none');
    $('#gubun1').empty();
    $('#HD_List2').empty();
}

function ini_Form4(){
    $('.HDName').html('-');
    $('#txtHD').val('');
    $('#mdcode').val('');
    $('#medicode').val('');
    $('#mdname').val('');

}

function SettingData(code){
    $.ajax({
        type:"POST",
        url:"/Api/Load_Product_Info",
        dataType:"json",
        data : { "hncode" : code},
        success : function(data) {
            if(data.result == 'ok'){
                let info = data.list[0];
                $('#o_name').val(info.hn_name);
                if(info.fk_t1code>0){
                    $('#gubun1').val(info.fk_t1code).prop('selected',true);
                }
                $('#o_option2').val(info.fk_t2code).prop('selected',true);
                $('#o_weight').val(info.fk_wcode).prop('selected',true);
                $('#o_nation').val(info.fk_ncode).prop('selected',true);
                $('#o_gPrice').val(info.hn_gPrice);
                $('#o_pPrice').val(info.hn_pPrice);

                for($i=1;$i<=3;$i++){
                    if(info.hn_method==$i){
                        $('#buymethod' + $i).addClass('checkedGreen');
                    }else{
                        $('#buymethod' + $i).removeClass('checkedGreen');
                    }
                }
                $('#buymethod').val(info.hn_method);

                for($i=1;$i<=3;$i++){
                    if(info.hn_sale==$i){
                        $('#salemethod' + $i).addClass('checkedGreen');
                    }else{
                        $('#salemethod' + $i).removeClass('checkedGreen');
                    }
                }
                $('#salemethod').val(info.hn_sale);

                for($i=1;$i<=4;$i++){
                    if(info.hn_DateMethod==$i){
                        $('#pemethod' + $i).addClass('checkedGreen');
                    }else{
                        $('#pemethod' + $i).removeClass('checkedGreen');
                    }
                }
                $('#method').val(info.hn_DateMethod);

                const mdate1 = moment(info.hn_MakeDate);
                console.log('mc=' + $('#makedate').val(mdate1.format('YYYY-MM-DD')));

                const mdate2 = moment(info.hn_sellSDate);
                $('#s_date').val(mdate2.format('YYYY-MM-DD'));

                const mdate3 = moment(info.hn_sellEDate);
                $('#e_date').val(mdate3.format('YYYY-MM-DD'));


                theEditor.setData(info.hn_desc);
                $('#HD_List2').css('display','none');


            }else if(data.result == 'type101'){
                alert('잘못된 접근입니다.\n 다시 시도 하여주세요.(101)');
            }else if(data.result == 'type102'){
                alert('통신장애로 데이터로드에 실패하였습니다. .\n 다시 시도 하여주세요.(101)');
            }else{
                alert('통신에러 Error(101)');
            }
        },
        error : function(xhr, status, error) {
            alert("에러발생");
        }
    });

}

function Select_HD(mdcode,name,medicode){
    $('.HDName').html(name);
    $('#mdcode').val(mdcode);
    $('#medicode').val(medicode);
    $('#mdname').val(name);
    ini_Form3();

    if(medicode!=''){
        $.ajax({
            type:"POST",
            url:"/Api/Load_Medicine_Option1",
            dataType:"json",
            data : { "mdcode" : medicode},
            success : function(data) {
                if(data.result == 'ok'){
                    let Cnt = data.list.length;
                    if(Cnt>0){
                        let arr = data.list;
                        let html = '<option value="0" selected>선택하세요.</option>';
                        $.each(arr,function (index,el){
                            html += '<option value="' + el.t1_code + '">' + el.t1_value + '</option>';

                        });
                        $('#gubun1').append(html);
                    }else{
                        let html = '<option value="0" selected>옵션없음</option>';
                        $('#gubun1').append(html);
                    }
                }else if(data.result == 'type101'){
                    alert('잘못된 접근입니다.\n 다시 시도 하여주세요.(101)');
                }else if(data.result == 'type102'){
                    alert('통신장애로 데이터로드에 실패하였습니다. .\n 다시 시도 하여주세요.(101)');
                }else{
                    alert('통신에러 Error(101)');
                }
            },
            error : function(xhr, status, error) {
                alert("에러발생");
            }
        });

        $.ajax({
            type:"POST",
            url:"/Api/Load_Product_Before",
            dataType:"json",
            data : { "mdcode" : mdcode},
            success : function(data) {
                if(data.result == 'ok'){

                    let Cnt = data.list.length;
                    if(Cnt>0){
                        let arr = data.list;
                        let html = '';
                        $.each(arr,function (index,el){    // 약재복사 template
                            let methodText = '';
                            if (el.hn_method == 1) {
                                methodText = ORDER_TYPE_1;
                            } else if (el.hn_method == 2) {
                                methodText = ORDER_TYPE_2;
                            } else if (el.hn_method == 3) {
                                methodText = ORDER_TYPE_3;
                            } else {
                                methodText = '알수없음';
                            }
                            html += '<button class="herboption" type="button" '
                                + 'onclick="SettingData(' + el.hn_code + ');">'
                                + el.hn_name + ' [' + el.fk_mdname + ']'
                                + ' [' + methodText  + '] '
                                + ' [제조일자: ' + el.hn_sellSDate.split(' ')[0] + '] '
                                + '</button>';

                        });
                        $('#HD_List2').append(html);
                        $('#hdlist_cmt').html('이전 등록 약재를 선택하세요');
                    }else{
                        $('#hdlist_cmt').html('등록된 이전 약재 정보 없습니다.');
                    }
                }else if(data.result == 'type101'){
                    alert('잘못된 접근입니다.\n 다시 시도 하여주세요.(101)');
                }else if(data.result == 'type102'){
                    alert('통신장애로 데이터로드에 실패하였습니다. .\n 다시 시도 하여주세요.(101)');
                }else{
                    alert('통신에러 Error(101)');
                }
            },
            error : function(xhr, status, error) {
                alert("에러발생");
            }
        });


    }
}

function on_method(method){
    Make_Period(method);
}

function on_buymethod(buy){
    $('#buymethod').val(buy);
}

function on_salemethod(sale){
    $('#salemethod').val(sale);
}

function on_tax(val){
    $('#tax').val(val);
}

function on_submethod(val){
    $('#submethod').val(val);
}

function Make_Period(method){
    $('#method').val(method);
    let c_date = $('#makedate').val();
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