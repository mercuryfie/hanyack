<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/materialList_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
</script>

<section class="merright">
    <div class="common_list_wrap mlp_wrap">
        <div class="area mb10">
            <p class="main_title ">원재료 목록</p>
        </div>
        <div class="area flexType3 mb10">
            <div class="left">
                <select name="" id="" class="select_type h32 mr10">
                    <option value="1">30개</option>
                    <option value="2">50개</option>
                    <option value="3">100개</option>
                </select>
                <select name="" id="" class="select_type h32 ">
                    <option value="">전체</option>
                    <option value="">적정재고 적은순</option>
                    <option value="">적정재고 많은순</option>
                    <option value="">약재명 오름차순</option>
                    <option value="">약재명 내림차순</option>
                    <option value="">최종일자 최신순</option>
                    <option value="">최종일자 과거순</option>
                </select>
            </div>
            <div class="flexType2">
                <button type="button" class="btnType32-1 " id="btnMtReg" name="btnMtReg" >원재료 등록</button>
            </div>

        </div>

        <div class="area area2">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row h_code">약재코드</th>
                    <th class="row h_name">약재명</th>
                    <th class="row ">총재고</th>
                    <th class="row ">적정재고</th>
                    <th class="row">입출고</th>
                    <th class="row status">상태</th>
                    <th class="row">최종일자</th>
                    <th class="row">입출고내역</th>
                    <th class="row">수정</th>
                    <th class="row">삭제</th>
                </tr>
                </thead>
                <tbody id="dataList">

                </tbody>
            </table>
        </div>

        <div class="common_page_box flexType1 " id="pageArea" data-page="1" data-pcnt="<?=$body['pCnt'];?>">
        </div>

    </div>

</section>
<?= $this->include("/web/include/pop_AddMaterial_View") ?>
<?= $this->include("/web/include/pop_InMaterial_View") ?>
<?= $this->include("/web/include/pop_OutMaterial_View") ?>
<?= $this->endSection() ?>
