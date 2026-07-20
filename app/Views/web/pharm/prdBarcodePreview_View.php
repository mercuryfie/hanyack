<?= $this->extend("/web/template/layout_none") ?>
<?= $this->section("content") ?>
<script src="<?=URL_COMMON_ASSETS?>/jquery-barcode.js"></script>
<script src="<?=URL_PHARM_ASSETS?>/prdBarcodePreview_Do.js"></script>
<section class="content">
    <div class="pop_prn_wrap">
        <div class="modal_wrapux7 mb40" id="org_area" name="org_area">
            <div class="print_box40c">
                <div class="print_boxfv8 flexType1" >
                    <div class="pop_prn_barcode_con" id="barcodeDiv" data-pcode="<?=$body['hncode']?>" style=""></div>
                </div>
                <!--            <div class="print_boxfv7 flexType1">-->
                <!--                <img src="/assets/web/src/logo_default.png" alt="img">-->
                <!--            </div>-->
                <div class="print_boxfv6 flexType2 mb5">
                    <p class="category mr10">제조판매원</p>
                    <p class="colon"> : <?=$body['winame'];?></p>
                </div>
                <div class="print_boxfv6 flexType2 mb5">
                    <p class="category mr10">제조사 주소</p>
                    <p class="colon fs12"> : <?=$body['address'];?></p>
                </div>
<!--                <div class="print_boxfv6 flexType2">-->
<!--                    <p class="category mr10">연락처</p>-->
<!--                    <p class="colon"> : --><?php //=$body['phone'];?><!--</p>-->
<!--                </div>-->
                <div class="print_boxfv6 flexType2 mb5">
                    <p class="category mr10">포장중량</p>
                    <p class="colon"> : <?=$body['w_name'];?></p>
                </div>
                <div class="print_boxfv6 flexType2 mb5">
                    <p class="category mr10">원산지</p>
                    <p class="colon"> : <?=$body['n_value'];?></p>
                </div>
                <div class="print_boxfv6 flexType2 mb5">
                    <p class="category mr10">제조번호</p>
                    <p class="colon"> : <?=$body['hn_number'];?></p>
                </div>
<!--                <div class="print_boxfv6 flexType2">-->
<!--                    <p class="category mr10">허가번호</p>-->
<!--                    <p class="colon"> : --><?php //=$body['auth'];?><!--</p>-->
<!--                </div>-->
                <div class="print_boxfv6 flexType2 mb5">
                    <p class="category mr10">유통기한</p>
                    <p class="colon"> : <?=$body['hn_end'];?></p>
                </div>
                <div class="print_boxfv9 flexType1">
                    <p class="mdName"><?=$body['hnname'];?></p>
                </div>

            </div>
        </div>
        <div class="print_boxd2s flexType1">
            <button type="button" class="btnType32 mr10" id="btn_close" name="btn_close">취소</button>
            <button type="button" class="btnType32-2" id="btn_prn" name="btn_prn">출력</button>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
