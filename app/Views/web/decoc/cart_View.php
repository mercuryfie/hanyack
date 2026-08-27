<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>
<script src="<?=URL_DECOC_ASSETS?>/cart.js"> </script>
<script src="<?=URL_DECOC_ASSETS?>/cart_Do.js"> </script>
<section class="">
    <div class="cart_view_box">
        <p class="head_title">장바구니</p>
        <!--        <a href="" onclick="Load_Cart_Count();">장바구니</a>-->
    </div>
    <div class="cartwrap">
        <div class="cartleft">
<!--            <div class="area1 flexType2 "> -->
<!--                <input type="checkbox" name="check_all" id="check_all" class="mr10" checked>-->
<!--                <p class="text">전체</p>-->
<!--            </div>-->
            <div id="cartlist">
            </div>
            <div class="clbox cartleft1-3">
            </div>
        </div>
        <div class="cartright">
            <div class="crbox cartright1-1">
                <div class="cartloc1-1">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>배송주소</p>
                </div>
                <div class="cartloc1-2">
                    <p><?=$body['address'];?></p>
                    <button id="btn_delEdit" class="btn_secondary">변경</button>
                </div>
            </div>
            <div class="crbox cartright1-2">
                <div class="cartprittl1 cartpri1-1">
                    <p>결제금액</p>
                </div>
<!--                <div class="cartprili cartpri1-2">-->
<!--                    <p>상품금액</p>-->
<!--                    <p>0원</p>-->
<!--                </div>-->
<!--                <div class="cartprili cartpri1-3">-->
<!--                    <p>상품할인금액</p>-->
<!--                    <p>0원</p>-->
<!--                </div>-->
                <div class="cartprili cartpri1-5">
                    <p>배송 희망일</p>
                    <input type="date" class="input_date" id="p_deli_date">
                </div>
                <div class="cartprili cartpri1-5">
                    <p>결제예정금액</p>
                    <p id="totalprice" data-tprice="0">총 0원</p>
                </div>

            </div>
            <div class="cartright1-3 mb40">
                <button class="cart_ordernow" id="btn_cartOrder" name="btn_cartOrder">바로 주문하기</button>
            </div>
        </div>
    </div>
</section>

<?= $this->include('/web/include/pop_Order_Del_View') ?>
<?= $this->include('/web/include/pop_Order_View') ?>
<?= $this->endSection() ?>
