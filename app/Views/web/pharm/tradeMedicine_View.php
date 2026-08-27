<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/tradeMedicineList_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
</script>

<section class="merright">
    <div class="common_list_wrap pmlp_wrap">
        <div class="area mb10">
            <p class="main_title ">약재 거래내역</p>
        </div>
        <div class="area filter_box flexType3 mb10">
            <div class="left flexType2">
                <select name="" id="" class="select_type h32 mr10">
                    <option value="1">30개</option>
                    <option value="2">50개</option>
                    <option value="3">100개</option>
                </select>
                <div class="period_box flexType2 mr10">
                    <a href="#" role="button"  class="period active" >오늘</a>
                    <a href="#" role="button" class="period">1개월</a>
                    <a href="#" role="button" class="period">3개월</a>
                    <a href="#" role="button" class="period">6개월</a>
                </div>
                <div class="input_period_box flexType3 mr10">
                    <input type="date" class="input_date" id="sdate">
                    <p class="dash">-</p>
                    <input type="date" class="input_date" id="edate">
                </div>
                <select name="stype" id="stype" class="select_type h32 p5 mr10">
                    <option value="">전체</option>
                    <option value="1">구매</option>
                    <option value="2">판매</option>
                </select>
                <select name="vendor" id="vendor" class="select_type h32 p5 mr10">
                    <option value="">업체선택</option>
                    <?=$body['option'];?>
                </select>
                <input type="search" class="input_search mr10" id="skey" name="skey" placeholder="약재명을 검색하십시오.">
                <button type="button" id="btnTSearch" name="btnTSearch" class="btnType32-1 ">검색</button>

            </div>
            <?if(!empty($body['vcode'])){?>
            <button type="button" class="btnType32-2 " onclick="go_tradeMedicineList();">전체보기</button>
            <?}?>

        </div>
        <div class="dd">

        </div>

        <div class="area area2">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row ">날짜</th>
                    <th class="row ">구매/판매</th>
                    <th class="row h_name">약재명</th>
                    <th class="row h_name">업체명</th>
                    <th class="row ">총 무게</th>
                    <th class="row ">근당가격</th>
                    <th class="row ">수량</th>
                    <th class="row ">총 가격</th>
                    <th class="row ">거래일자</th>
                    <th class="row h_code">거래코드</th>
                    <th class="row">거래명세서</th>
                </tr>
                </thead>
                <tbody id="dataList">
                </tbody>
            </table>
        </div>

        <div class="common_page_box flexType1 " id="pageArea" data-page="1" data-pcnt="<?=$body['pCnt'];?>" >
        </div>

    </div>

</section>
<?= $this->include("/web/include/pop_AddMaterial_View") ?>
<?= $this->include("/web/include/pop_InMaterial_View") ?>
<?= $this->include("/web/include/pop_OutMaterial_View") ?>
<?= $this->endSection() ?>
