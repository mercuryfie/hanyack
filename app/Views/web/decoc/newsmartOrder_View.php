<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>
<script src="<?=URL_DECOC_ASSETS?>/nsmartOrder_Do.js?rnd=<?echo(rand()); ?>"> </script>
<section class="smartOrder">
      <div class="smartwrap">
          <div class="smartcon3 mt20">
            <!--            <p class="smart_head_title">스마트 오더</p>-->

              <div class="scbtnbox flexType3  ">
                <div class="flexType2">
                    <div class="right flexType2 mr20" id=" ">
                        <p class="text mr10">총</p>
                        <p class="text text2 mr10" id="totalRs"></p>
                        <p class="text ">개</p>
                    </div>
                </div>
                <div class="flexType2">
                    <div class="btn_box flexType2 mr20">
                        <button type="button" name="pCnt" data-pval="30" class="filterType1 active">30개</button>
                        <button type="button" name="pCnt" data-pval="50" class="filterType1 ml10">50개</button>
                        <button type="button" name="pCnt" data-pval="100" class="filterType1 ml10">100개</button>
                    </div>
                    <select name="oby" id="oby" class="SO_filter">
                        <option value="1">재고부족량 내림차순</option>
                        <option value="2">재고부족량 오름차순</option>
                        <option value="3">약재명 내림차순</option>
                        <option value="4">약재명 오름차순</option>
                        <option value="5">총재고 오름차순</option>
                        <option value="6">총재고 내림차순</option>
                        <option value="7">관리대상</option>
                        <option value="8">비관리대상</option>
                    </select>
                </div>
          </div>

        </div>

        <div class="smartcon5">
            <div class="sotablebox">
                <table class="sotable">
                    <thead>
                    <tr class="">
                        <td class="socol1 scidx1-1">약재명</td>
                        <td class="socol1 scidx1-2">약재코드</td>
                        <td class="socol1 scidx1-3">총재고</td>
                        <td class="socol1 scidx1-3">약재함재고</td>
                        <td class="socol1 scidx1-3">창고재고</td>
                        <td class="socol1 scidx1-4">주간사용량</td>
                        <td class="socol1 scidx1-5">월간사용량</td>
                        <td class="socol1 scidx1-3">적정재고</td>
                        <td class="socol1 scidx1-3">재고</td>
                        <td class="socol1 scidx1-5">구매</td>
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
