<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/materialList_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
</script>

<section class="merright">
    <div class="common_list_wrap mlp_wrap">
        <p class="main_title mb20">원재료 목록</p>

        <div class="area area2">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row h_code">약재코드</th>
                    <th class="row h_name">약재명</th>
                    <th class="row ">총재고</th>
                    <th class="row">로그</th>
                    <th class="row">입출고</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12341234</td>
                        <td>감초</td>
                        <td>10,000g</td>
                        <td>
                            <button type="button" class="btnType1" name="btn_log" data-code="" >
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btnType1 mr5" name="h_input" >입고</button>
                            <button type="button" class="btnType1" name="h_output" >출고</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12341234</td>
                        <td>복령</td>
                        <td>10,000g</td>
                        <td>
                            <button type="button" class="btnType1" name="btn_log" data-code="" >
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btnType1 mr5" name="" >입고</button>
                            <button type="button" class="btnType1" name="" >출고</button>
                        </td>
                    </tr>
                    <tr>
                        <td>12341234</td>
                        <td>대추</td>
                        <td>10,000g</td>
                        <td>
                            <button type="button" class="btnType1" name="btn_log" data-code="" >
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btnType1 mr5" name="" >입고</button>
                            <button type="button" class="btnType1" name="" >출고</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="common_page_box flexType1 " id="" data-page="1" data-pcnt="">
        </div>

    </div>

</section>
<?= $this->include("/web/include/pop_outMaterial_View") ?>
<?= $this->include("/web/include/pop_addMaterial_View") ?>
<?= $this->endSection() ?>
