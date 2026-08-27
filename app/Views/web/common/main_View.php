<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>

<link rel="stylesheet" href="./assets/web/slick/ajax-loader.gif">
<link rel="stylesheet" href="./assets/web/slick/slick-theme.css">
<link rel="stylesheet" href="./assets/web/slick/slick.css">
<script src="<?= URL_COMMON_ASSETS ?>/main.js?rnd=<?= rand(); ?>"></script>
<script src="<?= URL_COMMON_ASSETS ?>/main_Do.js?rnd=<?= rand(); ?>"></script>
<script src="<?= URL_COMMON_ASSETS ?>/GaugeMeter.js"></script>
<section class="mainbanner">
    <div class="mainwrap main_wrap_ver4">
        <div class="main1-1" id="mainTyp1">
            <div class="maintitle">
                <div class="mtbox1-1">
                    <p class="event_title">인기 한약재</p>
<!--                    <p>금주 누적 할인률이 높은 인기 한약재 보기</p>-->
                </div>
                <div class="mtbox1-2">
<!--                    <button type="button" onclick="go_productList(1);" class="more_btn">자세히보기</button>-->
                </div>
            </div>
            <div class="merbox " id="hotList">
            </div>
        </div>
        <div class="main1-2" id="mainTyp2">
            <div class="maintitle">
                <div class="mtbox1-1">
                    <p class="event_title">특가딜</p>
<!--                    <p>금주 누적 할인률이 높은 인기 한약재 보기</p>-->
                </div>
                <div class="mtbox1-2">
<!--                    <button type="button" onclick="go_productList(1);" class="more_btn">자세히보기</button>-->
                </div>
            </div>
            <div class="merbox" id="specialList">

            </div>
        </div>
        <div class="main1-2">
            <div class="maintitle">
                <div class="mtbox1-1">
                    <p class="event_title">MD추천</p>
                    <!--                    <p>금주 누적 할인률이 높은 인기 한약재 보기</p>-->
                </div>
                <div class="mtbox1-2">
                    <!--                    <button type="button" onclick="go_productList(1);" class="more_btn">자세히보기</button>-->
                </div>
            </div>
            <div class="merbox" id="djmediList">

            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>
