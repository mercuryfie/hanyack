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
                    <p class="hn_code"><?=$body['info']['hn_code']?></p>
                    <div class="hn_nameBox">
                        <p class="hn_name"><?=$body['info']['hn_name']?> (<?=$body['info']['w_name']?>)</p>
                        <div class="shareBox">
                            <i class="fa-solid fa-share-nodes"></i>
                        </div>
                    </div>
                    <div class="t_option_box">
                        <p class="option" name="t1_value" id="t1_value"><?=$body['info']['t1_value']?></p>
                        <p class="slash" name="t_option" id=""></p>
                        <p class="option" name="t2_value" id="t2_value"><?=$body['info']['t2_value']?></p>
                    </div>
                    <div class="priceBox">
                        <p class="price"><?= number_format($body['price'][0]['hn_pPrice']) ?></p>
                        <p class="won">원</p>
                    </div>
                    <p class="nation">원산지: <?=$body['info']['n_value']?></p>
                </div>
                <div class="detInfo">
                    <p class="title">제약사</p>
                    <p><?=$body['info']['mi_name']?></p>
                </div>
                <div class="detInfo">
                    <p class="title">소비기한/유통기한</p>
                    <p><?= date('Y-m-d', strtotime($body['info']['hn_sellEDate'])) ?></p>
                </div>
<!--                <label for="" class="detLabel">-->
<!--                    <input type="radio" name="" id="" placeholder="일반구매">dd-->
<!--                </label>-->
                <div class="buy_option_wrap">
                    <label for="buyOption1" class="detLabel">
                    <input type="radio" name="buyOption" id="buyOption1" placeholder="일반구매" checked>
                        <p class="buy_type">일반구매</p>
                        <div class="buy_option_box">
                            <div class="buy_option">
                                <p class="title">상품선택</p>
                                <div class="counter">
                                    <i class="fa-solid fa-minus" id="minus" name="minus"></i>
                                    <p id="price_cnt" name="price_cnt">1</p>
                                    <i class="fa-solid fa-plus" id="plus" name="plus"></i>
                                </div>
                            </div>
                            <div class="buy_option">
                                <p class="title">포장 가격</p>
                                <p id="hn_pPrice_1" name="hn_pPrice_1" data-val="<?=$body['price'][0]['hn_pPrice']?>"><?=number_format($body['price'][0]['hn_pPrice'])?>원</p>
                            </div>
                            <div class="buy_option">
                                <p class="title">근당 가격</p>
                                <p id="hn_gPrice_1" name="hn_gPrice_1" data-val="<?=$body['price'][0]['hn_gPrice']?>"><?=number_format($body['price'][0]['hn_gPrice'])?>원</p>
                            </div>
                            <div class="buy_option">
                                <p class="title">재고 수량</p>
                                <p id="hn_stock_1" name="hn_stock_1"><?=$body['price'][0]['hn_stock']?></p>
                            </div>
                        </div>
                    </label>
                    <?if($body['price'][0]['hn_gPrice']!=''){?>
                    <label for="buyOption2" class="detLabel">
                        <input type="radio" name="buyOption" id="buyOption2" placeholder="">
                        <p class="buy_type">정기구독</p>
                        <div class="buy_option_box">
                            <div class="buy_option">
                                <p class="title">구독 기간</p>
                                <select name="hn_method" id="hn_method" class="selectType1">
                                    <option value="5" <?=($body['price'][1]['hn_period'] == 5) ? 'selected' : ''?>>5개월</option>
                                    <option value="6" <?=($body['price'][1]['hn_period'] == 6) ? 'selected' : ''?>>6개월</option>
                                    <option value="7" <?=($body['price'][1]['hn_period'] == 7) ? 'selected' : ''?>>7개월</option>
                                    <option value="8" <?=($body['price'][1]['hn_period'] == 8) ? 'selected' : ''?>>8개월</option>
                                    <option value="9" <?=($body['price'][1]['hn_period'] == 9) ? 'selected' : ''?>>9개월</option>
                                    <option value="10" <?=($body['price'][1]['hn_period'] == 10) ? 'selected' : ''?>>10개월</option>
                                </select>
                            </div>
                            <div class="buy_option">
                                <p class="title">포장 가격</p>
                                <p id="hn_pPrice_2" name="hn_pPrice_2" data-val="<?=$body['price'][1]['hn_pPrice']?>"><?=number_format($body['price'][1]['hn_pPrice'])?>원</p>
                            </div>
                            <div class="buy_option">
                                <p class="title">근당 가격</p>
                                <p id="hn_gPrice_2" name="hn_gPrice_2" data-val="<?=$body['price'][1]['hn_gPrice']?>"><?=number_format($body['price'][1]['hn_gPrice'])?>원</p>
                            </div>
                        </div>
                    </label>
                    <?}?>
                    <?if($body['info']['hn_bigsell']==1){?>
                        <p class="buy_type">📌 대량구매 가능</p>
                    <?}?>
                </div>
                <div class="detPrice" name="priceBox" id="priceBox">
                    <p class="miniTitle">총 상품금액: </p>
                    <div class="priceBox1">
                        <p class="price" id="ttl_price" name="ttl_price" data-tprice="">

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
                <a href="#" class="menutab">상품설명</a>
                <a href="#" class="menutab">상세정보</a>
                <a href="#" class="menutab">-</a>
                <a href="#" class="menutab">-</a>
            </div>
            <div class="detBox2-2" id="desc" name="desc">
                <?=$body['info']['hn_desc']?>
            </div>
            <div class="detBox2-3" id="detail" name="detail">
                <p class="infoMsg">・ 상품상세정보</p>
                <table class="detInfoTable">
                    <tr>
                        <td class="col1">제조년월</td>
                        <td class="col3">
                            <?= date('Y-m-d', strtotime($body['info']['hn_sellSDate']))?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">소비・유통기한</td>
                        <td class="col3"><?= date('Y-m-d', strtotime($body['info']['hn_sellEDate']))?></td>
                    </tr>
                </table>

            </div>
            <div class="detBox2-4" id="" name="">

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
