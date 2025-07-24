
<!--calendar-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<header>
    <?= $this->include('/web/include/pop_Account_View');?>
    <? if ($header['mitype']=='decoc') : ?>
    <div class="topline" onclick="go_smart();">스마트 오더 바로가기</div>
    <? endif ?>
    <div class="headerwrap">
        <div class="hbox">
        <? if ($header['islogin']=='true'){?>
            <div class="hbox1-1">
                <div class="hbox1-1-1">
                    <input type="hidden" id="tUid" name="tUid" value="<?= $header["uid"] ?>" />
                    <p class="name"><?= $header["userid"] ?>님</p>
                    <p><a href="javascript:void(0);" onclick="go_logout();">로그아웃</a></p>
                    <p>|</p>
                    <p><a href="javascript:void(0);" onclick= "go_mypage();">마이페이지</a></p>
                </div>
<!--                <div class="hbox1-1-2">-->
<!--                    <p>홈</p>-->
<!--                    <p>한약재</p>-->
<!--                    <p class="highlight"><a href="javascript:void(0);" onclick="go_smart();">스마트오더</a></p>-->
<!--                    <p>정기배송</p>-->
<!--                    <p>약재시세</p>-->
<!--                </div>-->
            </div>
            <div class="hbox1-2">
                <div class="topbox1-1">
                    <? if ($header['mitype']=='master') : ?>
                     <img class="logo" src="/assets/web/src/logo_master.png" alt="img" onclick="go_main();">
                    <? elseif ($header['mitype']=='decoc') :?>
                    <img class="logo" src="/assets/web/src/logo_decoc.png" alt="img" onclick="go_main();">
                  <? else: ?>
                <img class="logo" src="/assets/web/src/logo_pharm.png" alt="img" onclick="go_main();">
                    <? endif; ?>
                </div>
                <div class="topbox1-2">
                    <input class="mainSearch" type="search" name="h_sKey" id="h_sKey" value="<?= $header["h_key"] ?>" placeholder="약재를 검색하십시오">
                    <i class="fa-solid fa-magnifying-glass" onclick="Search_Product();"></i>
                </div>
                <div class="topbox1-3">
                    <i class="fa-solid fa-border-all" onclick="go_productList(2);"></i>
<!--                    <i class="fa-solid fa-location-dot icon1"></i>-->
                    <i class="fa-solid fa-receipt icon2" onclick=""></i>
                    <i class="fa-solid fa-cart-shopping icon2" onclick="go_cart();"></i>
            <? if ($header['mitype']=='master') : ?>
                    <i class="fa-solid fa-shield" onclick="top_secret();"></i>
            <? endif ?>
                </div>
                <div class="topbox1-4 locatip">
                    <p> 경기 파주시 문발로 234 D.달관 디제이탕전실</p>
                    <button>배송지 변경</button>
                </div>
            </div>
        <?}else{?>

            <div class="hbox1-1">
                <div class="hbox1-1-1">
                    <p><a href="javascript:void(0);" onclick="go_login();">로그인</a></p>
                    <p>|</p>
                    <p><a href="javascript:void(0);" onclick= "go_mypage();">마이페이지</a></p>
                </div>
<!--                <div class="hbox1-1-2">-->
<!--                    <p class="highlight">홈</p>-->
<!--                    <p>한약재</p>-->
<!--                    <p class="highlight"><a href="javascript:void(0);" onclick="go_smart();">스마트오더</a></p>-->
<!--                    <p>정기배송</p>-->
<!--                    <p>약재시세</p>-->
<!--                </div>-->
            </div>
            <div class="hbox1-2">
                <div class="topbox1-1">
                    <img class="logo" src="/assets/web/src/logo_default.png" alt="img"  onclick="go_main();">
                </div>
                <div class="topbox1-2">
                    <input type="search" name="h_sKey" id="h_sKey" value="" placeholder="약재를 검색하십시오">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="topbox1-3">
                    <i class="fa-solid fa-border-all" onclick="go_productList(2);"></i>
<!--                    <i class="fa-solid fa-location-dot icon1"></i>-->
                    <i class="fa-solid fa-receipt icon2" onclick=""></i>
                    <i class="fa-solid fa-cart-shopping icon2"></i>
                </div>
            </div>
        <?}?>

        </div>
    </div>
</header>
