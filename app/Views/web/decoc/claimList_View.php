<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_DECOC_ASSETS?>/claimList_Do.js?rnd=<?=rand();?>"></script>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<section class="orderlist_dec">
    <!--    <div class="decorderli1-0">-->
    <!--    </div>-->
    <div class="decodr decorderli1-1">
        <div class="decorderli1-1-1">
            <p>취소·반품 내역</p>
            <div class="decorderli1-1-1-1">
                <button class="btnType1">전체</button>
                <button class="btnType1">취소</button>
                <button class="btnType1">반품</button>
                <button class="btnType1">교환</button>
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
                    <option value="허브팜">허브팜dd</option>
                </select>
            </div>
            <div class="orderList_boxpq8 flexType2">
                <input type="search" name="" id="" class=""
                       placeholder="상품명으로 검색해 보세요">
                <button class="btnType1">조회하기</button>
            </div>
        </div>
    </div>
    <!--    여기서 시작 -->
    <div class="claimList"  id="" name="" style="">
        <div class="claimList_boxarv">
            <div class="upside">
                <p class="status">취소완료</p>
                <div class="flexType2">
                    <p class="title mr10">주문번호</p>
                    <p class="odcode mr10">13241234</p>
                    <i class="fa-solid fa-paste"></i>
                </div>
            </div>
            <div class="downside">
                <div class="el_boxzzl">
                    <p class="">[허브팜] 감초 (대/양외)</p>
                    <div class="flexType2">
                        <p class="price mr10">10,000원</p>
                        <p class="unit">1개</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!--    <div class="more_box flexType1" type="button" name="more" id="more">-->
<!--        <button class="moreList2" id="btnmore1" name="btnmore1" type="button" data-page="">-->
<!--            더보기-->
<!--        </button>-->
<!--        <i class="fa-solid fa-angle-down" id="more2" name="btnmore2" data-page=""></i>-->
<!--    </div>-->

    <?= $this->include('/web/include/pop_DeliveryStatus_View') ?>
    <?= $this->include('/web/include/pop_CancelOrderDecoc_View') ?>
</section>

<?= $this->endSection() ?>
