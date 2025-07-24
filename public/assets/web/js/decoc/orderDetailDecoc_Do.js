$(document).ready(function () {
    Load_OrderList();

    // $(window).on('load', function (e) {
    //     Load_Product(1, 'matched');
    // });



    // $('input[name="herbFilter"]').change(function () {
    //     let value = $('input[name="herbFilter"]:checked').val();
    //     Load_Product(1, value);
    // });

    $('#selectView').on('click', function (e) {
        $('input[name="chkproduct"]').each(function (e) {
            if ($(this).is(':checked') == false) {
                $(this).parent().parent().css('display', 'none');
            }
        });
    });

    $('#AllView').on('click', function (e) {
        $('input[name="chkproduct"]').each(function (e) {
            $(this).parent().parent().css('display', '');
        });
    });

    $('#order_reg').on('click',function(e){
        let price = $('#totalprice').data('tprice');
        alert(price);

    });



    //Load_OrderList
    async function Load_OrderList(page) {
        try {
            start_spinner();
            // INI_Load_Order_Decoc();
            let result = await Load_Order_Decoc(page);
            if (result.status === 'ok') {
                // console.log(result.data);
                $('#orderListDecoc').append(result.data);
            } else {
                alert(result.msg);
            }
            stop_spinner();
        } catch (error) {
            alert(error);
            stop_spinner();
        }
    }



    //Load_Order_Decoc
    function Load_Order_Decoc(page) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: '/Api/Load_Order_Decoc',
                type: 'POST',
                dataType: 'JSON',
                data: { "page": page },
                success: function(response) {
                    if (response.result === 'ok' && response.info.length > 0) {
                        let html = '';
                        $.each(response.info, function(index, el) {
                            html += '<div class="dec_orderli">';
                            // 상단 타이틀 영역
                            html += '<div class="dec_orderli1-1">';
                            html += '  <div class="dec_orderli_ttl">';
                            html += '    <p class="date">' + (el.regidate || '') + '</p>';
                            html += '    <div class="titleBox">';
                            html += '      <p class="copied title">주문번호</p>';
                            html += '      <p class="copied orderNo">' + (el.od_code || '') + '</p>';
                            html += '      <i class="fa-regular fa-copy copied copyIcon"></i>';
                            html += '      <button class="btntype1 cancel" onclick="show_cancelOrder();">주문취소</button>';
                            html += '    </div>';
                            html += '  </div>';
                            html += '  <div class="right">';
                            html += '    <i class="fa-solid fa-angle-right"></i>';
                            html += '  </div>';
                            html += '</div>';

                            // 상품 리스트 영역
                            html += '<div class="dec_orderli1-2">';
                            // html += '  <div class="decodrbb1-2-1">';
                            // html += '    <p class="status">주문완료</p>';
                            // html += '    <p class="date">' + (el.regidate || '') + '</p>';
                            // html += '  </div>';

                            let goodsCount = el.goods ? el.goods.length : 0;

                            if (goodsCount === 1) {
                                let item = el.goods[0];
                                html += '<div class="decodrbb1-2-2">';
                                html += '  <div class="left">';
                                html += '    <p class="status">주문완료</p>';
                                html += '    <p class="pharm">' + (item.mi_name || '') + '</p>';
                                html += '  </div>';
                                html += '  <div class="right">';
                                html += '    <div class="decodrbb1-2-2-1">';
                                html += '      <p class="herbName">' + (item.hn_name || '') + '</p>';

                                var typeParts = [];
                                if (item.t1_value) typeParts.push(item.t1_value);
                                if (item.t2_value) typeParts.push(item.t2_value);
                                if (item.n_value) typeParts.push(item.n_value );
                                if (item.w_name)  typeParts.push(item.w_name);
                                var typeText = typeParts.join('/');
                                html += '<p class="type">' + typeText + '</p>';
                                // html += '      <p class="type">' + (item.t1_value || '') + '/' + (item.w_name || '') + '/' + (item.n_value || '') + 'g</p>';

                                // var type2 = '';
                                // if (item.hn_method === "1") {
                                //     type2 = '#79f8d8';
                                // } else if (item.hn_method === "2") {
                                //     type2 = '#6eec9a';
                                // } else if (item.hn_method === "0") {
                                //     type2 = '#b0ddc2';
                                // }
                                // html += '      <p class="type2' + type2 + '">' + (item.hn_method_str || '') + '</p>';
                                html += '      <p class="type2">' + (item.hn_method_str || '') + '</p>';
                                // html += '      <p class="type2">일반구매</p>';
                                // html += '      <button class="btntype1 deliveryStatus" style="margin-right: 10px" onclick="">배송현황</button>';
                                html += '      <button class="btntype1 cancel" onclick="">주문취소</button>';
                                html += '    </div>';
                                html += '    <div class="priceBox">';
                                html += '      <p class="price">' + (item.w_value || '') + ' 원</p>';
                                html += '      <p class="count">' + (item.gd_cnt || '') + '개</p>';
                                html += '    </div>';
                                html += '  </div>';
                                html += '</div>';
                            } else if (goodsCount > 1) {
                                // console.log('goodsCount > 1:', el.goods);
                                $.each(el.goods, function(idx, item) {
                                    html += '<div class="decodrbb1-2-2' + (idx > 0 ? ' hidden' : '') + '" data-odcode="' + el.od_code + '">';
                                    html += '  <div class="left">';
                                    html += '    <p class="status">주문완료</p>';
                                    html += '    <p class="pharm">' + (item.mi_name || '') + '</p>';
                                    html += '  </div>';
                                    html += '  <div class="right">';
                                    html += '    <div class="decodrbb1-2-2-1">';
                                    html += '      <p class="herbName">' + (item.hn_name || '') + '</p>';

                                    var typeParts = [];
                                    if (item.t1_value) typeParts.push(item.t1_value);
                                    if (item.t2_value) typeParts.push(item.t2_value);
                                    if (item.n_value) typeParts.push(item.n_value );
                                    if (item.w_name)  typeParts.push(item.w_name);
                                    var typeText = typeParts.join('/');
                                    html += '<p class="type">' + typeText + '</p>';
                                    // html += '      <p class="type">' + (item.t1_value || '') + '/' + (item.w_name || '') + '/' + (item.n_value || '') + 'g</p>';

                                    html += '      <p class="type2">일반구매</p>';
                                    // html += '      <button class="btntype1 deliveryStatus" style="margin-right: 10px" onclick="">배송현황</button>';
                                    html += '      <button class="btntype1 cancel" onclick="">주문취소</button>';
                                    html += '    </div>';
                                    html += '    <div class="priceBox">';
                                    html += '      <p class="price">' + (item.w_value || '') + ' 원</p>';
                                    html += '      <p class="count">' + (item.gd_cnt || '') + '개</p>';
                                    html += '    </div>';
                                    html += '  </div>';
                                    html += '</div>';
                                });
                                html += '<div class="decodrbb1-2-3" data-odcode="' + el.od_code + '">';
                                html += '  <p class="odrtext">총 ' + goodsCount + '건 주문 펼쳐보기</p>';
                                html += '  <i class="fa-solid fa-angle-down odrmore"></i>';
                                html += '</div>';
                            } else {
                                html += '<p>상품이 없습니다.</p>';
                            }

                            html += '</div>'; // dec_orderli1-2
                            html += '</div>'; // dec_orderli

                            // if (response.info.length > 6) {
                            //     html += '<div class="decodrbb1-2-3 allOrderToggle">';
                            //     html += '  <p class="odrtext">총 ' + response.info.length + '건 주문 펼쳐보기</p>';
                            //     html += '  <i class="fa-solid fa-angle-down odrmore"></i>';
                            //     html += '</div>';
                            // }


                        });

                        resolve({ status: 'ok', data: html });
                    } else {
                        resolve({ status: 'empty', msg: '주문 정보가 없습니다.' });
                    }
                },
                error: function() {
                    reject('데이터 로딩 오류');
                }
            });
        });
    }


    // 펼치기 버튼 클릭 시

    $(document).on('click', '.decodrbb1-2-3', function() {
        var $container = $(this).closest('.dec_orderli1-2');
        var $targets = $container.find('.decodrbb1-2-2').not(':first'); // 0번 제외

        // 펼쳐져 있지 않으면 펼치기
        if ($targets.is(':hidden')) {
            $targets.removeClass('hidden').slideDown(200);
            $(this).find('.odrtext').text(function(i, text){
                return text.replace('펼쳐보기', '접기');
            });
            $(this).find('.odrmore').removeClass('fa-angle-down').addClass('fa-angle-up');
        } else { // 펼쳐져 있으면 접기
            $targets.slideUp(200, function() {
                $(this).addClass('hidden');
            });
            $(this).find('.odrtext').text(function(i, text){
                return text.replace('접기', '펼쳐보기');
            });
            $(this).find('.odrmore').removeClass('fa-angle-up').addClass('fa-angle-down');
        }
    });


    // $(document).on('click', '.allOrderToggle', function() {
    //     $('.dec_orderli.hidden').removeClass('hidden').slideDown(200);
    //     var $text = $(this).find('.odrtext');
    //     var $icon = $(this).find('.odrmore');
    //     if ($text.text().includes('펼쳐보기')) {
    //         $text.text($text.text().replace('펼쳐보기', '접기'));
    //         $icon.removeClass('fa-angle-down').addClass('fa-angle-up');
    //     } else {
    //         $text.text($text.text().replace('접기', '펼쳐보기'));
    //         $icon.removeClass('fa-angle-up').addClass('fa-angle-down');
    //         // 다시 숨기려면 아래 코드도 추가
    //         $('.dec_orderli').slice(6).addClass('hidden').slideUp(200);
    //     }
    // });

    function show_cancelOrder(){
        $('#cancelCheckPopCon').show();
    }


});




