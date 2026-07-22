<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/materialList_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
</script>

<section class="merright">
    <div class="common_list_wrap mlogp_wrap">
        <div class="area mb10">
            <p class="main_title ">원재료 로그</p>
        </div>
        <div class="area area2 mb10 flexType3-1">
            <div class="left">
                <div class="flexType2">
                    <p class="cat">약재코드</p>
                    <p class="data">13241234</p>
                </div>
                <div class="flexType2">
                    <p class="cat">약재명</p>
                    <p class="data">감초</p>
                </div>
            </div>
            <div class="right">

                <button type="button" class="btnType32-2" name="" data-code="" onclick="go_materialList();">
                    목록으로
                </button>
            </div>

        </div>

        <div class="area area3">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row h_code">날짜</th>
                    <th class="row h_name">무게</th>
                    <th class="row ">사유</th>
                    <th class="row">비고</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2026.01.01</td>
                        <td>10,000g</td>
                        <td>폐기</td>
                        <td>불량으로 인한 폐기</td>
                    </tr>
                    <tr>
                        <td>2026.01.01</td>
                        <td>10,000g</td>
                        <td>폐기</td>
                        <td>불량으로 인한 폐기</td>
                    </tr>
                    <tr>
                        <td>2026.01.01</td>
                        <td>10,000g</td>
                        <td>폐기</td>
                        <td>불량으로 인한 폐기</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="common_page_box flexType1 " id="" data-page="1" data-pcnt="">
        </div>

    </div>

</section>
<?= $this->endSection() ?>
