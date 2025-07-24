<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_DECOC_ASSETS?>/orderDetailDecoc_Do.js?rnd=<?=rand();?>"></script>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
<script>
</script>

<section class="orderlist_dec">
<!--    <div class="decorderli1-0">-->
<!--    </div>-->
    <div class="decodr decorderli1-1">
        <div class="decorderli1-1-1">
            <p class="title">주문내역 상세</p>
            <p class="date">주문내역 상세</p>
            <p class="code">주문내역 상세</p>
            <div class="decorderli1-1-1-1">
                <button class="periodSelector">오늘</button>
                <button class="periodSelector">1주일</button>
                <button class="periodSelector">1개월</button>
                <button class="periodSelector">3개월</button>
                <button class="periodSelector">6개월</button>
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
            <div class="decorderli1-1-1-2">
                <input type="text"  id="" class="datepicker datepicker1-5" placeholder="날짜 선택" readonly >
                <i class="fa-regular fa-calendar calicon" id=""></i>
                <p>~</p>
                <input type="text" id="" class="datepicker datepicker1-6" placeholder="날짜 선택" readonly>
                <i class="fa-regular fa-calendar calicon" id="calicon1-6"></i>
                <button class="btntype1">조회하기</button>
            </div>
            <!-- <div class="decorderli1-1-1-2">
                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div> -->
        </div>
    </div>
<!--    여기서 시작 -->
    <div class="orderContainer"  id="orderListDecoc" name="orderListDecoc" style="">
<!--        <div class="dec_orderli">-->
<!--        </div>-->
    </div>
<!--    <div class="dec_orderli" >-->
<!--        <div class="" id="orderListDecoc" name="orderListDecoc">-->
<!---->
<!--        </div>-->
<!--     </div>-->

    <?= $this->include('/web/include/pop_DeliveryStatus_View') ?>
    <?= $this->include('/web/include/pop_CancelOrderDecoc_View') ?>
</section>

<?= $this->endSection() ?>
