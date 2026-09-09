<!--calendar-->
<script src="<?= URL_COMMON_ASSETS ?>/topGnb_Do.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


<header>
    <?= $this->include('/web/include/pop_Account_View'); ?>
    <? if ($header['mitype'] == AUTH_DECOC) { ?>
            <div class="topline" onclick="go_smart();">스마트 오더 바로가기</div>
    <? } ?>
    <div class="headerwrap2 main_header">
        <div class="hbox2 gnb_area">
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
                        <div class="topbox1-3 flexType3 ">
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
                            <i class="fa-regular fa-user" onclick="go_orderList('');"></i>
                            <!--                    --><? // if ($header['mitype']==AUTH_MASTER){?>
                            <!--                        <i class="fa-solid fa-shield" onclick="top_secret();"></i>-->
                            <!--                    --><? // }?>
                        </div>
                    <? } else if ($header['mitype'] == AUTH_MASTER) { ?>
                        <div class="topbox1-3 flexType3 hTyp1">
                            <i class="fa-solid fa-store " onclick="go_productList(2);"></i>
                            <a href="javascript:;" class="icon_goSmart flexType1" onclick="go_smart();"><i class="fa-solid fa-s" onclick=""></i></a>
                            <i class="fa-regular fa-user" onclick="go_orderList();"></i>
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
                        <p><a href="javascript:void(0);" onclick="go_login();">로그인11</a></p>
                        <span> | </span>
                        <a href="javascript:void(0);" onclick="go_join();">회원가입</a>
                    </div>
                </div>
                <div class="hbox1-2">
                    <div class="topbox1-1">
                        <img class="logo" src="/assets/web/src/logo_default.png" alt="img" onclick="go_main();">
                    </div>
                    <div class="topbox1-2">
                        <input type="search" class="main_search" name="h_sKey" id="h_sKey" value=""
                               placeholder="약재를 검색하십시오">

                        <i class="fa-solid fa-magnifying-glass mag"></i>
                        <!--                    <div class="mag_box flexType1">-->
                        <!--                        <i class="fa-solid fa-magnifying-glass mag" onclick="Search_Product();"></i>-->
                        <!--                    </div>-->
                    </div>
                    <div class="topbox1-3 ">
                        <? if ($header['islogin'] == 'true') { ?>
                            <i class="fa-solid fa-border-all" onclick="go_productList(1);"></i>
                            <i class="fa-solid fa-receipt icon2" onclick="go_orderList();"></i>
                            <i class="fa-solid fa-cart-shopping icon2" onclick="go_cart();"></i>
                        <? } ?>
                    </div>
                </div>
                <div class="hbox_bottom_area">
                    <!--                    <p class="dd">hello?</p>-->

                </div>
            <? } ?>

            <div class="hbox1-3 gnb_area">
                <div class="top_menu_wrap">
                    <ul class="top_gnb_ul flexType1">
                        <? if ($header['mitype'] == AUTH_DECOC) { ?>
<!--                            <li>-->
<!--                                <a href="javascript:;" class=" top_menu down_1" onclick="go_dashBoard();"-->
<!--                                   data-menu="dashboard">dashboard</a>-->
<!--                            </li>-->
                            <li>
                                <a href="javascript:;" class="top_menu down_2 highlight" onclick="go_smart('');"
                                   data-menu="smartorder">스마트오더</a>
                            </li>
                            <li>
                                <a href="javascript:;" class="top_menu down_3" onclick="Search_Product('');"
                                   data-menu="stocklist">약재 둘러보기</a>
                            </li>
                            <li>
                                <a href="javascript:;" class="top_menu down_6" onclick="go_orderList('');"
                                   data-menu="orderlist">주문관리</a>
                            </li>
                        <? } else if ($header['mitype'] == AUTH_PHARM) { ?>
                            <li>
                                <a href="javascript:;" class="top_menu down_4" onclick="go_materialList('');"
                                   data-menu="stocklist">원재료</a>
                            </li>
                            <li>
                                <a href="javascript:;" class="top_menu down_5" onclick="go_herbList('');"
                                   data-menu="herblist">약재</a>
                            </li>
                            <li>
                                <a href="javascript:;" class="top_menu down_6" onclick="go_orderList('');"
                                   data-menu="orderlist">주문</a>
                            </li>
                            <li>
                                <a href="javascript:;" class="top_menu down_7" onclick="go_setPrice('');"
                                   data-menu="orderlist">환경설정</a>
                            </li>
                        <? } else { ?>
                            <li>
                                <a href="javascript:;" class="top_menu down_4" onclick="go_herbList();"
                                   data-menu="herblist">약재관리</a>
                            </li>
                        <? }  ?>
<!--                        --><?//  if  ($header['mitype'] == AUTH_PHARM){ ?>
<!--                            <li>-->
<!--                                <a href="javascript:;" class="top_menu down_5" onclick="go_shipList();"-->
<!--                                   data-menu="herblist">배송내역</a>-->
<!--                            </li>-->
<!--                        --><?// } ?>

<!--                        <li>-->
<!--                            <a href="javascript:;" class="top_menu down_5" data-menu="smartorder">정산관리</a>-->
<!--                        </li>-->
                    </ul>
                </div>

                <!--    top menu area end-->
                <!--    sub_menu_box start-->
                <div class="sub_menu_wrap flexType1-1">
                    <? if ($header['mitype'] == AUTH_DECOC) { ?>
                        <div class="sub_menu_box">
                        </div>
                        <div class="sub_menu_box ">
                        </div>
                        <div class="sub_menu_box flexCol2-1">
                            <a href="javascript:;" onclick="go_orderList();" class="sub_menu">주문내역</a>
                            <a href="javascript:;" onclick="go_claimList();" class="sub_menu">취소·반품내역</a>
                            <a href="javascript:;" onclick="go_delInfo();" class="sub_menu">배송지 관리</a>
                            <!--                            <a href="javascript:;" onclick="go_BigOrder();" class="sub_menu">정기구독</a>-->
                            <!--                            <a href="javascript:;" onclick="go_BigOrder();" class="sub_menu">대량주문</a>-->
                        </div>
                    <? } else if ($header['mitype'] == AUTH_PHARM) { ?>
                        <div class="sub_menu_box ">
                            <a href="javascript:void(0);" onclick="go_materialList();" class="sub_menu">원재료관리</a>
                            <a href="javascript:void(0);" onclick="go_tradeMaterialList();" class="sub_menu">거래내역</a>
                            <a href="javascript:void(0);" onclick="go_vendorList();" class="sub_menu">거래처관리</a>
                        </div>
                        <div class="sub_menu_box ">
                            <a href="javascript:void(0);" onclick="go_herbList();" class="sub_menu">약재관리</a>
                            <a href="javascript:void(0);" onclick="go_tradeMedicineList();" class="sub_menu">거래내역</a>
                            <a href="javascript:void(0);" onclick="go_tradeMedicineList();" class="sub_menu">영업사원주문</a>
                        </div>
                        <div class="sub_menu_box ">
                            <a href="javascript:void(0);" onclick="go_orderList();" class="sub_menu">주문내역</a>
                            <a href="javascript:void(0);" onclick="go_shipList();" class="sub_menu">배송내역</a>
                            <a href="javascript:void(0);" onclick="go_claimList();" class="sub_menu">취소·반품내역</a>
                        </div>
                        <div class="sub_menu_box ">
                            <a href="javascript:void(0);" onclick="go_memberList();" class="sub_menu">회원관리</a>
<!--                            <a href="javascript:void(0);" onclick="go_setPrice();" class="sub_menu">가격설정</a>-->
                        </div>
<!--                        <div class="sub_menu_box ">-->
<!--                        </div>-->
                    <? } else { ?>
                        <div class="sub_menu_box ">
                            <a href="javascript:;" onclick="go_orderList();" class="sub_menu">주문내역</a>
                            <a href="javascript:;" onclick="go_RegularOrder();" class="sub_menu">정기구독</a>
                            <a href="javascript:;" onclick="go_BigOrder();" class="sub_menu">대량주문</a>
                        </div>
                        <div class="sub_menu_box ">
                            <a href="#" onclick="go_herbList();" class="sub_menu">약재리스트</a>
                            <a href="#" onclick="go_herbMatch();" class="sub_menu">약재매칭</a>
                            <a href="#" onclick="" class="sub_menu"></a>
                        </div>

                    <? } ?>
                </div>
            </div>

        </div>
        <div class="gnb_area_thin flexType1">
            <!--            <p class="dd">-->
            <!--                얇은 header 내용-->
            <!--            </p>-->

            <div class="thin_wrap flex">
                <div class="area area1">
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
                <div class="area area2">

                    <div class="topbox1-2">
                        <input class="main_search" type="search" name="h_sSKey" id="h_sSKey"
                               value="<?= $header["h_key"] ?>"
                               placeholder="약재를 검색하십시오">
                        <i class="fa-solid fa-magnifying-glass mag" id="btnHSSearch" name="btnHSSearch"></i>

                        <!--                    <div class="mag_box flexType1">-->
                        <!--                        <i class="fa-solid fa-magnifying-glass mag" onclick="Search_Product();"></i>-->
                        <!--                    </div>-->
                    </div>
                </div>
                <div class="area area3">

                    <? if ($header['mitype'] == AUTH_DECOC) { ?>
                        <div class="topbox1-3 ">
                            <i class="fa-solid fa-store " onclick="go_smart();"></i>
                            <i class="fa-solid fa-receipt icon2" onclick="go_orderList();"></i>
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
                            <i class="fa-solid fa-store " onclick="go_productList(2);"></i>
                            <i class="fa-solid fa-receipt icon2" onclick="go_orderList();"></i>
                            <i class="fa-regular fa-user" onclick="go_orderList();"></i>
                        </div>
                    <? } else { ?>
                        <div class="topbox1-4 flexType5">
                            <i class="fa-regular fa-user " onclick="go_orderList();"></i>

                        </div>
                    <? } ?>
                </div>
                <div class="area area4">
                </div>
            </div>
        </div>

        <!--    top menu area start-->
        <!--                <div class="submenu1-1 submenu">-->
        <!--                    <a href="#" onclick="go_orderList();" class="sub_menu_1">주문신청</a>-->
        <!--                    <a href="#" onclick="go_orderList();" class="sub_menu_2">주문내역</a>-->
        <!--                    <a href="#" onclick="go_claimList();" class="sub_menu_3">취소·반품내역</a>-->
        <!--                    <a href="#" onclick="go_orderList();" class="sub_menu_4">정기구독중</a>-->
        <!--                </div>-->

    </div>
</header>
