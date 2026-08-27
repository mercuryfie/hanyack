<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_DECOC_ASSETS?>/orderListDecoc_Do.js?rnd=<?=rand();?>"></script>

<section class="orderlist_dec">
    <div class="decorderli1-1  ">
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
                    <input type="search" name="hnName" id="hnName" class="" placeholder="약재명을 검색하십시오.">
                    <button class="btnType32-1" id="btnOrderSearch" type="button">검색</button>
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
