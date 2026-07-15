$(document).ready(function () {

    $(function () {
        setTopMenuHighlight();
    });


});


function setTopMenuHighlight() {
    var path = (window.location.pathname + window.location.search).toLowerCase();

    console.log('current path:', path);

    $('.top_gnb_ul .top_menu').removeClass('highlight');

    if (path.indexOf('dashboard') > -1) {
        $('.top_gnb_ul .top_menu.down_1').addClass('highlight');

    } else if (
        path.indexOf('smartorder') > -1
    ) {
        $('.top_gnb_ul .top_menu.down_2').addClass('highlight');

    } else if (
        path.indexOf('orderlist') > -1 ||
        path.indexOf('orderdetail') > -1 ||
        path.indexOf('regularorder') > -1 ||
        path.indexOf('burkorderform') > -1 ||
        path.indexOf('shiplist') > -1 ||
        path.indexOf('claimlist') > -1
    ) {
        $('.top_gnb_ul .top_menu.down_3').addClass('highlight');

    } else if (
        path.indexOf('stock') > -1 ||
        path.indexOf('herblist') > -1 ||
        path.indexOf('herbreg') > -1 ||
        path.indexOf('herbregall') > -1 ||
        path.indexOf('herbmatch') > -1
    ) {
        $('.top_gnb_ul .top_menu.down_4').addClass('highlight');

    } else if (
        path.indexOf('calculate') > -1 ||
        path.indexOf('settlement') > -1
    ) {
        $('.top_gnb_ul .top_menu.down_5').addClass('highlight');

    } else if (
        path.indexOf('deliveryinfo') > -1 ||
        path.indexOf('myinfo') > -1 ||
        path.indexOf('mypage') > -1
    ) {
        $('.top_gnb_ul .top_menu.down_6').addClass('highlight');
    }
}


function Make_delcode(sn,typ=1){
    let del = ['직배','퀵','경동','대신','로젠','롯데','천일','한진'];
    let str = '';

    if(typ==1) {
        str = '<td><select name="delitype" id="delitype_' + sn + '" class="selectType2">';
        str += '<option value="0">선택</option>';
    }else{
        str = '<option value="0">선택</option>';
    }
    for(let i=0;i<=(del.length-1);i++){
        str += '<option value="' + (i+1) + '">' + del[i] + '</option>';
    }

    if(typ==1) {
        str += '</select></td>';
    }

    return str;
}

function Make_delcode_str(sn){
    let del = ['직배','퀵','경동','대신','로젠','롯데','천일','한진'];

    str = del[(sn-1)];

    return str;
}


function Search_Product(skey){
    let url ='';
    if(skey==''){
        url = '/Product/herbList';
    }else{
        url = '/Product/herbList?hd=' + skey
    }

    $(location).attr("href", url);
}

function calcPricePerGeun(price,weight) {
    let r_price = parseFloat(price) || 0;
    let r_weight = parseFloat(weight) || 0;
    let geun = 600;
    let result = 0;

    if (weight > 0) {
        result = (r_price * r_weight) / geun;
    }

    return Math.round(result);
}


function Load_API(url,dataarr){
    return new Promise(function(resolve, reject){
        console.log('call api=' + url);
        console.log(JSON.stringify(dataarr));
        let retMap = new Map();
        $.ajax({
            url: url,
            type: 'POST',
            dataType : "JSON",
            data: dataarr,
            success: function (response) {
                retMap.set('status',response.result);
                retMap.set('data',response.info);
                retMap.set('message',response.message);
                resolve(retMap);
            },
            error: function (request, status, error) {
                retMap.set('status','error');
                retMap.set('data','');
                retMap.set('message',error);
                reject(retMap);
            }
        });
    });
}

function Load_API2(url,dataarr){
    return new Promise(function(resolve, reject){
        console.log('call api=' + url);
        console.log(JSON.stringify(dataarr));
        let retMap = new Map();
        $.ajax({
            url: url,
            type: 'POST',
            contentType: "application/json",
            dataType : "JSON",
            data: JSON.stringify(dataarr),
            // data: dataarr,
            success: function (response) {
                retMap.set('status',response.result);
                retMap.set('data',response.info);
                retMap.set('message',response.message);
                resolve(retMap);
            },
            error: function (request, status, error) {
                retMap.set('status','error');
                retMap.set('data','');
                retMap.set('message',error);
                reject(retMap);
            }

        });
    });
}

function Load_API_Form(url,f_data){
    return new Promise(function(resolve, reject){
        console.log('call form api=' + url);
        let retMap = new Map();
        $.ajax({
            url: url,
            type : 'POST',
            data: f_data,
            dataType: "JSON",
            cache : false,
            processData : false,
            contentType : false,
            success: function (response) {
                retMap.set('status',response.result);
                retMap.set('data',response.info);
                retMap.set('message',response.message);
                resolve(retMap);
            },
            error: function (request, status, error) {
                retMap.set('status','error');
                retMap.set('data','');
                retMap.set('message',error);
                reject(retMap);
            }
        });
    });
}

function Load_API_File(url,f_data){
    return new Promise(function(resolve, reject){
        console.log('call file api=' + url);
        console.log(f_data);
        let retMap = new Map();
        $.ajax({
            url: url,
            type : 'POST',
            data: f_data,
            enctype		: 'multipart/form-data',
            processData : false,
            contentType : false,
            success: function (response) {
                retMap.set('status',response.result);
                retMap.set('data',response.info);
                retMap.set('message',response.message);
                resolve(retMap);
            },
            error: function (request, status, error) {
                retMap.set('status','error');
                retMap.set('data','');
                retMap.set('message',error);
                reject(retMap);
            }
        });
    });
}

function Return_Step_Name(step){
    let val = parseInt(step,10);
    switch(val){
        case 1: return "취소";
        case 2: return "전체반품";
        case 3: return "부분반품";
        case 4: return "전체교환";
        case 5: return "부분교환";
        default: return '';
    }
}
function Order_Step_Name(step){
    let val = parseInt(step,10);
    switch(val){
        case 0: return "미확인";
        case 1: return "제품준비중";
        case 2: return "배송준비중";
        case 3: return "배송중";
        case 4: return "배송완료";
        case 5: return "주문취소";
        case 6: return "반품진행중";
        case 7: return "반품완료";
        case 8: return "교환진행중";
        case 9: return "교환완료";
        default: return '';
    }
}

function Order_Type_Name(step) {
    let val = parseInt(step,10);
    switch(val){
        case 1: return "일반";
        case 2: return "정기";
        case 3: return "대량";
        default: return '';
    }
}

function Package_Step_Name(step) {
    let val = parseInt(step,10);
    switch(val){
        case 0: return "제품준비중";
        case 1: return "배송준비중";
        case 2: return "배송중";
        case 3: return "배송완료";
        default: return '';
    }
}


function Make_Toast(msg){
    // const div = document.createElement('div');
    // div.classList.add('toastBox');
    // div.innerHTML = msg.replace(/\n/g, '<br>');  // \n을 <br>로 바꿈
    // document.body.appendChild(div);
    //
    // setTimeout(() => {
    //     div.remove();
    // }, 1500);
    const formattedMsg = msg.replace(/\\n/g, '\n');
    alert(formattedMsg);
}

function Make_Toast_URL(msg,URL){
    const div = document.createElement('div');
    div.classList.add('toastBox');
    div.innerHTML = msg.replace(/\n/g, '<br>');  // \n을 <br>로 바꿈
    document.body.appendChild(div);

    setTimeout(() => {
        $(location).attr('href',URL);
    }, 800);
}


function checkValidDate(value) {
    var result = true;
    try {
        var date = value.split("-");
        var y = parseInt(date[0], 10),
            m = parseInt(date[1], 10),
            d = parseInt(date[2], 10);

        var dateRegex = /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/;
        result = dateRegex.test(d+'-'+m+'-'+y);
    } catch (err) {
        result = false;
    }
    return result;
}

function div_close(id,reload){
    if(reload==1){
        location.reload();
    }
    $('#' + id).hide();

}

function go_BigOrder(){
    let uid = $('#tUid').val();
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        url = "/Mypage/burkOrderForm";
        $(location).attr("href", url);
    }
}

function go_RegularOrder() {
    let uid = $('#tUid').val();
    if (uid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else {
        url = "/Mypage/regularOrder";
        $(location).attr("href", url);
    }
}



function go_main() {
    var url = "/";
    $(location).attr("href", url);
}


// function go_detail(hncode,ptype){
//     let uid = $('#tUid').val();
//     if(uid==''){
//         url = '/Member/Login';
//         $(location).attr("href", url);
//     } else{
//         url = "/Product/itemDetail?hd=" + hncode + '&pt=' + ptype;
//         $(location).attr("href", url);
//     }
// }

function go_productList(typ) {
    let url = '';
    let uid = $('#tUid').val();
    let sKey = $('#h_sKey').val();
    if (uid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else {
        if (typ == '') {
            url = "/Product/pList";
        } else {
            url = "/Product/pList?lp=" + typ + "&skey=" + sKey;
        }
    }
    $(location).attr("href", url);
}



function g_close(){
    self.close();
}
function go_cart() {
    var url = ORDERURL + "/Cart";
    $(location).attr("href", url);
}

function go_smart() {
    var url = DECOCURL + "/SmartOrder";
    $(location).attr("href", url);
}

function go_logout(){
    var url = "/Member/Logout";
    $(location).attr("href", url);
}

function go_login(){
    var url = "/Member/Login";
    $(location).attr("href", url);
}

function go_detail(hncode,ptype){
    let uid = $('#tUid').val();
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        url = "/Product/itemDetail?hd=" + hncode + '&pt=' + ptype;
        $(location).attr("href", url);
    }
}

function go_delInfo() {
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/deliveryInfo";
        $(location).attr("href", url);
    }
    // var url = DECOCURL + "/deliveryInfo";
    // $(location).attr("href", url);
}

function go_prdBarcode() {
    var url = PHARMURL + "/settings/prdBarcode";
    $(location).attr("href", url);
}

function pop_Maching() {
    var url = "/Order/SmartOrder";
    $(location).attr("href", url);
}

function pop_Maching2() {
    var url = "/Order/SmartOrder";
    $(location).attr("href", url);
}

function do_refresh() {
    location.reload();
}

function top_secret() {
    // var url = "/Order/Cart";
    // $(location).attr("href", url);
    $('#accPopCon').toggle();
}


// board ---------------

function go_Board_Notice(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        url = "/Board/bList?bid=1";
        $(location).attr("href", url);
    }
}

function go_Board_Form(bid) {
    let uid = $('#tUid').val();

    if (uid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else {
         url = "/Board/boardForm?bid=" + bid;
         $(location).attr("href", url);
    }
}

function go_Board_editForm(bid,bcode,uid) {
    let mitype = $('#title').data('mitype');
    let tUid = $('#tUid').val();

    if (tUid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else if (tUid == uid || mitype == 'master') {
        url = "/Board/editForm?bid=" + bid +"&bcode="+bcode;
        $(location).attr("href", url);
    } else {
        url = "/Board/bList?bid=" + bid ;
        $(location).attr("href", url);
    }
}

function go_replyForm(bid,bcode) {
    let mitype = $('#title').data('mitype');
    let tUid = $('#tUid').val();
    let p_uid = $('#p_uid').val();
    // console.log(bid);

    if (tUid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else if (mitype == 'master'){
        url = "/Board/replyForm?bid=" + bid +"&bcode="+bcode;
        $(location).attr("href", url);
        Load_BContent_Reply();
    } else {
        url = "/Board/bList?bid=" + bid ;
        $(location).attr("href", url);
    }
}

function go_InqForm(bid,bcode) {
    let uid = $('#tUid').val();
    //let bid = $('#title').data('bid');
    // console.log(bid);
    if (uid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else {
        url = "/Board/InqForm?bid=" + bid + '&bcode=' + bcode;
        $(location).attr("href", url);
    }
}

function go_Board_Notice_Form(){
    let uid = $('#tUid').val();
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        url = "/Board/notice_Form";
        $(location).attr("href", url);
    }
}

function go_Board_Faq(){
    let uid = $('#tUid').val();
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        url = "/Board/bList?bid=2";
        $(location).attr("href", url);
    }
}

function go_Board_Inquiry(){
    let uid = $('#tUid').val();
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        url = "/Board/bList?bid=3";
        $(location).attr("href", url);
    }
}

function go_Board_Inquiry_Form(){
    let uid = $('#tUid').val();
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        url = "/Board/inquiry/form" ;
        $(location).attr("href", url);
    }
}

function g_GetLoginCookie() {
    var readCookie = $.cookie("djmedi_returl");
    var returl = "";
    if (readCookie == "" || readCookie == undefined) {
        returl = "";
    } else {
        $.removeCookie("djmedi_returl", { path: "/" });
        returl = readCookie;
    }
    return returl;
}

function g_SetLogin(url) {
    $.cookie("djmedi_returl", url, {
        expires: 1,
        path: "/",
    });
    $(location).attr("href", url);
}


// refund & exchange---------------

function go_InqForm(hncode) {
    let uid = $('#tUid').val();
    //let bid = $('#title').data('bid');
    // console.log(bid);
    if (uid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else {
        url = "/Board/InqForm?bid=" + bid + '&bcode=' + bcode;
        $(location).attr("href", url);
    }
}


function go_claimList(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/claimList";
        $(location).attr("href", url);
    }
}


function go_claim(hncode){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/claim?hncode=" + hncode;
        // url = tUrl + "/claim";
        $(location).attr("href", url);
    }
}

function go_reOrder(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/reOrder";
        // url = tUrl + "/claim";
        $(location).attr("href", url);
    }
}

// mypage ---------------
function go_mypage(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        tUrl = $('#tUrl').val();
        $(location).attr("href", tUrl);
    }
}

function go_herbList(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/herbList";
        $(location).attr("href", url);
    }
}

function go_herbMatch(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/herbMatch";
        $(location).attr("href", url);
    }
}

function go_orderList(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/orderList";
        $(location).attr("href", url);
    }
}

function go_shipList(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/shipList";
        $(location).attr("href", url);
    }
}

function go_stock(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    } else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/stockListDecoc";
        $(location).attr("href", url);
    }
}

function go_deliveryList(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/deliveryList";
        $(location).attr("href", url);
    }
}

function go_putList(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/putList";
        $(location).attr("href", url);
    }
}





function go_burkOrderForm(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/burkOrderForm";
        $(location).attr("href", url);
    }
}


function go_herbReg(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/herbReg";
        $(location).attr("href", url);
    }
}

function go_herbReg_settingData(hncode){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/herbReg?rc=" + hncode;
        $(location).attr("href", url);
    }
}

function go_herbRegAll(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/herbRegAll";
        $(location).attr("href", url);
    }
}

function go_burkOrder(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/burkOrder";
        $(location).attr("href", url);
    }
}


function go_herbModifier(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/herbModifier";
        $(location).attr("href", url);
    }
}


function formatDate(d) {
    const year = d.getFullYear();
    const month = ('0' + (d.getMonth() + 1)).slice(-2);
    const day = ('0' + d.getDate()).slice(-2);
    return `${year}-${month}-${day}`;
}

function go_dashBoard(){
    let uid = $('#tUid').val();
    let url = '';
    if(uid==''){
        url = '/Member/Login';
        $(location).attr("href", url);
    }else{
        let tUrl = $('#tUrl').val();
        url = tUrl + "/dashBoard";
        $(location).attr("href", url);
    }
}


function Join_attr_string(arr, sep){
    return arr.filter(e => e).join(sep);
}


function number_format(num){
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g,',');
}

function start_spinner() {
    $('#spinnerBox').addClass('active');
    $('#spinner').addClass('active');

}

function stop_spinner(){
    $('#spinnerBox').removeClass('active');
    $('#spinner').removeClass('active');
}

function add_wishlist(e){
    $(e).toggleClass('active');

    const iconBox = $(e).find('.wishHeartBox');
    const icon = $(e).find('.wishHeart');
    if(icon.hasClass('fa-regular')){
        iconBox.addClass('.wishHeartBox');
        iconBox.removeClass('active');
        icon.removeClass('fa-regular')
            .addClass('fa-solid wishHeart active');
    } else {
        iconBox.addClass('active');
        icon.removeClass('fa-solid active')
            .addClass('fa-regular wishHeart');
    }
    // $(e).find('.wishHeart').toggleClass('active');
    console.log("hello1201");

    // const icon = $(e).find('.wishHeart');
    // if(icon.hasClass('fa-regular')){
    //     icon.removeClass('fa-regular heart1-1 wishHeart')
    //         .addClass('fa-solid heart1-2');
    // } else {
    //     icon.removeClass('fa-solid heart1-2')
    //         .addClass('fa-regular fa-heart heart1-1 wishHeart');
    // }

    console.log("hello1201");
}

function printWindow(id) {
    var printContent = document.getElementById(id).innerHTML;
    var printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write('<html><head><title>Print</title>');
    var rnd = Math.floor(Math.random() * 10000);
    var cssstr = "<link rel='stylesheet' href='/assets/web/css/style.css?rnd=" + rnd + "' />";
    printWindow.document.write(cssstr);
    console.log(cssstr, 'dawn1659');
    printWindow.document.write('</head><body>');
    printWindow.document.write(printContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    setTimeout(function () {
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }, 1000);
}

function barcodePreview(code) {
    let uid = $('#tUid').val();
    let url = '';
    if (uid == '') {
        url = '/Member/Login';
        $(location).attr("href", url);
    } else {
        let tUrl = $('#tUrl').val();
        url = tUrl + "/settings/prdBarcodePreview?hn=" + code;
        window.open(url, 'barcodePopup', 'width=300,height=400,resizable=yes,scrollbars=yes');
    }
}



function dataCopy(text) {
    let textArea = document.createElement("textarea");
    textArea.value = text;

    // 화면 밖으로 위치 이동시키기
    textArea.style.position = "fixed";
    textArea.style.left = "-9999px";
    textArea.style.top = "-9999px";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        document.execCommand('copy');
        Make_Toast('복사완료');
    } catch (err) {
        Make_Toast('복사실패');
        console.error('Fallback: 복사 실패', err);
    }

    document.body.removeChild(textArea);
}

function concatWithDelimiter(base, val, delimiter) {
    if(val === '') return base;
    return base === '' ? val : base + delimiter + val;
}

function stopScroll(){
    $('html, body').addClass('body-no-scroll');
}

function startScroll(){
    $('html, body').removeClass('body-no-scroll');
}

function addDays(days = 0, dateStr = '') {
    var date = (dateStr.trim() === '') ? new Date() : new Date(dateStr);
    if (isNaN(date.getTime())) {
        console.error("유효하지 않은 날짜 형식입니다.");
        return null;
    }
    date.setDate(date.getDate() + parseInt(days, 10));
    var offset = date.getTimezoneOffset() * 60000;
    var result = new Date(date.getTime() - offset).toISOString().split("T")[0];
    return result;
}


function fnToDay(){
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;

    return formattedDate;
}


/**
 * 페이징 HTML을 생성하여 대상 요소에 삽입하는 함수
 * @param {string} theme - 페이징 테마
 * @param {object} params - {total, page, perpage, bname}
 */
function Make_Page_Html(theme, params) {
    const total = parseInt(params.total || 0);
    let nowpage = parseInt(params.page || 1);
    const perPage = parseInt(params.perpage || 10);
    const btnName = params.bname || 'btnLinkPaging';
    const blockCount = 10;

    if (total <= 0 || perPage <= 0) return;

    const totalPage = Math.ceil(total / perPage);
    if (nowpage < 1) nowpage = 1;
    if (nowpage > totalPage) nowpage = totalPage;

    const startPage = Math.floor((nowpage - 1) / blockCount) * blockCount + 1;
    const endPage = Math.min(startPage + blockCount - 1, totalPage);
    let html = '';
    switch (theme) {
        case 'simple':
            html = "<div class='flexType1'>";
            if (startPage > blockCount) {
                const prevPage = startPage - 1;
                html += `<button type='button' class='page flexType1' name='${btnName}' data-page='${prevPage}'><i class='fa-solid fa-angles-left'></i></button>`;
            }
            for (let i = startPage; i <= endPage; i++) {
                const activeClass = (i === nowpage) ? 'active' : '';
                html += `<button type='button' class='page flexType1' name='${btnName}' data-page='${i}'><p class='page_p ${activeClass}'>${i}</p></button>`;
            }
            if (endPage < totalPage) {
                const nextPage = endPage + 1;
                html += `<button type='button' class='page flexType1' name='${btnName}' data-page='${nextPage}'><i class='fa-solid fa-angles-right'></i></button>`;
            }
            html += '</div>';
            break;
    }

    return html;
}

