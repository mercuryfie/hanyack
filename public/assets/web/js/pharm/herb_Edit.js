
$(document).ready(function() {
    // calendar --------------
    const datepickers = document.querySelectorAll(".datepicker");
    const calIcons = document.querySelectorAll(".calicon");

    datepickers.forEach((datepicker, index) => {
        let options = {
            dateFormat: "Y-m-d",
            static: true,
            appendTo: datepicker.parentNode,
            onClose: function (selectedDates, dateStr, instance) {
                instance.element.blur();
            },
        };

        if (datepicker.closest(".datepicker1-1") ||
            datepicker.closest(".datepicker1-2")
        ) { options.minDate = null; // 특정 조건에 따라 minDate 설정
        } else {
            options.minDate = "today";
        }

        const fp = flatpickr(datepicker, options);

        calIcons[index].addEventListener("click", function (e) {
            e.preventDefault();
            fp.toggle();
        });
    });




});

