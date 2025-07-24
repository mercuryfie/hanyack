<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/mainList_Do.js"> </script>

<input type="hidden" id="l_typ" name="l_typ" value="<?=$body['typ']?>" >
<section class="mainbanner">
<div class="mainThumWrap">
    <div class="viewBox flexType3">
        <p class="resultText" id="r_txt" name="r_txt"></p>

        <div class="viewFilter flexType2">
            <i class="fa-solid fa-border-all" onclick="go_productList(1);"></i>
            <i class="fa-solid fa-list" onclick="go_productList(2);"></i>

        </div>
    </div>
    <div class="main1-1">
        <div class="merbox" id="selllist" name="selllist">

        </div>

        <div class="more_box flexType1" type="button" name="more" id="more">
            <button class="moreList" id="btnmore1" name="btnmore1" type="button" data-page="<?=$body['page']?>">
                더보기
            </button>
            <i class="fa-solid fa-angle-down" id="btnmore2" name="btnmore2"></i>
        </div>
    </div>
</div>
</section>

<?= $this->endSection() ?>
