<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>


<script src="<?=URL_PHARM_ASSETS?>/prodList_Do.js?rnd=<?echo(rand()); ?>"> </script>
<section class="merright">
    <div class="common_list_wrap plp_wrap">
        <p class="main_title mb10">생산 내역</p>

        <div class="area area1 mb10 flexType3">
            <div class="left">
                <div class="data_box flexType2">
                    <p class="cat">약재코드</p>
                    <p class="h_code" id="hncode"><?=$body['hncode'];?></p>
                </div>
                <div class="data_box flexType2">
                    <p class="cat cat2">약재명</p>
                    <p class="h_name" id="hnname" data-hnname="<?=$body['hnname'];?>"><?=$body['hnname'];?></p>
                </div>
            </div>
            <div class="right">
                <button type="button" id="" name="" class="btnType32-2 mr10" onclick="go_herbList()" >목록으로</button>
                <button type="button" id="prod_herb" name="prod_herb" class="btnType32-1" data-hnname="<?=$body['hnname'];?>" data-wvalue="<?=$body['wvalue'];?>">생산하기</button>

            </div>
        </div>
        <div class="area area3">

            <?php $body?>
        </div>
        <div class="area area2">
            <table class="common_table">
                <thead>
                <tr>
                    <th class="row h_code">생산코드</th>
                    <th class="row h_code">제조번호</th>
                    <th class="row ">제조일자</th>
                    <th class="row ">소비기한</th>
                    <th class="row ">생산량</th>
                    <th class="row ">재고</th>
                    <th class="row ">상태</th>
                    <th class="row ">입/출고</th>
                    <th class="row ">입/출고내역</th>
                    <th class="row ">시험성적서</th>
                    <th class="row btn">가격수정</th>
                    <th class="row btn">바코드</th>
                </tr>
                </thead>
                <tbody id="dataList">


                </tbody>
            </table>
        </div>

        <div class="common_page_box flexType1 " id="pageArea" data-page="1" data-pcnt="<?=$body['pcnt'];?>">

        </div>

    </div>

</section>

<?= $this->include("/web/include/pop_InMedicine_View") ?>
<?= $this->include("/web/include/pop_OutMedicine_View") ?>
<?= $this->include("/web/include/pop_ProduceHerb_View") ?>
<?= $this->include("/web/include/pop_EditProdHerb_View") ?>

<?= $this->endSection() ?>
