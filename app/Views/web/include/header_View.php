<!--calendar-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<header>
    <?= $this->include('/web/include/pop_Account_View'); ?>
    <? if ($header['mitype'] == AUTH_DECOC) { ?>
        <!--    <div class="topline" onclick="go_smart();">스마트 오더 바로가기</div>-->
    <? } ?>
    <div class="headerwrap">
        <div class="hbox ">
            <? if ($header['islogin'] == 'true') { ?>
                <div class="hbox1-1">
                    <div class="hbox1-1-1">
                        <!--                    <span class="cart-badge" id="cart_badge" style="">0</span>-->

                        <input type="hidden" id="tUid" name="tUid" value="<?= $header["uid"] ?>"/>
                        <p class="name"><?= $header["userid"] ?>님</p>
                        <p><a href="javascript:void(0);" onclick="go_logout();">로그아웃</a></p>
                    </div>
                </div>
                <div class="hbox1-2">
                    <div class="topbox1-1">
                        <? if ($header['mitype'] == AUTH_MASTER) { ?>
                            <img class="logo loggedin_logo" src="/assets/web/src/logo_master.png" alt="img"
                                 onclick="go_main();">
                        <? } else if ($header['mitype'] == AUTH_DECOC) { ?>
                            <img class="logo loggedin_logo" src="/assets/web/src/logo_decoc.png" alt="img"
                                 onclick="go_main();">
                        <? } else if ($header['mitype'] == AUTH_PHARM) { ?>
                            <img class="logo loggedin_logo" src="/assets/web/src/logo_pharm.png" alt="img"
                                 onclick="go_main();">
                        <? } ?>
                    </div>
                    <div class="topbox1-2">
                        <input class="main_search" type="search" name="h_sKey" id="h_sKey"
                               value="<?= $header["h_key"] ?>"
                               placeholder="약재를 검색하십시오">
                        <i class="fa-solid fa-magnifying-glass mag" id="btnHSearch" name="btnHSearch"></i>

                        <!--                    <div class="mag_box flexType1">-->
                        <!--                        <i class="fa-solid fa-magnifying-glass mag" onclick="Search_Product();"></i>-->
                        <!--                    </div>-->
                    </div>
                    <? if ($header['mitype'] == AUTH_DECOC) { ?>
                        <div class="topbox1-3 flexType3">
                            <i class="fa-solid fa-store " onclick="Search_Product('');"></i>
                            <a href="javascript:;" class="icon_goSmart flexType1" onclick="go_smart();"><i class="fa-solid fa-s" onclick=""></i></a>
                            <div class="cart_box">
                                <i class="fa-solid fa-cart-shopping " onclick="go_cart();"></i>
                                <? if ($header['cartCnt'] > 0) { ?>
                                    <div class="num_box flexType1" id="cart_badge_box" style="">
                                        <p class="num" id="cart_badge"><?= $header['cartCnt']; ?></p>
                                    </div>
                                <? } ?>
                            </div>
                            <i class="fa-regular fa-user" onclick="go_orderList();"></i>
                            <!--                    --><? // if ($header['mitype']==AUTH_MASTER){?>
                            <!--                        <i class="fa-solid fa-shield" onclick="top_secret();"></i>-->
                            <!--                    --><? // }?>
                        </div>
                    <? } else if ($header['mitype'] == AUTH_MASTER) { ?>
                        <div class="topbox1-3 hTyp1 flexType3">
                            <i class="fa-solid fa-store " onclick="go_smart();"></i>
                            <a href="javascript:;" class="icon_goSmart flexType1" onclick="go_smart();"><i class="fa-solid fa-s" onclick=""></i></a>
                            <i class="fa-regular fa-user" onclick="go_mypage();"></i>
                        </div>
                    <? } else { ?>
                        <div class="topbox1-4 flexType5">
                            <i class="fa-regular fa-user " onclick="go_orderList();"></i>

                        </div>
                    <? } ?>
                    <div class="topbox1-4 locatip">
                        <p> 경기 파주시 문발로 234 D.달관 디제이탕전실</p>
                        <button>배송지 변경</button>
                    </div>
                </div>
            <? } else { ?> <!-- before login -->

                <div class="hbox1-1">
                    <div class="hbox1-1-1">
                        <a href="javascript:void(0);" onclick="go_login();" class="text">로그인</a>
                        <span> | </span>
                        <a href="javascript:void(0);" onclick="go_join();" class="text">회원가입</a>
                    </div>
                </div>
                <div class="hbox1-2">
                    <div class="topbox1-1">
                        <img class="logo" src="/assets/web/src/logo_default.png" alt="img" onclick="go_main();">
                    </div>
                    <div class="topbox1-2">
                        <input type="search" class="main_search" name="h_sKey" id="h_sKey" value=""
                               placeholder="약재를 검색하십시오">

                        <i class="fa-solid fa-magnifying-glass mag" id="btnHSearch" name="btnHSearch"></i>
                        <!--                    <div class="mag_box flexType1">-->
                        <!--                        <i class="fa-solid fa-magnifying-glass mag" onclick="Search_Product();"></i>-->
                        <!--                    </div>-->
                    </div>
                    <div class="topbox1-3 hTyp1 flexType3">
                        <? if ($header['islogin'] == 'true') { ?>
                            <i class="fa-solid fa-border-all" onclick="go_smart();"></i>
                            <i class="fa-solid fa-receipt icon2" onclick="go_orderList();"></i>
                            <i class="fa-solid fa-cart-shopping icon2" onclick="go_cart();"></i>
                        <? } ?>
                    </div>
                </div>
            <? } ?>

            <!--            <div class="hbox1-3">-->
            <!--                <p class="dd"> hello?</p>-->
            <!--            </div>-->
        </div>
    </div>
</header>
