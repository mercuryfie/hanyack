<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>
<script src="<?=URL_PHARM_ASSETS?>/materialLog_Do.js?rnd=<?echo(rand()); ?>"> </script>
<section class="merright">
    <div class="common_list_wrap mlogp_wrap">
        <div class="area mb10">
            <p class="main_title ">원재료 입출고 내역</p>
        </div>
        <div class="area area2 mb10 flexType3-1">
            <div class="left">
                <div class="flexType2">
                    <p class="cat">원재료코드</p>
                    <p class="data" id="mtcode"><?=$body['mtcode'];?></p>
                </div>
                <div class="flexType2">
                    <p class="cat">원재료명</p>
                    <p class="data"><?=$body['mtname'];?></p>
                </div>
            </div>
        </div>
        <div class="area area4 flexType3 mb20">

            <div class="left flexType2">
                <div class="period_box flexType2 mr10">
                    <a href="#" role="button"  class="period active" >전체</a>
                    <a href="#" role="button" class="period">3개월</a>
                    <a href="#" role="button" class="period">6개월</a>
                </div>
                <div class="input_period_box flexType3 mr10 h32">
                    <input type="date" class="input_date" id="sdate">
                    <p class="dash">-</p>
                    <input type="date" class="input_date" id="edate">
                </div>
                <select name="searchType" id="searchType" class="select_type h32 p5 mr10">
                    <option value="1">전체</option>
                    <option value="2">입고</option>
                    <option value="3">출고</option>
                </select>
                <button type="button" id="btnSearch" name="" class="btnType32-1 ">검색</button>
            </div>
            <button type="button" class="btnType32-2" name="" data-code="" onclick="go_materialList();">
                목록으로
            </button>
        </div>

        <div class="area area3">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row h_code">날짜</th>
                    <th class="row h_name">입/출고</th>
                    <th class="row ">입/출고 용량</th>
                    <th class="row ">사유</th>
                    <th class="row">비고</th>
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
<?= $this->endSection() ?>
