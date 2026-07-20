<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>
<script src="<?=URL_DECOC_ASSETS?>/nsmartOrder_Do.js?rnd=<?echo(rand()); ?>"> </script>
<section class="smartOrder">
      <div class="common_list_wrap so_wrap">
          <div class="smartcon3 ">
            <!--            <p class="smart_head_title">스마트 오더</p>-->

              <div class="scbtnbox flexType3  ">
                <div class="sch_box flexType2">
                    <input type="search" class="input_search mr10" id="txtSmart" name="txtSmart" placeholder="약재명또는코드를 검색하십시오.">
                    <button type="button" id="btnSmartSearch" name="btnSmartSearch" class="btnType32-1 ">검색</button>
                </div>
                <div class="flexType2">
                    <div class="right flexType2 mr10" id=" ">
                        <p class="text mr10">총</p>
                        <p class="text text2 mr10" id="totalRs"></p>
                        <p class="text ">개</p>
                    </div>
                    <select name="oby" id="oby" class="select_type typ2 mr10">
                        <option value="1">재고부족량 내림차순</option>
                        <option value="2">재고부족량 오름차순</option>
                        <option value="3">약재명 내림차순</option>
                        <option value="4">약재명 오름차순</option>
                        <option value="5">총재고 오름차순</option>
                        <option value="6">총재고 내림차순</option>
                        <option value="7">관리대상</option>
                        <option value="8">비관리대상</option>
                    </select>

                    <select name="pCnt" id="pCnt" class="select_type typ2 ">
                        <option value="30" selected>30개</option>
                        <option value="50">50개</option>
                        <option value="100">100개</option>
                    </select>
                </div>
          </div>

        </div>

        <div class="smartcon5">
            <div class="sotablebox">
                <table class="common_table sotable">
                    <thead>
                    <tr class="">
                        <td class="socol1 scidx1-1">약재명</td>
                        <td class="socol1 scidx1-2">약재코드</td>
                        <td class="socol1 scidx1-3">총재고</td>
                        <td class="socol1 scidx1-4">약재함재고</td>
                        <td class="socol1 scidx1-5">창고재고</td>
                        <td class="socol1 scidx1-6">주간사용량</td>
                        <td class="socol1 scidx1-7">월간사용량</td>
                        <td class="socol1 scidx1-8">적정재고</td>
                        <td class="socol1 scidx1-9">재고</td>
                        <td class="socol1 scidx1-10">구매</td>
                    </tr>
                    </thead>
                    <tbody id="cList" name="cList" data-cfcode="<?=$body['cfcode'];?>">
                    </tbody>
                </table>
            </div>
        </div>
          <div class="common_page_box flexType1" id="pageArea" data-page="1">
          </div>
        <div class="smartcon5"></div>
        <div class="smartcon6"></div>
      </div>
    </section>
<?= $this->include("/web/include/pop_SO_Manage_View") ?>
<?= $this->include("/web/include/pop_Price_View") ?>
<?= $this->include("/web/include/pop_ConfirmOrder_View") ?>
<?= $this->include("/web/include/pop_PayResult_View") ?>
<?= $this->endSection() ?>
