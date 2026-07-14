<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<script>

    document.addEventListener("DOMContentLoaded", function () {


        const selectAll = document.querySelectorAll('.selectAll');
        selectAll.forEach(selectCheckbox => {
            selectCheckbox.addEventListener('change', function () {
                const columnClass = `column-${this.dataset.column}`;
                const columnCheckboxes = document.querySelectorAll(`.${columnClass}`);
                columnCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        });

        $('.itemFilter').click(function() {
            $('.itemFilter').removeClass('periodSelected');
            $(this).addClass('periodSelected');
        });

    });
</script>

<section class="merright">
    <div class="merright1-0">
    </div>
    <!-- <div class="merright1-1">
        <p>필터</p>
        <div class="merli1-1">
            <button>전체보기</button>
            <button>매칭약재</button>
            <button>미매칭약재</button>
        </div>
    </div> -->
    <div class="merlibox1-1">
        <p>배송내역</p>
        <!-- <button>새 창</button> -->
        <div class="odrbox1-1">
            <div class="odrbox1-1-1">
                <p>조회기준일</p>
                <select name="" id="pharli">
                    <option value="결제일">결제일</option>
                    <option value="주문확인일">주문확인일</option>
                    <option value="발송처리일">발송처리일</option>
                    <!--                <option value="paidDate">결제일</option>-->
                    <!--                <option value="orderNoticed">주문확인일</option>-->
                    <!--                <option value="orderSent">발송처리일</option>-->
                </select>
            </div>
            <div class="odrbox1-1-2">
            </div>
        </div>
        <div class="peribox">
            <button class="deliItemFilter">오늘</button>
            <button class="deliItemFilter">1주일</button>
            <button class="deliItemFilter">1개월</button>
            <button class="deliItemFilter">3개월</button>
            <button class="deliItemFilter">6개월</button>
            <select name="" id="pharli">
                <option value="">제약사</option>
                <option value="">전체</option>
                <option value="광명당">광명당</option>
                <option value="대연제약">대연제약</option>
                <option value="디제이허브">디제이허브</option>
                <option value="바른한방">바른한방</option>
                <option value="영천">영천</option>
                <option value="CJ">CJ</option>
                <option value="CK">CK</option>
                <option value="허브팜">허브팜</option>
            </select>
        </div>
<!--        <div class="mersearch">-->
<!--            <div>-->
<!--                <input type="text" placeholder="검색어를 입력하십시오">-->
<!--                <button>조회</button>-->
<!--            </div>-->
<!--            <button onclick="go_herbReg();">약재 등록</button> -->
<!--        </div>-->
        <table class="merlitable">
            <thead>
                <tr>
                    <td class="merlirow">
                        <input type="checkbox" name="" id="" class="selectAll" data-column="1" >
                    </td>
                    <td class="merlirow">업체명</td>
                    <td class="merlirow">결제일</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">원산지</td>
                    <td class="merlirow">구분</td>
                    <td class="merlirow">가공방법</td>
                    <td class="merlirow">규격</td>
                    <td class="merlirow">근당가격</td>
                    <td class="merlirow">포장가격</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="checkbox" name="" id="" class="column-1">
                    </td>
                    <td>채움생</td>
                    <td>today</td>
                    <td>감초</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="" id="" class="column-1">
                    </td>
                    <td>채움생</td>
                    <td>today</td>
                    <td>갈근</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="" id="" class="column-1">
                    </td>
                    <td>도솔</td>
                    <td>2025.01.01</td>
                    <td>title8</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="" id="" class="column-1">
                    </td>
                    <td>도솔</td>
                    <td>2025.01.01</td>
                    <td>title8</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>

<!--    <div class="merrightlast">-->
<!--        <button>취소</button>-->
<!--        <button>확인</button> -->
<!--    </div>-->
</section>

<?= $this->endSection() ?>
