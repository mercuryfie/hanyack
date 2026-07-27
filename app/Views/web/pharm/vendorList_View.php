<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/vendorList_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
</script>

<section class="merright">
    <div class="common_list_wrap velp_wrap">
        <p class="main_title mb10">거래처 목록</p>

        <div class="area area1 mb10 flexType3"  >
            <div class="flexType2 company_wrap">
<!--                <a href="javascript:;" class="manage_vendor active" onclick="go_vendorList()">매입처 관리</a>-->
<!--                <a href="javascript:;" class="manage_customer" onclick="go_customerList()">매출처 관리</a>-->
            </div>
            <div class="flexType2">
                <input type="search" name="" id="" class="input_type2 h32 mr10" placeholder="업체명을 검색하십시오.">
                <button class="btnType32-2 mr10" id="btnOrderSearch" type="button">검색</button>

                <button type="button" class="btnType32-1 " id="add_vendor" name="add_vendor" >거래처 등록</button>
            </div>
        </div>
        <div class="area area2">
            <table class="common_table ">
                <thead>
                <tr>
                    <th class="row ">업체명</th>
                    <th class="row ">사업자번호</th>
                    <th class="row ">연락처</th>
                    <th class="row ">메일</th>
                    <th class="row ">회계용 메일</th>
                    <th class="row ">주소</th>
                    <th class="row ">상세주소</th>
                    <th class="row ">비고</th>
                    <th class="row ">삭제</th>
                </tr>
                </thead>
                <tbody class="" id="v_list">
                </tbody>
            </table>
        </div>
        <div class="common_page_box flexType1 " id="pageArea" data-page="1" data-pcnt="30">
        </div>

    </div>

</section>

<?= $this->include('/web/include/pop_AddVendor_View') ?>
<?= $this->endSection() ?>
