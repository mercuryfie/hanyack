$(document).ready(function () {


    $('#businessFile').on('change', function () {
        const file = this.files[0];

        if (file) {
            $('#businessFileName').text(file.name);
        } else {
            $('#businessFileName').text('선택된 파일 없음');
        }
    });

    $('#businessFile').on('change', function () {
        const file = this.files[0];

        $('#businessFileName').text(
            file ? file.name : '선택된 파일 없음'
        );
    });

    $('#Xbtn').on('click', function () {
        go_main();
    });

    $('#userid , #passwd').on("keypress", function (key) {
        if (key.keyCode == 13) {
            Login_Do();
        }
    });

    /* 비밀번호 보기 / 숨기기 */
    $('.pw_toggle').on('click', function () {
        const $pw = $('#passwd');
        const $icon = $(this).find('i');

        if ($pw.attr('type') === 'password') {
            $pw.attr('type', 'text');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $pw.attr('type', 'password');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });


    /* ID 지우기 */
    $('.id_clear').on('click', function () {
        $('#userid').val('').focus();
    });


    /* PW 지우기 */
    $('.pw_clear').on('click', function () {
        $('#passwd').val('').focus();
    });

    $('.clearBtn').on('click', function () {
        const target = $(this).data('target');

        $(target).val('').focus();
    });

});
