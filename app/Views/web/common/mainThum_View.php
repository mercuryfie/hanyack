<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/herbList_Do.js?rnd=<?=rand();?>"> </script>
<section class="mainbanner">
<div class="mainThumWrap">
    <div class="viewBox flexType3">
        <p class="resultText" id="r_txt" name="r_txt">전체11</p>
        <div class="flexType2">
            <div class="right flexType2 mr20" id=" ">
                <p class="text mr10">총</p>
                <p class="text text2 mr10" id="totalRs"></p>
                <p class="text ">개</p>
            </div>
        </div>
    </div>
    <div class="main1-1">
        <div class="merbox" id="herblist" name="herblist">
        </div>

        <div class="common_page_box old_type flexType1" id="pageArea" data-page="1" data-pcnt="<?=$body['pcnt'];?>">
        </div>
    </div>
</div>
</section>

<?= $this->endSection() ?>
