<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>

<!--<link rel="stylesheet" href="/assets/web/slick/ajax-loader.gif">-->
<!--<link rel="stylesheet" href="/assets/web/slick/slick-theme.css">-->
<!--<link rel="stylesheet" href="/assets/web/slick/slick.css">-->

<!--<script src="/assets/web/js/itemDetail.js?rnd=--><?php //=rand();?><!--"></script>-->
<script src="<?=URL_COMMON_ASSETS?>/itemDetail_Do.js?rnd=<?=rand();?>"></script>
<section class="wrap">
    <div class="detWrap">
        <div class="detCon detCon1-1">
            <div class="detBox1-1">
<!--                --><?// print_r($body['thumnail'])?>
                <img class="thum" src="/assets/product/image/<?=$body['thumnail']?>" alt="img" onclick="">
            </div>
            <div class="detBox1-2">
                <div class="detCol">
<!--                    <div class="canvas_wrap">-->
<!--                        <div class="canvas_box" id="canvasBox1" name="canvasBox1" type="button">-->
<!--                            <canvas id="buyType1" name="lineType1" class="default line" width="100" height="30"></canvas>-->
<!--                            <canvas id="buyType2" name="lineType2"  class="default2 line2" width="100" height="30"></canvas>-->
<!--                            <p class="defaultText subtab">일반구매</p>-->
<!--                        </div>-->
<!--                        <div class="canvas_box" id="canvasBox2" name="canvasBox2" type="button">-->
<!--                            <canvas id="buyType3" name="lineType1"  class="line" width="100" height="30"></canvas>-->
<!--                            <canvas id="buyType4" name="lineType2" class="line2"  width="100" height="30"></canvas>-->
<!--                            <p class="subtab">정기구독</p>-->
<!--                        </div>-->
<!--                        <div class="canvas_box" id="canvasBox3" name="canvasBox3" type="button">-->
<!--                            <canvas id="buyType5" name="lineType1"  class="line" width="100" height="30"></canvas>-->
<!--                            <canvas id="buyType6" name="lineType2"  class="line2" width="100" height="30"></canvas>-->
<!--                            <p class="subtab">대량구매</p>-->
<!--                        </div>-->
<!--                    </div>-->
                    <p class="hn_code"><?=$body['hn_code']?></p>
                    <div class="hn_nameBox">
                        <p class="hn_name"><?=$body['hn_name']?> <?=$body['w_name']?></p>
                        <div class="shareBox">
                            <i class="fa-solid fa-share-nodes"></i>
                        </div>
                    </div>
                    <div class="t_option_box">
                        <p class="option" name="t1_value" id="t1_value"><?=$body['t1_value']?></p>
                        <p class="slash" name="t_option" id=""></p>
                        <p class="option" name="t2_value" id="t2_value"><?=$body['t2_value']?></p>
                    </div>
                    <div class="priceBox1">
                        <p class="price" id="unit_price" name="unit_price"><?= number_format($body['hn_pPrice']) ?></p>
                        <p class="won">원</p>
                    </div>
                    <p class="nation">원산지: <?=$body['n_value']?></p>
                </div>
                <div class="detInfo">
                    <p class="title">제약사</p>
                    <p><?=$body['mi_name']?></p>
                </div>
                <div class="detInfo">
                    <p class="title">재고수량</p>
                    <p><?=$body['hn_stock']?>개</p>
                </div>
                <div class="detInfo">
                    <p class="title">소비기한/유통기한</p>
                    <p><?= date('Y-m-d', strtotime($body['hn_sellEDate'])) ?></p>
                </div>
                <div class="buy_option_wrap">
                    <label for="" class="detLabel">
                    <input type="radio" name="" id="" placeholder="일반구매">
                        <div class="orange">
                            <!--                            <p class="title">포장단위(g) / </p>-->
                            <!--                            <p>--><?php //=$body['w_name']?><!--</p>-->
                            <div class="buy_option">
                                <p class="title">포장단위(g)</p>
                                <p><?=$body['w_name']?></p>
                            </div>
                            <div class="buy_option">
                                <p class="title">10g당 가격</p>
                                <p><?=$body['hn_stock']?>원</p>
                            </div>
                            <div class="buy_option">
                                <p class="title">상품선택</p>
                                <div class="counter">
                                    <i class="fa-solid fa-minus" id="minus" name="minus"></i>
                                    <p id="price_cnt" name="price_cnt">1</p>
                                    <i class="fa-solid fa-plus" id="plus" name="plus"></i>
                                </div>
                            </div>
                        </div>
                    </label>
                    <label for="" class="detLabel">
                        <input type="radio" name="" id="" class="title">
                        <div class="orange">
                            <!--                            <p class="title">포장단위(g) / </p>-->
                            <!--                            <p>--><?php //=$body['w_name']?><!--</p>-->
                            <div class="buy_option">
                                <p class="title">포장단위(g)</p>
                                <p><?=$body['w_name']?></p>
                            </div>
                            <div class="buy_option">
                                <p class="title">10g당 가격</p>
                                <p><?=$body['hn_stock']?>원</p>
                            </div>
                            <div class="buy_option">
                                <p class="title">상품선택</p>
                                <div class="counter">
                                    <i class="fa-solid fa-minus" id="minus" name="minus"></i>
                                    <p id="price_cnt" name="price_cnt">1</p>
                                    <i class="fa-solid fa-plus" id="plus" name="plus"></i>
                                </div>
                            </div>
                        </div>
                    </label>
                    <label for="" class="detLabel">
                        <input type="radio" name="" id="" class="title">
                        <div class="orange">
<!--                            <p class="title">포장단위(g) / </p>-->
<!--                            <p>--><?php //=$body['w_name']?><!--</p>-->
                            <div class="buy_option">
                                <p class="title">포장단위(g)</p>
                                <p><?=$body['w_name']?></p>
                            </div>
                            <div class="buy_option">
                                <p class="title">10g당 가격</p>
                                <p><?=$body['hn_stock']?>원</p>
                            </div>
                            <div class="buy_option">
                                <p class="title">상품선택</p>
                                <div class="counter">
                                    <i class="fa-solid fa-minus" id="minus" name="minus"></i>
                                    <p id="price_cnt" name="price_cnt">1</p>
                                    <i class="fa-solid fa-plus" id="plus" name="plus"></i>
                                </div>
                            </div>
                        </div>

                    </label>
                </div>
<!--                <div class="buy_option" id="buyOption1" name="buyOption1">-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">포장단위(g)</p>-->
<!--                        <p>--><?php //=$body['w_name']?><!--</p>-->
<!--                    </div>-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">10g당 가격</p>-->
<!--                        <p>--><?php //=$body['hn_stock']?><!--원</p>-->
<!--                    </div>-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">상품선택</p>-->
<!--                        <div class="counter">-->
<!--                            <i class="fa-solid fa-minus" id="minus" name="minus"></i>-->
<!--                            <p id="price_cnt" name="price_cnt">1</p>-->
<!--                            <i class="fa-solid fa-plus" id="plus" name="plus"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="buy_option" id="buyOption2" name="buyOption2">-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">포장단위(g)</p>-->
<!--                        <p>--><?php //=$body['w_name']?><!--</p>-->
<!--                    </div>-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">10g당 가격</p>-->
<!--                        <p>--><?php //=$body['hn_stock']?><!--원</p>-->
<!--                    </div>-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">구독 기간</p>-->
<!--                        <select name="hn_method" id="hn_method" class="selectType1">-->
<!--                            <option value="1" --><?php //=($body['hn_method'] == 1) ? 'selected' : ''?><!-->5개월</option>-->
<!--                            <option value="2" --><?php //=($body['hn_method'] == 2) ? 'selected' : ''?><!-->6개월</option>-->
<!--                            <option value="3" --><?php //=($body['hn_method'] == 3) ? 'selected' : ''?><!-->7개월</option>-->
<!--                            <option value="1" --><?php //=($body['hn_method'] == 4) ? 'selected' : ''?><!-->8개월</option>-->
<!--                            <option value="2" --><?php //=($body['hn_method'] == 5) ? 'selected' : ''?><!-->9개월</option>-->
<!--                            <option value="3" --><?php //=($body['hn_method'] == 6) ? 'selected' : ''?><!-->10개월</option>-->
<!--                        </select>-->
<!--                    </div> -->
<!--                </div>-->
<!--                <div class="buy_option" id="buyOption3" name="buyOption3">-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">총 무게</p>-->
<!--                        <p>--><?php //=$body['w_name']?><!--</p>-->
<!--                    </div>-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">10g당 가격</p>-->
<!--                        <p>--><?php //=$body['hn_stock']?><!--원</p>-->
<!--                    </div>-->
<!--                    <div class="detInfo">-->
<!--                        <p class="title">판매 단위</p>-->
<!--                        <p class="burk">1 파레트</p>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="detPrice" name="priceBox" id="priceBox">
                    <p class="miniTitle">총 상품금액: </p>
                    <div class="priceBox1">
                        <p class="price" id="ttl_price" name="ttl_price" data-tprice="">
                            <?= number_format($body['hn_pPrice']) ?>
                        </p>
                        <p class="won">원</p>
                    </div>
                </div>
                <div class="detBuy">
                    <div class="heart" name="heart" id="heart">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <button type="button" class="btntype21">장바구니</button>
                    <button type="button" class="btntype22">구매하기</button>
                </div>
            </div>
        </div>
        <div class="detCon detCon1-2">
            <div class="detBox2-1">
                <a href="" class="menutab">상품설명</a>
                <a href="" class="menutab">상세정보</a>
                <a href="" class="menutab">후기(12,121)</a>
                <a href="" class="menutab">문의</a>
            </div>
            <div class="detBox2-2" id="desc" name="desc">
                <?=$body['hn_desc']?>
            </div>
            <div class="detBox2-3" id="detail" name="detail">

            </div>
            <div class="detBox2-4" id="" name="">

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
