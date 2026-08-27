<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/mainHerbList_Do.js?rnd=<?=rand();?>"> </script>
<section class="">
<div class="mainThumWrap main_wrap_ver4">
    <div class="viewBox flexType3">
        <p class="resultText" id="r_txt" name="r_txt"></p>
        <div class="flexType2">
            <div class="right flexType3" id=" ">
                <p class="text ">총</p>
                <p class="text text2 " id="totalRs"></p>
                <p class="text ">건</p>
            </div>
        </div>
    </div>
    <div class="main1-1">
        <div class="merbox" id="herblist" name="herblist">
        </div>

        <div class="common_page_box flexType1" id="pageArea" data-page="1" data-pcnt="<?=$body['pcnt'];?>">
        </div>
    </div>
</div>
</section>

<?= $this->endSection() ?>
