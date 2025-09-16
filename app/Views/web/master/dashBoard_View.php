<?= $this->extend("/web/template/layout_mypage_dj") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/dashBoard_Do.js?rnd=<?=rand();?>"></script>

<section class="merright">
<!--    <div class="merright1-0">-->
<!--    </div>-->
<div class="merright1-1 dashbox">
    <p>마이페이지 > 주문관리 처리 예정</p>
    <div class="bannerbox bb1-1 flexType3">
        <div class="GaugeMeter" id="stock_meger"
             data-used=""
             data-total="100"
             data-text=" "
             data-size="180"
             data-width="20"
             data-style="Arch"
             data-color="#5e9b76"
             data-back="#ececec"
             data-theme=" "
             data-animationstep="10"
             data-animate_gauge_colors="1"
             data-animate_text_colors="0"
             data-label=""
             data-label_color="blue"
             data-stripe=""
             data-showvalue="0"
             data-text_size="22"
             data-threshold="70"
        >
            <div class="title flexType3">
                <p class="name">약재 재고</p>
                <div class="flexCol">
                    <div class="status flexType2" >
                        <p class="tag tag1"></p>
                        <p class="tag3">적정:건</p>
                    </div>
                    <div class="status flexType2" >
                        <p class="tag tag2"></p>
                        <p class="tag3">부족:건</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="GaugeMeter"
             data-used="60"
             data-total="100"
             data-text=" "
             data-size="180"
             data-width="20"
             data-style="Arch"
             data-theme=""
             data-color="#5e9b76"
             data-back="#ececec"
             data-animationstep="10"
             data-animate_gauge_colors="1"
             data-animate_text_colors="0"
             data-label=""
             data-label_color="blue"
             data-stripe=""
             data-showvalue="0"
             data-text_size="22"
        >
            <div class="title flexType3">
                <p class="name">배송 현황</p>
                <div class="flexCol">
                    <div class="status flexType2" >
                        <p class="tag tag1"></p>
                        <p class="tag3">배송대기</p>
                    </div>
                    <div class="status flexType2" >
                        <p class="tag tag2"></p>
                        <p class="tag3">배송중</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="GaugeMeter"
             data-used="40"
             data-total="100"
             data-text=" "
             data-size="180"
             data-width="20"
             data-style="Arch"
             data-color="#5e9b76"
             data-back="#ececec"
             data-animationstep="10"
             data-animate_gauge_colors="1"
             data-animate_text_colors="0"
             data-label=""
             data-label_color="blue"
             data-stripe=""
             data-showvalue="0"
             data-text_size="22"
        >
            <div class="title flexType3">
                <p class="name">입고 현황</p>
                <div class="flexCol">
                    <div class="status flexType2" >
                        <p class="tag tag1"></p>
                        <p class="tag3">입고대기</p>
                    </div>
                    <div class="status flexType2" >
                        <p class="tag tag2"></p>
                        <p class="tag3">입고중</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="GaugeMeter"
             data-used="20"
             data-total="100"
             data-text=" "
             data-size="180"
             data-width="20"
             data-style="Arch"
             data-color="#5e9b76"
             data-back="#ececec"
             data-animationstep="10"
             data-animate_gauge_colors="1"
             data-animate_text_colors="0"
             data-label=""
             data-label_color="blue"
             data-stripe=""
             data-showvalue="0"
             data-text_size="22"
        >
            <div class="title flexType3">
                <p class="name">주문현황</p>
                <div class="flexCol">
                    <div class="status flexType2" >
                        <p class="tag tag1"></p>
                        <p class="tag3">주문대기</p>
                    </div>
                    <div class="status flexType2" >
                        <p class="tag tag2"></p>
                        <p class="tag3">주문완료</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <img src="/assets/web/src/myDashBoard3.png" alt="img">
</div>
</section class="">


<?= $this->endSection() ?>