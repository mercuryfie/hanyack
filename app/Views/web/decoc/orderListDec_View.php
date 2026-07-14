<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_DECOC_ASSETS?>/orderListDecoc_Do.js?rnd=<?=rand();?>"></script>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ko.js"></script>

<section class="orderlist_dec">
    <div class="decorderli1-1  ">
<!--        <div class="area area1 flexType5 mt10 mb10">-->
<!---->
<!--            <button class="btnType32" name="" type="button" onclick="go_claimList()">취소·반품 내역</button>-->
<!--        </div>-->
        <div class="area area2 flexType1-1 mt20">
            <div class="decorderli1-1-1 left  ">
                <div class="decorderli1-1-1-1 ">
                    <button class="btn_period" name="btnPeriod" type="button">오늘</button>
                    <button class="btn_period" name="btnPeriod" type="button">1개월</button>
                    <button class="btn_period" name="btnPeriod" type="button">3개월</button>
                    <button class="btn_period" name="btnPeriod" type="button">6개월</button>
                </div>
                <div class="input_period_box flexType3">
                    <input type="date" class="input_date" id="s_date">
                    <p class="dash">-</p>
                    <input type="date" class="input_date" id="e_date">
                </div>
                <div class="orderList_boxpq8 flexType2">
                    <input type="search" name="hnName" id="hnName" class="" placeholder="상품명으로 검색해 보세요">
                    <button class="btnType32" id="btnOrderSearch" type="button">조회하기</button>
                </div>
            </div>
            <div class="right blank">
                <div class="orderContainer" id="orderListDecoc" name="orderListDecoc" style="" data-cf="<?=$body['cfcode'];?>">
                </div>
                <div class="common_page_box old_type flexType1" id="pageArea" data-page="1" data-pcnt="<?=$body['pcnt'];?>">
                </div>
            </div>

        </div>
    </div>


    <?= $this->include('/web/include/pop_DeliveryStatus_View') ?>
    <?= $this->include('/web/include/pop_CancelOrderDecoc_View') ?>
</section>

<?= $this->endSection() ?>
