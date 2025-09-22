$(document).ready(function () {

    function go_prdBarcode() {
        let uid = $('#tUid').val();
        let url = '';
        if (uid == '') {
            url = '/Member/Login';
            $(location).attr("href", url);
        } else {
            let tUrl = $('#tUrl').val();
            url = tUrl + "/settings/prdBarcode";
            $(location).attr("href", url);
        }
    }

    function exit_thisWindow() {
        window.close();
    }

    function print_thisPage() {
        window.print();
    }


});


