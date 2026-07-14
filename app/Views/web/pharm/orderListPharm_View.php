<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>


<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
<!-- js ----------------------------  -->
<script src="<?=URL_PHARM_ASSETS?>/orderListPharm.js?rnd=<?=rand();?>"></script>
<script src="<?=URL_PHARM_ASSETS?>/orderListPharm_Do.js?rnd=<?=rand();?>"></script>

<section class="merright">
    <div class="merright1-0">
    </div>
    <div class="common_list_wrap olp_conkol ">
<!--        <p class="main_title">주문내역-pharm</p>-->
        <!-- <button>새 창</button> -->
        <div class="  flexType3 mb10">
            <div class="left flexType2">
                <div class="left period_box flexType2 mr10">
                    <a href="javascript:;" class="period active">오늘</a>
                    <a href="javascript:;" class="period">1주일</a>
                    <a href="javascript:;" class="period">1개월</a>
                    <a href="javascript:;" class="period">3개월</a>
                </div>

                <div class=" flexType2">
                    <input type="date" name="" id="" class="input_date mr10">
                    <input type="date" name="" id="" class="input_date">
                    <!--                    <i class="fa-regular fa-calendar calicon " id=""></i>-->
                    <!--                    <input type="text" id=""-->
                    <!--                           name="datePicker"-->
                    <!--                           class="input_period  " placeholder="날짜 선택" readonly>-->
                    <!--                    <p class="dash">-</p>-->
                    <!--                    <i class="fa-regular fa-calendar calicon" id="calicon1-6"></i>-->
                    <!--                    <input type="text" id=""-->
                    <!--                           name="datePicker"-->
                    <!--                           class="input_period " placeholder="날짜 선택" readonly>-->
                </div>
            </div>
            <div class="right flexType2 ">
                <select name="" id="pharli" class="select_type mr10">
                    <option value="결제일">전체날짜</option>
                    <option value="결제일">결제일기준</option>
                    <option value="주문확인일">출하처리일 기준</option>
                    <option value="발송처리일">발송처리일 기준</option>
                </select>
                <select name="" id="" class="select_type mr10">
                    <option value="">전체탕전실</option>
                    <option value="광명당">광명당</option>
                    <option value="대연제약">대연제약</option>
                    <option value="디제이허브">디제이허브</option>
                    <option value="바른한방">바른한방</option>
                    <option value="영천">영천</option>
                    <option value="CJ">CJ</option>
                    <option value="CK">CK</option>
                    <option value="허브팜">허브팜</option>
                </select>
                <select name="" id="" class="select_type">
                    <option value="">전체상태</option>
                    <option value="광명당">미확인</option>
                    <option value="대연제약">출하처리</option>
                    <option value="디제이허브">발송처리</option>
                    <option value="바른한방">발송완료</option>
                </select>
            </div>
        </div>
        <div class="flexType7 mb10">

            <input type="search" name="" id="" class="input_search" placeholder="검색어를 입력하십시오.">
            <button class="btnType32 active">조회</button>
        </div>

        <!--        <div class="merrightlast">-->
        <!--            <button type="button" id="btn_cancle" name="btn_cancle" class="btnType1 mr10">초기화</button>-->
        <!--        </div>-->
        <table class="common_table">
            <thead>
                <tr>
                    <td class="merlirow">상태</td>
                    <td class="merlirow">주문번호</td>
                    <td class="merlirow">Type</td>
                    <td class="merlirow">주문자명</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">원산지</td>
                    <td class="merlirow">구분</td>
                    <td class="merlirow">가공방법</td>
                    <td class="merlirow">포장단위(g)</td>
                    <td class="merlirow">포장단위가격</td>
                    <td class="merlirow">총가격</td>
                    <td class="merlirow">주문일자</td>
                    <td class="merlirow">출하(예정)일</td>
                    <td class="merlirow">확인</td>
                    <td class="merlirow">출력</td>
                </tr>
            </thead>
            <tbody id="orderlist">

            </tbody>

        </table>

        <div class="moreListBox">
            <button class="moreList" id="more" name="more" type="button" data-page="">
                더보기
            </button>
            <i class="fa-solid fa-angle-down" id="more2" name="more2" ></i>
        </div>
    </div>

</section>
<?= $this->endSection() ?>
