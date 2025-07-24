
$(document).ready(function() {
    // calendar --------------

    $('.datepicker').each(function(index) {
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

        if ($datepicker.closest('.datepicker1-1').length || $datepicker.closest('.datepicker1-2').length) {
            options.minDate = null;
        } else {
            options.minDate = "today";
        }

        let fp = $datepicker.flatpickr(options);

        $calIcon.on('click', function(e) {
            e.preventDefault();
            fp.open(); // 또는 fp.toggle();
        });
    });



 

});

