<?= $this->extend("/web/template/layout_none") ?>
<?= $this->section("content") ?>
<script src="<?= URL_PHARM_ASSETS ?>/prdBarcodePreview_Do.js?rnd=<?= rand(); ?>"></script>
<section class="content">
    <form action="">
        <div class="modal_wrapux7">
            <div class="print_box40c">
                <div class="print_boxfv6  ">
                    <p class="category">허브코드</p>
                </div>
                <div class="print_boxfv7 flexType1">
                    <img src="/assets/web/src/logo_master.png" alt="img">
                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">제조판매원</p>
                    <p class="colon"> : </p>

                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">제조사 주소</p>
                    <p class="colon"> : </p>

                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">연락처</p>
                    <p class="colon"> : </p>
                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">포장중량</p>
                    <p class="colon"> : </p>
                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">원산지</p>
                    <p class="colon"> : </p>
                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">제조번호</p>
                    <p class="colon"> : </p>
                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">허가번호</p>
                    <p class="colon"> : </p>
                </div>
                <div class="print_boxfv6 flexType2">
                    <p class="category mr10">사용기한</p>
                    <p class="colon"> : </p>
                </div>
                <div class="print_boxfv6 flexType1">
                    <p class="mdName">허브팜연자육</p>
                </div>
            </div>
            <div class="print_boxd2s flexType1">
                <button type="button" class="btnType3" onclick="exit_thisWindow();">취소</button>
                <button type="button" class="btnType4" onclick="print_thisPage();">출력</button>
            </div>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
