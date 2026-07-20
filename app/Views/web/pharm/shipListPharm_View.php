<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>


<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
<!-- js ----------------------------  -->
<script src="<?=URL_PHARM_ASSETS?>/shipListPharm_Do.js?rnd=<?=rand();?>"></script>

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
    <div class="common_list_wrap slp_wrap">
        <p class="main_title">배송내역</p>
        <div class="area area2 mt10">
            <div class="left flexType2">
                <div class="left period_box flexType2 mr10">
                    <a href="#" role="button"  class="period active" onclick="set_Period('');">오늘</a>
                    <a href="#" role="button" class="period" onclick="set_Period('');">1주일</a>
                    <a href="#" role="button" class="period" onclick="set_Period('');">1개월</a>
                    <a href="#" role="button" class="period" onclick="set_Period('');">3개월</a>
                </div>

                <div class="input_period_box flexType3 mr10">
                    <input type="date" class="input_date" name="sdate" id="sdate">
                    <p class="dash">-</p>
                    <input type="date" class="input_date" ame="edate" id="edate">
                </div>
                <select name="sort2" id="sort2" class="select_type mr10">
                    <option value="">전체탕전실</option>
                </select>
                <select name="deliStatus" id="deliStatus" class="select_type mr10">
                    <option value="0">전체상태</option>
                    <option value="1">미확인</option>
                    <option value="2">출하처리</option>
                    <option value="3">발송처리</option>
                    <option value="4">발송완료</option>
                </select>
                <input type="search" placeholder="검색어를 입력해 주세요." class="input_search mr10">
                <button class="btnType32-1 active" name="btnOSearch" id="btnOSearch">조회</button>
            </div>
<!--            <div class="right mb10">-->
<!--                <select name="c_date" id="c_date" class="select_type mr10">-->
<!--                    <option value="기준일">전체날짜</option>-->
<!--                    <option value="기준일">결제일</option>-->
<!--                    <option value="주문확인일">출하처리일</option>-->
<!--                    <option value="발송처리일">발송처리일</option>-->
<!--                </select>-->
<!--                <select name="c_decoc" id="c_decoc" class="select_type mr10">-->
<!--                    <option value="전체탕전실">전체탕전실</option>-->
<!--                    <option value="광명당">광명당</option>-->
<!--                    <option value="대연제약">대연제약</option>-->
<!--                    <option value="디제이허브">디제이허브</option>-->
<!--                    <option value="바른한방">바른한방</option>-->
<!--                    <option value="영천">영천</option>-->
<!--                    <option value="CJ">CJ</option>-->
<!--                    <option value="CK">CK</option>-->
<!--                    <option value="허브팜">허브팜</option>-->
<!--                </select>-->
<!--                <select name="c_status" id="c_status" class="select_type">-->
<!--                    <option value="전체상태">전체상태</option>-->
<!--                    <option value="대연제약">발송대기</option>-->
<!--                    <option value="디제이허브">발송처리</option>-->
<!--                </select>-->
<!--            </div>-->
        </div>
        <div class="area area3">
            <p class="sub_title">배송 목록</p>
            <!--            <button class="btnTypeTItle">배송 목록</button>-->
<!--            <button class="btntype1">출하취소</button>-->
        </div>
        <div class="area area4">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="merlirow">상태</th>
                    <th class="merlirow">배송코드</th>
                    <th class="merlirow">업체명</th>
                    <th class="merlirow">총 갯수</th>
                    <th class="merlirow">총 무게</th>
                    <th class="merlirow">발송타입</th>
                    <th class="merlirow">송장번호</th>
                    <th class="merlirow">확인</th>
                    <th class="merlirow">출력</th>
                    <th class="merlirow">등록일</th>
                    <!--                    <td class="merlirow">포장가격</td>-->
                </tr>
                </thead>
                <tbody id="packagelist" name="packagelist">
                <tr>
                    <td>hello, world!</td>
                </tr>
                <tr>
                    <td>hello, world!</td>
                </tr>
                <tr>
                    <td>hello, world!</td>
                </tr>


                </tbody>
            </table>
        </div>
        <div class="area area5">
            <p class="sub_title">배송 상세</p>
            <!--            <button class="btnTypeTItle">배송 상세</button>-->
<!--            <button class="btnType4" onclick="">배송취소</button>-->
        </div>
        <div class="area area6">
<!--            table2-->
            <table class="common_table">
                <thead>
                <tr>
                    <th class="merlirow">
                        <input type="checkbox" name="" id="" class="selectAll" data-column="1" >
                    </th>
                    <th class="merlirow">요청코드</th>
                    <th class="merlirow">배송코드</th>
                    <th class="merlirow">제품코드</th>
                    <th class="merlirow">약재명</th>
                    <th class="merlirow">구분</th>
                    <th class="merlirow">가공방법</th>
                    <th class="merlirow">갯수</th>
                    <th class="merlirow">포장단위(g)</th>
                    <th class="merlirow">출하예정일자</th>
                </tr>
                </thead>
<!--                <tbody id="" name="">-->
                <tbody id="packagelistinfo" name="packagelistinfo">
                <tr>
                    <td>hello, world!</td>
                </tr>
                <tr>
                    <td>hello, world!</td>
                </tr>
                <tr>
                    <td>hello, world!</td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>

<!--    <div class="merrightlast">-->
<!--        <button>취소</button>-->
<!--        <button>발송처리</button> -->
<!--    </div>-->
</section>

<?= $this->endSection() ?>

