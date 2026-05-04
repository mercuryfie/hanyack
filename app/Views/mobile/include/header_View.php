<header>
    <? if ($header['mitype'] == AUTH_DECOC) { ?>
        <!--    <div class="topline" onclick="go_smart();">스마트 오더 바로가기</div>-->
    <? } ?>
    <div class="headerwrap ">
        <div class="hbox header_boxm9k">
            <? if ($header['islogin'] == 'true') { ?>
                <!--            <div class="hbox1-1">-->
                <!--                <div class="hbox1-1-1">-->
                <!--                    <input type="hidden" id="tUid" name="tUid" value="--><?php //= $header["uid"] ?><!--" />-->
                <!--                    <p class="name">--><?php //= $header["userid"] ?><!--님</p>-->
                <!--                    <p><a href="javascript:void(0);" onclick="go_logout();">로그아웃</a></p>-->
                <!--                    <p>|</p>-->
                <!--                    <p><a href="javascript:void(0);" onclick= "go_mypage();">마이페이지</a></p>-->
                <!--                </div>-->
                <!--            </div>-->
                <div class="hbox1-2  ">
                    <div class="imgBox">
                        <? if ($header['mitype'] == AUTH_MASTER) { ?>
                            <img class="logo" src="/assets/web/src/m_logo_master_white.png" alt="img"
                                 onclick="go_main();">
                        <? } else if ($header['mitype'] == AUTH_DECOC) { ?>
                            <img class="logo" src="/assets/web/src/m_logo_decoc_white.png" alt="img"
                                 onclick="go_main();">
                        <? } else if ($header['mitype'] == AUTH_PHARM) { ?>
                            <img class="logo" src="/assets/web/src/m_logo_pharm_white.png" alt="img"
                                 onclick="go_main();">
                        <? } ?>
                    </div>
                    <div class="topbox1-2">
                        <input class="mainSearch" type="search" name="h_sKey" id="h_sKey"
                               value="<?= $header["h_key"] ?>" placeholder="약재를 검색하십시오">
                        <div class="mag_box">
                            <i class="fa-solid fa-magnifying-glass mag" onclick="Search_Product();"></i>

                        </div>
                    </div>
                    <div class="topbox1-3">
                        <? if (($header['mitype'] == AUTH_DECOC) || ($header['mitype'] == AUTH_MASTER)) { ?>
                            <i class="fa-solid fa-border-all" onclick="go_productList(1);"></i>
                            <i class="fa-solid fa-receipt icon2" onclick="go_orderList();"></i>
                            <i class="fa-solid fa-cart-shopping icon2" onclick="go_cart();"></i>
                            <? if ($header['mitype'] == AUTH_MASTER) { ?>
                                <i class="fa-solid fa-shield" onclick="top_secret();"></i>
                            <? } ?>
                        <? } ?>
                    </div>
                </div>
            <? } else { ?>
                <div class="hbox1-1">
                    <div class="hbox1-1-1">
                        <p><a href="javascript:void(0);" onclick="go_login();">로그인</a></p>
                        <p>|</p>
                        <p><a href="javascript:void(0);" onclick="go_mypage();">마이페이지</a></p>
                    </div>
                </div>
                <div class="hbox1-2">
                    <div class="topbox1-1">
                        <img class="logo" src="/assets/web/src/m_logo_default.png" alt="img" onclick="go_main();">
                    </div>
                    <div class="topbox1-2">
                        <input type="search" name="h_sKey" id="h_sKey" value="" placeholder="약재를 검색하십시오">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="topbox1-3">
                        <? if ($header['islogin'] == 'true') { ?>
                            <i class="fa-solid fa-border-all" onclick="go_productList(1);"></i>
                            <i class="fa-solid fa-receipt icon2" onclick="go_orderList();"></i>
                            <i class="fa-solid fa-cart-shopping icon2" onclick="go_cart();"></i>
                        <? } ?>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>
</header>
