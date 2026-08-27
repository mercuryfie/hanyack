<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<script src="<?=URL_DECOC_ASSETS?>/putListDecoc_Do.js"> </script>


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
        <p>입고처리 현황</p>
        <!-- <button>새 창</button> -->

        <div class="odrbox1-1 shipListPharm">
            <div class="odrbox1-1-1 ipgoFilter">
                <p>조회기준일</p>
                <select name="" id="pharli">
                    <option value="주문확인일">주문일</option>
                    <option value="발송처리일">입고처리일</option>

                </select>
                <p class="category2">상태별</p>
                <select name="" id="pharli">
                    <option value="">전체</option>
                    <option value="대연제약">입고대기</option>
                    <option value="디제이허브">입고처리</option>
                </select>
            </div>
            <div class="odrbox1-1-2">
            </div>
        </div>
        <div class="ipgoTitle ">
            <button class="btnTypeTItle">입고대기 목록</button>
            <div class="submitBox">
                <button type="button" id="btn_ini" name="btn_cancle" class="btnType3">초기화</button>
            </div>
        </div>
        <div class="shipBox1-1">
            <table class="merlitable shipTable1-1">
                <thead>
                <tr>
                    <td class="merlirow">상태</td>
                    <td class="merlirow">출하코드</td>
                    <td class="merlirow">업체명</td>
                    <td class="merlirow">총합</td>
                    <td class="merlirow">총무게</td>
                    <td class="merlirow">발송타입</td>
                    <td class="merlirow">송장번호</td>
                    <td class="merlirow">등록일</td>
                </tr>
                </thead>
                <tbody id="putList" name="putList">


                </tbody>
            </table>
        </div>
        <div class="ipgoTitle ">
            <button class="btnTypeTItle">입고대기 상세</button>
            <div class=" submitBox">
                <button type="button" id="btn_cancle" name="btn_cancle" class="btnType3">반품하기</button>
                <button type="button" id="btn_deli" name="btn_deli" class="btnType3">입고하기</button>
            </div>
        </div>

        <div class="shipBox shipBox1-2">
            <!--            table2-->
            <table class="merlitable shipTable1-1">
                <thead>
                <tr>
                    <td class="merlirow"></td>
                    <td class="merlirow">번호</td>
                    <td class="merlirow">요청코드</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">원산지</td>
                    <td class="merlirow">요청수량</td>
                    <td class="merlirow">개별중량</td>
                    <td class="merlirow">현 재고량</td>
                    <td class="merlirow">요청인</td>
                    <td class="merlirow">주문일</td>
                    <td class="merlirow">배송희망일</td>
                </tr>
                </thead>
                <tbody id="putListDetail" name="putListDetail">

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
