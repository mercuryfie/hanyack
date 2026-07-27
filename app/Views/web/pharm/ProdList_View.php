<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>


<script src="<?=URL_PHARM_ASSETS?>/prodList_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
</script>

<section class="merright">
    <div class="common_list_wrap plp_wrap">
        <p class="main_title mb10">재고 내역</p>

        <div class="area area1 mb10 flexType3">
            <div class="left">
                <div class="data_box flexType2">
                    <p class="cat">약재코드</p>
                    <p class="h_code">1234-1234</p>
                </div>
                <div class="data_box flexType2">
                    <p class="cat cat2">약재명</p>
                    <p class="h_name">감초</p>
                </div>
            </div>
            <div class="right">
                <button type="button" id="" name="" class="btnType32-2" onclick="go_herbList()" >목록으로</button>

            </div>
        </div>
        <div class="area area2">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row h_code">생산코드</th>
                    <th class="row h_code">제조번호</th>
                    <th class="row ">제조일자</th>
                    <th class="row ">소비기한</th>
                    <th class="row ">재고</th>
                    <th class="row ">시험성적서</th>
                    <th class="row ">바코드</th>
                    <th class="row ">입출고</th>
                    <th class="row ">로그보기</th>
                </tr>
                </thead>
                <tbody>
                <tr class="status ">
                    <td>12341234</td>
                    <td>12341234</td>
                    <td>2026.01.01</td>
                    <td>2026.01.01</td>
                    <td>10,000g</td>
                    <td>
                        <button type="button" class="btnType1" name="btn_log" data-code="" >
                            <i class="fa-solid fa-file"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btnType1 " onclick="" >
                            <i class="fa-solid fa-barcode"></i>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btnType1 mr5" name="InMaterial" onclick="" >입고</button>
                        <button type="button" class="btnType1" name="OutMaterial" onclick="">출고</button>
                    </td>
                    <td>
                        <button type="button" class="btnType1 mr5" name="" onclick="" >
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="common_page_box flexType1 " id="" data-page="1" data-pcnt="">
        </div>

    </div>

</section>

<?= $this->include("/web/include/pop_InMaterial_View") ?>
<?= $this->include("/web/include/pop_OutMaterial_View") ?>

<?= $this->endSection() ?>
