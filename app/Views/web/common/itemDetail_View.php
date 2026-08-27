<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/itemDetail_Do.js?rnd=<?=rand();?>"></script>

<section class="wrap">
    <div class="detWrap">
        <div class="detCon detCon1-1">
            <div class="detBox1-1">
                <img class="thum" src="/assets/product/image/<?=$body['info']['thumnail']?>" alt="img" onclick="">
            </div>
            <div class="detBox1-2">
                <div class="detCol">
                    <div class="flexType2 ">
                        <p class="hn_code fontStyle14"><?=$body['pname']?> <?=$body['info']['hn_code']?></p>
                    </div>
                    <div class="hn_nameBox flexType3">
                        <div class="left flexType2">
                            <p class="hn_name mr10"><?=$body['info']['hn_name']?> (<?=$body['info']['w_name']?>)</p>
                            <p class="option" ><?=$body['info']['option']?></p>
                        </div>
                        <div class="right flexType2">
                            <div class="heartCon mr10">
                                <?if($body['info']['hn_like']==0){?>
                                    <div class="wishHeartBox flexType1" id="btnLike" data-code="<?=$body['info']['hn_code'];?>"  data-act="1">
                                        <i class="fa-regular fa-heart wishHeart" id="" ></i>
                                    </div>
                                <?}else{?>
                                    <div class="wishHeartBox flexType1 active" id="btnLike" data-code="<?=$body['info']['hn_code'];?>" data-act="2">
                                        <i class="fa-solid fa-heart wishHeart active" ></i>
                                    </div>
                                <?}?>
                            </div>
                            <div class="shareBox">
                                <i class="fa-solid fa-share-nodes linkcopy"></i>
                            </div>
                        </div>
                    </div>
                    <?if(($body['auth']!=AUTH_PHARM) && ($body['islogin']===true)){?>
                        <div class="priceBox">
                            <p class="price"><?= number_format($body['info']['unitInfo']['totalPrice'] ?? 0) ?></p>
                            <p class="won">원</p>
                        </div>
                    <?}?>
                </div>
                <div class="detInfo">
                    <p class="title">원산지</p>
                    <p class="data"><?=$body['info']['n_value']?></p>
                </div>
                <div class="detInfo">
                    <p class="title">제약사</p>
                    <p class="data"><?=$body['info']['mi_name']?></p>
                </div>
                <?if(($body['auth']!=AUTH_PHARM ) && ($body['islogin']===true)){?>
<!--                <div class="detInfo buy_option_wrap ">-->

<!--                    <label for="buyOption1" class="detLabel ">-->
<!--                        <div class="buy_option_box "> -->
<!--                        </div>-->
<!--                    </label>-->
<!--                </div>-->

                <div class="detInfo buy_option flexType2">
                    <p class="title">기본 가격</p>
                    <p class="data" id="hn_pPrice_1" name="hn_pPrice_1" data-val="<?=$body['info']['unitPrice']?>"><?=number_format($body['info']['unitPrice'] ?? 0)?>원</p>
                </div>
                <div class="detInfo buy_option flexType2">
                    <p class="title">근당 가격</p>
                    <p class="data" id="hn_gPrice_1" name="hn_gPrice_1" data-val="<?=$body['info']['unitInfo']['geunPrice']?>"><?=number_format($body['info']['unitInfo']['geunPrice'] ?? 0)?>원</p>
                </div>
                <div class="detInfo">
                    <p class="title">기본단위[<?=$body['info']['unitInfo']['packageStr'];?>]</p>
                    <div class="countBox">
                        <i class="fa-regular fa-square-minus" id="btnBuyMinus" name="btnBuyMinus" data-ptype="<?=$body['info']['hn_package_type'];?>" data-dCnt="<?=$body['info']['unitInfo']['defaultCnt'];?>"  data-uPrice="<?=$body['info']['unitPrice'];?>"></i>
                        <p id="price_cnt" data-totalCnt="0" class="count">0</p>
                        <i class="fa-regular fa-square-plus" id="btnBuyPlus" name="btnBuyPlus" data-ptype="<?=$body['info']['hn_package_type'];?>"  data-dCnt="<?=$body['info']['unitInfo']['defaultCnt'];?>" data-uPrice="<?=$body['info']['unitPrice'];?>"></i>
                    </div>
                </div>
                <div class="detInfo">
                    <p class="title">배송 희망일</p>
                    <input type="date" class="input_date" id="deliDate">
                </div>

                <div class="detInfo detPrice" name="priceBox" id="priceBox">
                    <p class="title">총 상품금액 </p>
                    <div class="priceBox1">
                        <p class="price" id="totalprice" name="totalprice" data-tprice="0">0
                        </p>
                        <p class="won">원</p>
                    </div>
                </div>
                <div class="detBuy flexType3">
                    <button type="button" class="btnType32" id="btnAddCart" name="btnAddCart" data-code="<?=$body['info']['hn_code'];?>" >장바구니</button>
                    <button type="button" class="btnType4" id="btnBuy" name="btnBuy" data-code="<?=$body['info']['hn_code'];?>" >구매하기</button>

                </div>
                <?}?>
        </div>
        </div>
        <div class="detCon detCon1-2">
            <div class="detBox2-1">
                <a href="#" class="menutab">상품설명</a>
                <a href="#" class="menutab">상세정보</a>
<!--                <a href="#" class="menutab">-</a>-->
<!--                <a href="#" class="menutab">-</a>-->
            </div>
            <div class="detBox2-2" id="desc" name="desc">
                <?=$body['info']['hn_desc']?>
            </div>
            <div class="detBox2-3" id="detail" name="detail">
                <p class="infoMsg">상품상세정보</p>
                <table class="detInfoTable">
                    <tr>
                        <td class="col1">제조년월</td>
                        <td class="col3">
                            <?= $body['info']['hn_product_date'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">소비유통기한</td>
                        <td class="col3"><?= $body['info']['hn_expired_date'] ?></td>
                    </tr>
                </table>

            </div>
            <div class="detBox2-4" id="" name="">
            </div>
        </div>
    </div>
</section>
<?= $this->include("/web/include/pop_Cart_View") ?>
<?= $this->include("/web/include/pop_Order_View") ?>
<?= $this->include("/web/include/pop_Matching_View") ?>
<?= $this->endSection() ?>
