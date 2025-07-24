$(document).ready(function() {



    // $('p').css('color','pink');
    // orderListPharm
    $('.selectAll').on('change', function () {
        const columnClass = `column-${this.dataset.column}`;
        document.querySelectorAll(`.${columnClass}`).forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // itemFilter --------------
    $('.itemFilter').click(function() {
        $('.itemFilter').removeClass('periodSelected');
        $(this).addClass('periodSelected');
    });

    // calendar --------------
    $('.datepicker').each(function(index, datepicker) {
        let $datepicker = $(datepicker);
        let options = {
            dateFormat: "Y-m-d",
            static: true,
            appendTo: $datepicker.parent()[0],
            onClose: function(selectedDates, dateStr, instance) {
                $(instance.element).blur();
            }
        };

        if ($datepicker.closest(".datepicker1-5").length > 0) {
            options.minDate = null;
        } else {
            options.minDate = "2024-01-01";
        }

        const fp = flatpickr(datepicker, options);

        $('.calicon').eq(index).on('click', function(e) {
            e.preventDefault();
            fp.toggle();
        });
    });


    // calendar --------------
    // const datepickers = document.querySelectorAll(".datepicker");
    // const calIcons = document.querySelectorAll(".calicon");
    //
    // datepickers.forEach((datepicker, index) => {
    //     let options = {
    //         dateFormat: "Y-m-d",
    //         static: true,
    //         appendTo: datepicker.parentNode,
    //         onClose: function (selectedDates, dateStr, instance) {
    //             instance.element.blur();
    //         },
    //     };
    //
    //     if (datepicker.closest(".datepicker1-1") ||
    //         datepicker.closest(".datepicker1-2")
    //     ) { options.minDate = null; // 특정 조건에 따라 minDate 설정
    //     } else {
    //         options.minDate = "today";
    //     }
    //
    //     const fp = flatpickr(datepicker, options);
    //
    //     calIcons[index].addEventListener("click", function (e) {
    //         e.preventDefault();
    //         fp.toggle();
    //     });
    // });



    // orderListDecoc
    // popup
    // const popupConfig = [
    //     { openBtns: ".dec_orderli_ttl .deliveryStatus", popup: ".deliveryStatusPopCon", closeBtn: ".deliveryStatusPop1-0 .close" },
    //
    // ];
    //
    // popupConfig.forEach(function(config) {
    //     const $openButtons = $(config.openBtns);
    //     const $popup = $(config.popup);
    //     const $closeButton = $(config.closeBtn);
    //
    //     // 팝업 열기
    //     $openButtons.on('click', function() {
    //         $popup.show();
    //     });
    //
    //     // 팝업 닫기 (닫기 버튼)
    //     $closeButton.on('click', function() {
    //         $popup.hide();
    //     });
    //
    //     // 팝업 바깥 클릭 시 닫기
    //     $(window).on('click', function(event) {
    //         // event.target이 팝업 영역 그 자체일 때만 닫기
    //         if ($(event.target).is($popup)) {
    //             $popup.hide();
    //         }
    //     });
    // });


    // 기간 선택자 클릭 이벤트
    // $('.periodSelector').click(function() {
    //     $('.periodSelector').removeClass('periodSelected');
    //     $(this).addClass('periodSelected');
    // });



     // 접기 펼치기 관련
//     $('.odrtext').each(function() {
//         let $toggleButton = $(this);
//         let $parentDiv = $toggleButton.parent();
//         let $childItems = $parentDiv.parent().find('.decodrbb1-2-2');
//         let $toggleIcon = $parentDiv.find('.fa-solid');
//
//         $childItems.each(function(i, item) {
//             if (i < 3) {
//                 $(item).css('display', 'flex');
//             } else {
//                 $(item).css('display', 'none');
//             }
//         });
//
//         $toggleButton.text(`총 ${$childItems.length}건 주문 펼쳐보기`);
//         $toggleButton.data('expanded', false);
//
//         $toggleButton.on('click', function() {
//             let isExpanded = $toggleButton.data('expanded');
//
//             if (isExpanded) {
//                 $toggleButton.text(`총 ${$childItems.length}건 주문 펼쳐보기`);
//                 $toggleIcon.attr('class', 'fa-solid fa-angle-down');
//                 $childItems.each(function(i, item) {
//                     if (i >= 3) {
//                         $(item).css('display', 'none');
//                     }
//                 });
//             } else {
//                 $toggleButton.text(`총 ${$childItems.length}건 주문 접기`);
//                 $toggleIcon.attr('class', 'fa-solid fa-angle-up');
//                 $childItems.css('display', 'flex');
//             }
//
//             $toggleButton.data('expanded', !isExpanded);
//         });
//     });

});


