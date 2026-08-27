<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>


<script src="<?=URL_PHARM_ASSETS?>/deliveryListPharm_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //
    //
    //     const selectAll = document.querySelectorAll('.selectAll');
    //     selectAll.forEach(selectCheckbox => {
    //         selectCheckbox.addEventListener('change', function () {
    //             const columnClass = `column-${this.dataset.column}`;
    //             const columnCheckboxes = document.querySelectorAll(`.${columnClass}`);
    //             columnCheckboxes.forEach(checkbox => {
    //                 checkbox.checked = this.checked;
    //             });
    //         });
    //     });
    //
    //     $('.itemFilter').click(function() {
    //         $('.itemFilter').removeClass('periodSelected');
    //         $(this).addClass('periodSelected');
    //     });
    //
    // });
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
        <p>발송내역</p>
        <!-- <button>새 창</button> -->
        <div class="deliBox">
            <div class="searchBox">
                <p>조회</p>
                <input type="text" placeholder="업체명 or 약재명 검색">
            </div>
            <div class="periodBox">
                <p>기간설정</p>
                <button class="itemFilter">오늘</button>
                <button class="itemFilter">1주일</button>
                <button class="itemFilter">1개월</button>
                <button class="itemFilter">3개월</button>
                <button class="itemFilter">6개월</button>
                <!--            <select name="" id="pharli">-->
                <!--                <option value="">제약사</option>-->
                <!--                <option value="">전체</option>-->
                <!--                <option value="광명당">광명당</option>-->
                <!--                <option value="대연제약">대연제약</option>-->
                <!--                <option value="디제이허브">디제이허브</option>-->
                <!--                <option value="바른한방">바른한방</option>-->
                <!--                <option value="영천">영천</option>-->
                <!--                <option value="CJ">CJ</option>-->
                <!--                <option value="CK">CK</option>-->
                <!--                <option value="허브팜">허브팜</option>-->
                <!--            </select>-->
            </div>
            <div class="statusBox">
                <p>상태</p>
                <select name="" id="pharli" class="selectType1">
                    <option value="전체">전체</option>
                    <option value="발송미확인">발송대기</option>
                    <option value="발송미확인">발송처리</option>
                    <option value="발송확인">발송완료</option>
                    <!--                <option value="paidDate">결제일</option>-->
                    <!--                <option value="orderNoticed">주문확인일</option>-->
                    <!--                <option value="orderSent">발송처리일</option>-->
                </select>

                <p class="category2">원탕별</p>
                <select name="" id="pharli" class="selectType1">
                    <!--                    <option value="">원</option>-->
                    <option value="">전체</option>
                    <option value="디제이허브">더한</option>
                    <option value="대연제약">따뜻할온</option>
                    <option value="바른한방">안심</option>
                    <option value="광명당">채움생</option>
                </select>
            </div>
            <div class="odrbox1-1-2">
<!--                <button class="itemFilter">master</button>-->
<!--                <button class="itemFilter" onclick="go_orderList();">제약사</button>-->
<!--                <button class="itemFilter" onclick="go_orderList();">원탕</button>-->
            </div>
        </div>
<!--        <div class="mersearch">-->
<!--            <div>-->
<!--                <input type="text" placeholder="검색어를 입력하십시오">-->
<!--                <button>조회</button>-->
<!--            </div>-->
<!--            <button onclick="go_herbReg();">약재 등록</button> -->
<!--        </div>-->

        <div class="deliBox1-1">
            <table class="merlitable deliTable1-1">
                <thead>
                <tr>
<!--                    <td class="merlirow">-->
<!--                        <input type="checkbox" name="" id="" class="selectAll" data-column="1" >-->
<!--                    </td>-->
                    <td class="merlirow">상태</td>
                    <td class="merlirow">출하코드</td>
                    <td class="merlirow">업체명</td>
                    <td class="merlirow">약재종류</td>
                    <td class="merlirow">총합</td>
                    <td class="merlirow">총무게</td>
                    <td class="merlirow">발송타입</td>
                    <td class="merlirow">송장번호</td>
<!--                    <td class="merlirow">확인</td>-->
                    <td class="merlirow">출력</td>
                    <td class="merlirow">출하처리일</td>
                    <td class="merlirow">발송처리일</td>
                    <!--                    <td class="merlirow">포장가격</td>-->
                </tr>
                </thead>
                <tbody>
                <tr>
<!--                    <td>-->
<!--                        <input type="checkbox" name="" id="" class="column-1">-->
<!--                    </td>-->
                    <td class="">발송대기 <br>발송처리</td>
                    <td>
                        <a href="#" class="aType1">132412341234</a>
                    </td>
                    <td>채움생</td>
                    <td>2종</td>
                    <td>10개</td>
                    <td>84,000(g)</td>
                    <td>직배
                    </td>
                    <td>123412341234
<!--                        <input type="text" name="" id="" placeholder="123412341234" class="">-->
                    </td>
<!--                    <td>-->
<!--                        <button class="btntype1">확인</button>-->
<!--                    </td>-->
                    <td>
                        <button class="btnType1">출력하기</button>
                    </td>
                    <td>2025.01.01</td>
                    <td>2025.01.01</td>
                </tr>
                <tr>
                    <!--                    <td>-->
                    <!--                        <input type="checkbox" name="" id="" class="column-1">-->
                    <!--                    </td>-->
                    <td class="">발송대기 <br>발송처리</td>
                    <td>
                        <a href="#" class="aType1">132412341234</a>
                    </td>
                    <td>채움생</td>
                    <td>2종</td>
                    <td>10개</td>
                    <td>84,000(g)</td>
                    <td>직배
                    </td>
                    <td>123412341234 </td>
                    <!--                    <td>-->
                    <!--                        <button class="btntype1">확인</button>-->
                    <!--                    </td>-->
                    <td>
                        <button class="btnType1">출력하기</button>
                    </td>
                    <td>2025.01.01</td>
                    <td>2025.01.01</td>
                </tr>
                <tr>
                    <!--                    <td>-->
                    <!--                        <input type="checkbox" name="" id="" class="column-1">-->
                    <!--                    </td>-->
                    <td class="">발송대기 <br>발송처리</td>
                    <td>
                        <a href="#" class="aType1">132412341234</a>
                    </td>
                    <td>채움생</td>
                    <td>2종</td>
                    <td>10개</td>
                    <td>84,000(g)</td>
                    <td>직배
                    </td>
                    <td>123412341234
                        <!--                        <input type="text" name="" id="" placeholder="123412341234" class="">-->
                    </td>
                    <!--                    <td>-->
                    <!--                        <button class="btntype1">확인</button>-->
                    <!--                    </td>-->
                    <td>
                        <button class="btnType1">출력하기</button>
                    </td>
                    <td>2025.01.01</td>
                    <td>2025.01.01</td>
                </tr>


                </tbody>
            </table>
        </div>

        <div class="moreListBox">
            <button class="moreList" id="more" name="more" type="button">
<!--                    data-page="--><?php //=$body['page']?><!--"-->


                더보기
            </button>
            <i class="fa-solid fa-angle-down" id="more2" name="more2"></i>
        </div>
    </div>

<!--    <div class="merrightlast">-->
<!--        <button>취소</button>-->
<!--        <button>발송처리</button>-->
<!--        <button onclick="go_herbReg();">약재 등록</button>-->
<!--    </div>-->
</section>

<?= $this->endSection() ?>
