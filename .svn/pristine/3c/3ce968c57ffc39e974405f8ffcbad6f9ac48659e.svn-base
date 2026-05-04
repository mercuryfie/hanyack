<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>

<link rel="stylesheet" href="./assets/web/slick/ajax-loader.gif">
<link rel="stylesheet" href="./assets/web/slick/slick-theme.css">
<link rel="stylesheet" href="./assets/web/slick/slick.css">
<script src="<?= URL_COMMON_ASSETS ?>/main.js?rnd=<?= rand(); ?>"></script>
<script src="<?= URL_COMMON_ASSETS ?>/main_Do.js?rnd=<?= rand(); ?>"></script>
<script src="<?= URL_COMMON_ASSETS ?>/GaugeMeter.js"></script>
<section class="mainbanner">
    <div class="mainwrap">
        <div class="main1-1">
            <div class="maintitle flexType3">
                <div class="mtbox1-1">
                    <p>인기 한약재</p>
                    <p>금주 누적 할인률이 높은 인기 한약재 보기</p>
                </div>
                <div class="mtbox1-2">
                    <button type="button" onclick="go_productList(1);">자세히보기</button>
                </div>
            </div>
            <div class="merbox">
                <?php
                $isAuth = isset($body['l_Type']) &&
                        ($body['l_Type'] == AUTH_DECOC || $body['l_Type'] == AUTH_MASTER);
                ?>
                <? foreach (array_slice($body['hot'], 0, 5) as $d) { ?>

                    <div class="mer_wrap <?= $isAuth ? 'auth-style' : 'guest-style' ?>">
                        <div class="thum_box" type="button"
                             onclick="go_detail('<?= $d['hn_code'] ?>','<?= $d['hn_method'] ?>');">
                            <img class="mainthum" src="/assets/product/image/<?php echo $d['fname'] ?>" alt="img">
                            <?php if ($d['hn_method'] == 1) { ?>
                                <p class="hn_buyTypeStr1">일반</p>
                            <?php } else { ?>
                                <p class="hn_buyTypeStr2">정기</p>
                            <? } ?>
                        </div>
                        <div class="item_box" onclick="">
                            <div class="ttl_box flexType3 ">
                                <div class="flexCol">
                                    <a class="title" href="#" onclick="go_detail('<?= $d['hn_code'] ?>');">
                                        [<?= $d['mi_name']; ?>] <?= $d['hn_name']; ?>
                                    </a>
                                    <div class="flexType2">
                                        <a href="javascript:;" class="detail "><?= $d['w_name']; ?></a>
                                        <p class="detail "
                                           style="<?= ($d['t1_value'] == '') ? 'display: none;' : '' ?>">
                                            - <?= $d['t1_value']; ?>
                                        </p>
                                        <p class="detail" style="<?= ($d['t2_value'] == '') ? 'display: none;' : '' ?>">
                                            - <?= $d['t2_value']; ?>
                                        </p>
                                    </div>
                                </div>
                                <? if (($body['l_Type'] == AUTH_DECOC) || ($body['l_Type'] == AUTH_MASTER)) { ?>
                                    <? if ($d['hn_like'] == 0) { ?>
                                        <div class="wishHeartBox fff_box flexType1" name="btn_like"
                                             data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                             data-act="1">
                                            <i class="fa-regular fa-heart wishHeart" id=""></i>
                                        </div>
                                    <? } else { ?>
                                        <div class="wishHeartBox colored_box flexType1 active" name="btn_like"
                                             data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                             data-act="2">
                                            <i class="fa-solid fa-heart wishHeart active"></i>
                                        </div>
                                    <? } ?>
                                <? } ?>
                            </div>
                            <? if ($d['hn_gPrice'] != '') { ?>
                                <div class="price_box flexType2">
                                    <a class="price" href="#"
                                       onclick="go_detail('<?= $d['hn_code'] ?>');"><?= number_format($d['hn_pPrice']); ?>
                                        원</a>
                                    <span class="calc">(10g 당 <?= number_format($d['hn_pPrice'] / $d['w_value'] * 10); ?>원)</span>
                                </div>
                            <? } ?>
                        </div>

                        <? if (($body['l_Type'] == AUTH_DECOC) || ($body['l_Type'] == AUTH_MASTER)) { ?>
                            <div class="cart_box flexType2">
                                <button type="button" class="cart_btn flexType1" id="addCart" name="addCart"
                                        data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                        data-cnt="1">
                                    <i class="fa-solid fa-cart-shopping mr5"></i>
                                    <p>담기</p>
                                </button>
                                <button type="button" class="buy_btn flexType1" id="" name=""
                                        data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                        data-cnt="1">
                                    <!--                                <i class="fa-solid fa-cart-shopping mr5"></i>-->
                                    <p>구매</p>
                                </button>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
        <div class="main1-2">
            <div class="maintitle">
                <div class="mtbox1-1">
                    <p>특가딜</p>
                    <p>금주 누적 할인률이 높은 인기 한약재 보기</p>
                </div>
                <div class="mtbox1-2">
                    <button type="button" onclick="go_productList(1);">자세히보기</button>
                </div>
            </div>
            <div class="merbox">
                <? foreach (array_slice($body['deal'], 0, 5) as $d) { ?>
                    <div class="mer_wrap <?= $isAuth ? 'auth-style' : 'guest-style' ?>">
                        <div class="thum_box" type="button"
                             onclick="go_detail('<?= $d['hn_code'] ?>','<?= $d['hn_method'] ?>');">
                            <img class="mainthum" src="/assets/product/image/<?php echo $d['fname'] ?>" alt="img">
                            <?php if ($d['hn_method'] == 1) { ?>
                                <p class="hn_buyTypeStr1">일반</p>
                            <?php } else { ?>
                                <p class="hn_buyTypeStr2">정기</p>
                            <? } ?>
                        </div>
                        <div class="item_box" type="button">
                            <div class="ttl_box flexType3 ">
                                <div class="flexCol">
                                    <a class="title" href="#" onclick="go_detail('<?= $d['hn_code'] ?>');">
                                        [<?= $d['mi_name']; ?>] <?= $d['hn_name']; ?>
                                    </a>
                                    <div class="flexType2">
                                        <a href="javascript:;" class="detail "><?= $d['w_name']; ?></a>
                                        <p class="detail "
                                           style="<?= ($d['t1_value'] == '') ? 'display: none;' : '' ?>">
                                            - <?= $d['t1_value']; ?>
                                        </p>
                                        <p class="detail" style="<?= ($d['t2_value'] == '') ? 'display: none;' : '' ?>">
                                            - <?= $d['t2_value']; ?>
                                        </p>
                                    </div>
                                </div>
                                <? if (($body['l_Type'] == AUTH_DECOC) || ($body['l_Type'] == AUTH_MASTER)) { ?>
                                    <? if ($d['hn_like'] == 0) { ?>
                                        <div class="wishHeartBox flexType1" name="btn_like"
                                             data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                             data-act="1">
                                            <i class="fa-regular fa-heart wishHeart" id=""></i>
                                        </div>
                                    <? } else { ?>
                                        <div class="wishHeartBox flexType1 active" name="btn_like"
                                             data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                             data-act="2">
                                            <i class="fa-solid fa-heart wishHeart active"></i>
                                        </div>
                                    <? } ?>
                                <? } ?>
                            </div>
                            <? if ($d['hn_gPrice'] != '') { ?>
                                <div class="price_box flexType2">
                                    <p class="price"><?= number_format($d['hn_pPrice']); ?>원</p>
                                    <span class="calc">(10g 당 <?= number_format($d['hn_pPrice'] / $d['w_value'] * 10); ?>원)</span>
                                </div>
                            <? } ?>
                        </div>
                        <? if (($body['l_Type'] == AUTH_DECOC) || ($body['l_Type'] == AUTH_MASTER)) { ?>
                            <div class="cart_box flexType2 mb10">
                                <button type="button" class="cart_btn flexType1" id="addCart" name="addCart"
                                        data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                        data-cnt="1">
                                    <i class="fa-solid fa-cart-shopping mr5"></i>
                                    <p>담기</p>
                                </button>
                                <button type="button" class="buy_btn flexType1" id="" name=""
                                        data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                        data-cnt="1">
                                    <!--                                <i class="fa-solid fa-cart-shopping mr5"></i>-->
                                    <p>구매</p>
                                </button>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
        <div class="main1-3">
            <div class="maintitle">
                <div class="mtbox1-1">
                    <p>정기오더 / 한약 구독</p>
                    <p>금주 누적 할인률이 높은 인기 한약재 보기</p>
                </div>
                <div class="mtbox1-2">
                    <button type="button" onclick="go_productList(1);">자세히보기</button>
                </div>
            </div>
            <div class="merbox merlast">
                <? foreach (array_slice($body['event'], 0, 5) as $d) { ?>
                    <div class="mer_wrap <?= $isAuth ? 'auth-style' : 'guest-style' ?>" name="">
                        <div class="thum_box" type="button" onclick="go_detail('<?= $d['hn_code'] ?>');">
                            <img class="mainthum" src="/assets/product/image/<?php echo $d['fname'] ?>" alt="img"
                                 onclick="go_detail('<?= $d['hn_code'] ?>','<?= $d['hn_method'] ?>');">
                            <?php if ($d['hn_method'] == 1) { ?>
                                <p class="hn_buyTypeStr1">일반</p>
                            <?php } else { ?>
                                <p class="hn_buyTypeStr2">정기</p>
                            <? } ?>
                        </div>
                        <div class="item_box">
                            <div class="ttl_box flexType3 ">
                                <div class="flexCol">
                                    <a class="title" href="#" onclick="go_detail('<?= $d['hn_code'] ?>');">
                                        [<?= $d['mi_name']; ?>] <?= $d['hn_name']; ?>
                                    </a>
                                    <div class="flexType2">
                                        <a href="javascript:;" class="detail "><?= $d['w_name']; ?></a>
                                        <p class="detail "
                                           style="<?= ($d['t1_value'] == '') ? 'display: none;' : '' ?>">
                                            - <?= $d['t1_value']; ?>
                                        </p>
                                        <p class="detail" style="<?= ($d['t2_value'] == '') ? 'display: none;' : '' ?>">
                                            - <?= $d['t2_value']; ?>
                                        </p>
                                    </div>
                                </div>
                                <? if (($body['l_Type'] == AUTH_DECOC) || ($body['l_Type'] == AUTH_MASTER)) { ?>
                                    <? if ($d['hn_like'] == 0) { ?>
                                        <div class="wishHeartBox flexType1" name="btn_like"
                                             data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                             data-act="1">
                                            <i class="fa-regular fa-heart wishHeart" id=""></i>
                                        </div>
                                    <? } else { ?>
                                        <div class="wishHeartBox flexType1 active" name="btn_like"
                                             data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                             data-act="2">
                                            <i class="fa-solid fa-heart wishHeart active"></i>
                                        </div>
                                    <? } ?>
                                <? } ?>
                            </div>
                            <? if ($d['hn_gPrice'] != '') { ?>
                                <div class="price_box flexType2">
                                    <p class="price"><?= number_format($d['hn_pPrice']); ?>원</p>
                                    <span class="calc">(10g 당 <?= number_format($d['hn_pPrice'] / $d['w_value'] * 10); ?>원)</span>
                                </div>
                            <? } ?>
                        </div>
                        <? if (($body['l_Type'] == AUTH_DECOC) || ($body['l_Type'] == AUTH_MASTER)) { ?>
                            <div class="cart_box flexType2 mb10">
                                <button type="button" class="cart_btn flexType1" id="addCart" name="addCart"
                                        data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                        data-cnt="1">
                                    <i class="fa-solid fa-cart-shopping mr5"></i>
                                    <p>담기</p>
                                </button>
                                <button type="button" class="buy_btn flexType1" id="" name=""
                                        data-code="<?= $d['hn_code'] ?>" data-ptype="<?= $d['hn_method']; ?>"
                                        data-cnt="1">
                                    <!--                                <i class="fa-solid fa-cart-shopping mr5"></i>-->
                                    <p>구매</p>
                                </button>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
