<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/transactionList_Do.js?rnd=<?echo(rand()); ?>"> </script>

<script>
</script>

<section class="merright">
    <div class="common_list_wrap pmlp_wrap">
        <div class="area mb20">
            <p class="main_title ">거래 목록</p>
        </div>
        <div class="area filter_box flexType3 mb10">
            <div class="left flexType2">
                <div class="period_box flexType2 mr10">
                    <a href="#" role="button"  class="period active" >전체</a>
                    <a href="#" role="button" class="period">3개월</a>
                    <a href="#" role="button" class="period">6개월</a>
                </div>
                <div class="input_period_box flexType3 mr10">
                    <input type="date" class="input_date" id="s_date">
                    <p class="dash">-</p>
                    <input type="date" class="input_date" id="e_date">
                </div>
                <select name="" id="" class="select_type h32 p5 mr10">
                    <option value="1">전체</option>
                    <option value="2">구매</option>
                    <option value="3">판매</option>
                </select>
                <input type="search" class="input_search mr10" id="" name="" placeholder="원재료명을 검색하십시오.">
                <button type="button" id="btnSmartSearch" name="" class="btnType32-1 ">검색</button>

            </div>
            <button type="button" class="btnType32-2 " id="" name="" onclick="go_materialList();">원재료 목록</button>

        </div>

        <div class="area area2">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row h_code">약재코드</th>
                    <th class="row h_name">약재명</th>
                    <th class="row ">구매/판매</th>
                    <th class="row ">단위무게</th>
                    <th class="row ">수량</th>
                    <th class="row ">총무게</th>
                    <th class="row ">단위가격</th>
                    <th class="row ">총가격</th>
                    <th class="row">거래명세서</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>12341234</td>
                        <td>감초</td>
                        <td>구매</td>
                        <td>10,000g</td>
                        <td>10</td>
                        <td>100,000g</td>
                        <td>10,000원</td>
                        <td>100,000원</td>
                        <td class="row receipt">
                            <button type="button" class="btnType1 " name="" ><i class="fa-solid fa-receipt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>12341234</td>
                        <td>감초</td>
                        <td>구매</td>
                        <td>10,000g</td>
                        <td>10</td>
                        <td>100,000g</td>
                        <td>10,000원</td>
                        <td>100,000원</td>
                        <td class="row receipt">
                            <button type="button" class="btnType1 " name="" ><i class="fa-solid fa-receipt"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>12341234</td>
                        <td>감초</td>
                        <td>구매</td>
                        <td>10,000g</td>
                        <td>10</td>
                        <td>100,000g</td>
                        <td>10,000원</td>
                        <td>100,000원</td>
                        <td class="row receipt">
                            <button type="button" class="btnType1 " name="" ><i class="fa-solid fa-receipt"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="common_page_box flexType1 " id="" data-page="1" data-pcnt="">
        </div>

    </div>

</section>
<?= $this->include("/web/include/pop_AddMaterial_View") ?>
<?= $this->include("/web/include/pop_InMaterial_View") ?>
<?= $this->include("/web/include/pop_OutMaterial_View") ?>
<?= $this->endSection() ?>
