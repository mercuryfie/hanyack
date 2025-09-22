<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_DECOC_ASSETS?>/return_Do.js?rnd=<?=rand();?>"></script>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<section class="orderlist_dec">
<!--    <div class="decorderli1-0">-->
<!--    </div>-->
    <div class="decodr refund_boxtc6">
        <div class="area area1">
            <p class="head_title">반품/교환 접수</p>
        </div>
        <div class="area area2">
            <label for="claim" class="label2">
                <input type="radio" name="claim" class="rtype" value="1" checked>반품
            </label>
            <label for="claim" class="label1">
                <input type="radio" name="claim" class="rtype" value="2" >교환
            </label>
        </div>
        <div class="area area3 flexCol el_box1od">

            <div class="element element1 flexType2">
                <div class="left">
                    <p class="tagType1 mr10"><?= $body['info']['gd_pstr'] ?></p>

                </div>
                <div class="right flexType2">
                    <p class="title">주문번호</p>
                    <p class="odcode mr10"><?= $body['info']['odcode'] ?></p>
                    <i class="fa-solid fa-copy" name="" onclick="dataCopy('<?= $body['info']['odcode'] ?>');"></i>

                </div>
            </div>
            <div class="element element4 flexType2">
                <p class="hnname mr10">[<?=$body['info']['w_name']?>]   <?=$body['info']['hn_name']?></p>
                <p class="option">(<?=$body['info']['optionstr']?>)</p>
            </div>
            <div class="element element2 flexType2">
                <p class="count"><?=number_format($body['info']['gd_price'])?>원</p>
                <p class="price">(<?=number_format($body['info']['gd_rPrice'])?>원 * <?=number_format($body['info']['gd_cnt'])?>개) </p>
            </div>
            <div class="element element3 flexType3">
                <div class="left flexType2">
                    <div class="flexType3">
                        <i class="fa-solid fa-minus" id="btn_minus"></i>
                        <p class="count" id="r_count" data-max="<?= $body['info']['gd_cnt'] ?>">1</p>
                        <i class="fa-solid fa-plus" id="btn_plus"></i>
                    </div>
                    <p class="msg ">(포장단위당 갯수)</p>

                </div>
                <div class="right ">
                    <label for="returnAll" class="returnAll flexType2">
                        <input type="checkbox" name="returnAll" id="returnAll" >
                        <p class="all">전량반품</p>
                    </label>
                </div>
            </div>
        </div>
        <div class="area area4 el_box2w9 flexType4">
            <p class="title">상세설명</p>
            <textarea type="search" class="desc" name="txt_msg" id="txt_msg" placeholder="상세설명을 입력하세요"></textarea>
        </div>

    </div>
    <div class="flexType2 lastBox">
        <button type="button" class="btnType3" onclick="go_orderList();">이전</button>
        <button type="button" class="btnType4" name="btn_return" id="btn_return" data-sn="<?= $body['info']['sn'] ?>">확인</button>
    </div>
</section>

<?= $this->endSection() ?>
