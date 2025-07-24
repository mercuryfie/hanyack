<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<script src="<?=URL_DECOC_ASSETS?>/stockListDecoc_Do.js"> </script>
<script>
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
        <p>재고관리</p>
        <!-- <button>새 창</button> -->

        <div class="stockBox1-1 ">
            <div class="stockBox1-1-1">
                <p class="title1">정렬</p>
                <select class="filter selectType3" name="" id="">
                    <option value="">가나다순</option>
                    <option value="">약재입고순</option>
                    <option value="">재고많은순</option>
                    <option value="">재고적은순</option>
                    <option value="">유통기한순</option>
                    <option value="">유통기한역순</option>
                </select>
                <p class="title2">검색창</p>
                <input class="inputSearch" type="search" name="" id="" placeholder="약재를 검색하세요">
<!--                <p class="category2">상태별</p>-->
<!--                <select name="" id="">-->
<!--                    <option value="">전체</option>-->
<!--                    <option value="대연제약">입고대기</option>-->
<!--                    <option value="디제이허브">입고처리</option>-->
<!--                </select>-->
            </div>
            <div class="odrbox1-1-2">
            </div>
        </div>
        <div class="ipgoTitle ">
            <button class="btnTypeTItle">재고 목록</button>

            <div class="submitBox">
                <button type="button" id="" name="" class="btnType3">엑셀다운</button>
                <!--            <button type="button" id="btn_deli" name="btn_deli">입고처리</button>-->
            </div>
        </div>
        <div class="shipBox1-1">
            <table class="merlitable stockTable1-1">
                <thead>
                <tr>
                    <td class="merlirow">번호</td>
                    <td class="merlirow">약재코드</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">총 재고량</td>
                    <td class="merlirow">월 평균 사용량</td>
                    <td class="merlirow">최근 주문량</td>
                </tr>
                </thead>
                <tbody id="putList" name="putList">


                </tbody>
            </table>
        </div>
        <div class="ipgoTitle ">
            <button class="btnTypeTItle">재고 상세</button>
<!--            <div class=" submitBox">-->
<!--                <button type="button" id="btn_cancle" name="btn_cancle" class="btnType3">반품하기</button>-->
<!--                <button type="button" id="btn_deli" name="btn_deli" class="btnType3">입고하기</button>-->
<!--            </div>-->
        </div>

        <div class="shipBox shipBox1-2">
            <!--            table2-->
            <table class="merlitable stockTable1-2">
                <thead>
                <tr>
                    <td class="merlirow">번호</td>
                    <td class="merlirow">약재코드</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">구분</td>
                    <td class="merlirow">가공방법</td>
                    <td class="merlirow">원산지</td>
                    <td class="merlirow">제약사</td>
                    <td class="merlirow">개별중량</td>
                    <td class="merlirow">수량</td>
                    <td class="merlirow">총 중량</td>
                    <td class="merlirow">유통기한</td>
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
