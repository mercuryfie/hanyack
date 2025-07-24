$(document).ready(function () {

    // $('.subtab').css('color','green');


    // canvas tab starts ------------------------------------------------
    // const green = '#5e9b76';
    // const gray = '#ccc';
    // const charcoal = '#5c5c5c';
    //
    // function setBoxColor($box, color, isActive = false) {
    //     // const subtabColor = isActive ? color : '#7c7c7c';
    //     $box.find('canvas.line').each((i, el) => {
    //         const ctx = el.getContext('2d');
    //         ctx.strokeStyle = color;
    //         ctx.beginPath();
    //         ctx.moveTo(0, 10);
    //         ctx.lineTo(80, 10);
    //         ctx.stroke();
    //     });
    //     $box.find('canvas.line2').each((i, el) => {
    //         const ctx = el.getContext('2d');
    //         ctx.strokeStyle = color;
    //         ctx.beginPath();
    //         ctx.moveTo(80, 10);
    //         ctx.lineTo(92, 28);
    //         ctx.stroke();
    //     });
    //     $box.find('.subtab').css('color', color);
    // }
    //
    // function showBuyOptionByBoxId(boxId) {
    //     $('#buyOption1, #buyOption2, #buyOption3').hide();
    //     if (boxId === 'canvasBox1') {
    //         $('#buyOption1').show();
    //     } else if (boxId === 'canvasBox2') {
    //         $('#buyOption2').show();
    //     } else if (boxId === 'canvasBox3') {
    //         $('#buyOption3').show();
    //     }
    // }
    //
    // function activateBox($box) {
    //     $('.canvas_box').removeClass('active').each((i, el) => setBoxColor($(el), gray));
    //     $box.addClass('active');
    //     setBoxColor($box, green);
    //     showBuyOptionByBoxId($box.attr('id'));
    // }
    //
    // $('.canvas_box').on('click', function (e) {
    //     e.stopPropagation();
    //     // const $clicked = $(this);
    //     const isActive = $(this).hasClass('active');
    //
    //     if (isActive) {
    //         if ($('.canvas_box.active').length === 1) {
    //             return;
    //         }
    //         $(this).removeClass('active');
    //         setBoxColor($(this), gray);
    //
    //         activateBox($('#canvasBox1'));
    //     } else {
    //         activateBox($(this));
    //     }
    // });
    //
    // $(document).ready(function () {
    //     activateBox($('#canvasBox1'));
    // });
    // canvas tab end ------------------------------------------------




    let t1 = $('#t1_value').text();
    let $optionP = $("p[name='t_option']");

    if (t1 != '') {
        $optionP.css('display', 'block').text('/');
    } else {
        $optionP.css('display', 'none').text('');
    }

    let unitPrice = parseInt($('#unit_price').text().replace(/,/g, ''),10);
    console.log(unitPrice);
    $('i[name="plus"]').on('click', function() {
        let cnt = parseInt($('#price_cnt').text(), 10);
        console.log(cnt);
        if ( cnt < 99) {
            cnt++;
            $('#price_cnt').text(cnt);
            updateTotalPrice(cnt, unitPrice);
        }
    });

    $('i[name="minus"]').on('click', function() {
        let cnt = parseInt($('#price_cnt').text(), 10);
        if (cnt > 1) {
            cnt--;
            $('#price_cnt').text(cnt);
            updateTotalPrice(cnt, unitPrice);
        }
    });

    function updateTotalPrice(cnt, price) {
        let total = cnt * price;
        $('#ttl_price').text(total.toLocaleString());
    }
    $('i[name="heart"]').on('click', function() {
        $(this).toggleClass('fa-solid');
        alert('added wishlist');
    });
});

function drawAllGrayLines() {
    $('.line').each((i, el) => {
        const ctx = el.getContext('2d');
        ctx.clearRect(0, 0, el.width, el.height);
        ctx.strokeStyle = '#ccc';
        ctx.beginPath();
        ctx.moveTo(0, 10);
        ctx.lineTo(80, 10);
        ctx.stroke();
    });

    $('.line2').each((i, el) => {
        const ctx = el.getContext('2d');
        ctx.clearRect(0, 0, el.width, el.height);
        ctx.strokeStyle = '#ccc';
        ctx.beginPath();
        ctx.moveTo(80, 10);
        ctx.lineTo(92, 28);
        ctx.stroke();
    });
}

// function resetAllToGray() {
//
//     $('.line').each((i, el) => {
//         const ctx = el.getContext('2d');
//         ctx.clearRect(0, 0, el.width, el.height);
//         ctx.strokeStyle = '#ccc';
//         ctx.beginPath();
//         ctx.moveTo(0, 10);
//         ctx.lineTo(80, 10);
//         ctx.stroke();
//     });
//
//     $('.line2').each((i, el) => {
//         const ctx = el.getContext('2d');
//         ctx.clearRect(0, 0, el.width, el.height);
//         ctx.strokeStyle = '#ccc';
//         ctx.beginPath();
//         ctx.moveTo(80, 10);
//         ctx.lineTo(92, 28);
//         ctx.stroke();
//     });
//
//     $('.default').each((i, el) => {
//         const ctx = el.getContext('2d');
//         ctx.clearRect(0, 0, el.width, el.height);
//         ctx.strokeStyle = '#5e9b76';
//         ctx.beginPath();
//         ctx.moveTo(0, 10);
//         ctx.lineTo(80, 10);
//         ctx.stroke();
//     });
//
//     $('.default2').each((i, el) => {
//         const ctx = el.getContext('2d');
//         ctx.clearRect(0, 0, el.width, el.height);
//         ctx.strokeStyle = '#5e9b76';
//         ctx.beginPath();
//         ctx.moveTo(80, 10);
//         ctx.lineTo(92, 28);
//         ctx.stroke();
//     });
//
//     $('.canvas_box .defaultText').css('color', '#5e9b76');
//     $('.canvas_box .subtab').css('color', '#ccc');
//     $('.canvas_box').removeClass('active');
// }


