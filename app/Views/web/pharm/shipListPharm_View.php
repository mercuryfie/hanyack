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
    <div class="merlibox1-1 ">
        <p>배송내역</p>
        <!-- <button>새 창</button> -->
        <!--        <div class="odrbox1-1 shipListPharm  ">-->
        <!--            <div class="odrbox1-1-1 ">-->
        <!--                <select name="c_date" id="c_date" class="select_type">-->
        <!--                    <option value="기준일">기준일</option>-->
        <!--                    <option value="주문확인일">출하처리일</option>-->
        <!--                    <option value="발송처리일">발송처리일</option>-->
        <!--                </select>-->
        <!--                <select name="c_decoc" id="c_decoc" class="select_type">-->
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
        <!--        </div>-->
        <div class="shipBox flexType3 ph20">
            <p class="sub_title">배송 목록</p>
            <div class="right">

                <select name="c_date" id="c_date" class="select_type mr10">
                    <option value="기준일">기준일</option>
                    <option value="주문확인일">출하처리일</option>
                    <option value="발송처리일">발송처리일</option>
                </select>
                <select name="c_decoc" id="c_decoc" class="select_type mr10">
                    <option value="전체탕전실">전체탕전실</option>
                    <option value="광명당">광명당</option>
                    <option value="대연제약">대연제약</option>
                    <option value="디제이허브">디제이허브</option>
                    <option value="바른한방">바른한방</option>
                    <option value="영천">영천</option>
                    <option value="CJ">CJ</option>
                    <option value="CK">CK</option>
                    <option value="허브팜">허브팜</option>
                </select>
                <select name="c_status" id="c_status" class="select_type">
                    <option value="전체상태">전체상태</option>
                    <option value="대연제약">발송대기</option>
                    <option value="디제이허브">발송처리</option>
                </select>
            </div>
            <!--            <button class="btnTypeTItle">배송 목록</button>-->
<!--            <button class="btntype1">출하취소</button>-->
        </div>
        <div class="shipBox1-1">
            <table class="merlitable shipTable1-1">
                <thead>
                <tr>
                    <td class="merlirow">상태</td>
                    <td class="merlirow">배송코드</td>
                    <td class="merlirow">업체명</td>
                    <td class="merlirow">총 갯수</td>
                    <td class="merlirow">총 무게</td>
                    <td class="merlirow">발송타입</td>
                    <td class="merlirow">송장번호</td>
                    <td class="merlirow">확인</td>
                    <td class="merlirow">출력</td>
                    <td class="merlirow">등록일</td>
                    <!--                    <td class="merlirow">포장가격</td>-->
                </tr>
                </thead>
                <tbody id="packagelist" name="packagelist">


                </tbody>
            </table>
        </div>
        <div class="shipBox shipBox1-3">
            <p class="sub_title">배송 상세</p>
            <!--            <button class="btnTypeTItle">배송 상세</button>-->
<!--            <button class="btnType4" onclick="">배송취소</button>-->
        </div>
        <div class="shipBox shipBox1-2">
<!--            table2-->
            <table class="merlitable shipTable1-1">
                <thead>
                <tr>
                    <td class="merlirow">
                        <input type="checkbox" name="" id="" class="selectAll" data-column="1" >
                    </td>
                    <td class="merlirow">요청코드</td>
                    <td class="merlirow">배송코드</td>
                    <td class="merlirow">제품코드</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">구분</td>
                    <td class="merlirow">가공방법</td>
                    <td class="merlirow">갯수</td>
                    <td class="merlirow">포장단위(g)</td>
                    <td class="merlirow">출하예정일자</td>
                </tr>
                </thead>
                <tbody id="packagelistinfo" name="packagelistinfo">

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

