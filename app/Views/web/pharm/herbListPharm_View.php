<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>

<!-- js ----------------------------  -->
<!--<script src="--><?php //=URL_PHARM_ASSETS?><!--/herbListPharm.js?rnd=--><?php //=rand();?><!--"></script>-->
<script src="<?=URL_PHARM_ASSETS?>/herbListPharm_Do.js?rnd=<?=rand();?>"></script>
<section class="merright">
    <div class="merright1-0">
    </div>
    <div class="common_list_wrap hlp_wrap">
        <div class="sch_box flexType3 mb20">
            <div class="flexType2">
                <input type="search" class="input_search mr10" placeholder="약재명을 검색하십시오.">
                <button type="button" name="" class="btnType32-2 ">검색</button>
            </div>
            <button onclick="go_herbReg();" class="btnType32-1">약재 등록</button>
        </div>
        <table class="common_table hlp_table" >
            <tr>
                <th class="merlirow">약재코드</th>
                <th class="merlirow">
                    <div class="h_name">
                        약재명
                        <p class="cat fontType1">구분/가공방법</p>
<!--                        <div class="flexType1">-->
<!--                            <p class="cat fontType1">구분/가공방법</p>-->
<!--                            <p class="cat fontType1">가공방법</p>-->
<!--                        </div>-->
                    </div>
                </th>
                <th class="merlirow">원산지</th>
                <th class="merlirow">단위무게(g)</th>
                <th class="merlirow">단위갯수</th>
                <th class="merlirow">근당가격</th>
                <th class="merlirow">판매가격</th>
                <th class="merlirow">총재고</th>
                <th class="merlirow">적정재고</th>
                <th class="merlirow">생산</th>
                <th class="merlirow">재고</th>
                <th class="merlirow">수정</th>
                <th class="merlirow">출력</th>
                <th class="merlirow">재고상태</th>
                <th class="merlirow">판매상태</th>
            </tr>
            <tbody id="herbList" name="herbList">

            </tbody>
        </table>
        <div class="main1-1">
            <div class="merbox">
            </div>

            <div class="common_page_box flexType1" id="pageArea" data-page="1" data-pcnt="30">
            </div>
        </div>
    </div>
</section>

<?= $this->include("/web/include/pop_ProduceHerbLog_View") ?>
<?= $this->include("/web/include/pop_ProduceHerb_View") ?>
<?= $this->endSection() ?>
