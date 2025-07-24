$(document).ready(function() {

    // $('.decorderli1-1-1 p').css('color','red');
    $('.itemFilter').click(function() {
        $('.itemFilter').removeClass('periodSelected');
        $(this).addClass('periodSelected');
    });


    // copy
    function dataCopy(text) {
        var tempInput = document.createElement("input");
        document.body.appendChild(tempInput);
        tempInput.value = text;
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert('복사되었습니다 ');
    }

    $(document).on('click', '.copied', function (e) {
        e.stopPropagation();
        e.preventDefault();

        // 중복 실행 방지
        if ($(this).data('copied')) return;
        $(this).data('copied', true);
        setTimeout(() => $(this).removeData('copied'), 100);

        var text = $(this).closest('.titleBox').find('.orderNo').text().trim();
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(function () {
                alert('copied!');
            }).catch(function () {
                dataCopy(text);
            });
        } else {
            dataCopy(text);
        }
    });

    // orderListDecoc
    // popup
    const popupConfig = [
        { openBtns: ".dec_orderli_ttl .deliveryStatus", popup: ".deliveryStatusPopCon", closeBtn: ".deliveryStatusPop1-0 .close" },
        { openBtns: ".dec_orderli_ttl .cancel", popup: ".cancelCheckPopCon", closeBtn: ".cancelCheckPop1-2 .close" },
        { openBtns: ".decodrbb1-2-2-1 .deliveryStatus", popup: ".deliveryStatusPopCon", closeBtn: ".deliveryStatusPop1-0 .close" },
        { openBtns: ".decodrbb1-2-2-1 .cancel", popup: ".cancelCheckPopCon", closeBtn: ".cancelCheckPop1-2 .close" },

    ];

    popupConfig.forEach(function(config) {
        const $openButtons = $(config.openBtns);
        const $popup = $(config.popup);
        const $closeButton = $(config.closeBtn);

        // 팝업 열기
        $openButtons.on('click', function() {
            $popup.show();
            $('body').css('overflow', 'hidden');
        });

        // 팝업 닫기 (닫기 버튼)
        $closeButton.on('click', function() {
            $popup.hide();
            $('body').css('overflow', '');
        });

        // 팝업 바깥 클릭 시 닫기
        $(window).on('click', function(event) {
            // event.target이 팝업 영역 그 자체일 때만 닫기
            if ($(event.target).is($popup)) {
                $popup.hide();
                $('body').css('overflow', '');
            }
        });
    });

    // 기간 선택자 클릭 이벤트
    $('.periodSelector').click(function() {
        $('.periodSelector').removeClass('periodSelected');
        $(this).addClass('periodSelected');
    });


    // flatpickr 초기화 및 캘린더 아이콘 클릭 이벤트



    $('.datepicker').each(function(index, elem) {
        const fp = flatpickr(elem, {
            dateFormat: "Y-m-d",
            minDate: "2024-01-01",
            static: true,
            appendTo: elem.parentNode,
            onClose: function(selectedDates, dateStr, instance) {
                instance.element.blur();
            }
        });

        $('.calicon').eq(index).on('click', function(e) {
            e.preventDefault();
            fp.open();
        });


    });



});

