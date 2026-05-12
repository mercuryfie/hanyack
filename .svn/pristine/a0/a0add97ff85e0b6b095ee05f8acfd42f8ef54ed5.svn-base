<?= $this->extend("/web/template/layout_cart") ?>
<?= $this->section("content") ?>
<script src="<?=URL_DECOC_ASSETS?>/cart.js"> </script>
<script src="<?=URL_DECOC_ASSETS?>/cart_Do.js"> </script>
<section class="cart cartbg">
    <div class="cart_view_box">
        <p class="head_title">장바구니</p>
        <!--        <a href="" onclick="Load_Cart_Count();">장바구니</a>-->
    </div>
    <div class="cartwrap">
        <div class="cartleft">
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
                    <button id="btn_delEdit">변경</button>
                </div>
            </div>
            <div class="crbox cartright1-2">
                <div class="cartprittl1 cartpri1-1">
                    <p>결제금액</p>
                </div>
                <div class="cartprili cartpri1-2">
                    <p>상품금액</p>
                    <p>0원</p>
                </div>
                <div class="cartprili cartpri1-3">
                    <p>상품할인금액</p>
                    <p>0원</p>
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
