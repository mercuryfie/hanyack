<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>
<script src="<?=URL_PHARM_ASSETS?>/orderListPharm_Do.js?rnd=<?=rand();?>"></script>
<section class="merright">
    <div class="merright1-0">
    </div>
    <div class="common_list_wrap olp_conkol ">
        <div class="  flexType3 mb10">
            <div class="left flexType2">
                <div class="left period_box flexType2 mr10">
                    <a href="#" role="button"  class="period active">오늘</a>
                    <a href="#" role="button"  class="period">1주일</a>
                    <a href="#" role="button" class="period">3개월</a>
                    <a href="#" role="button" class="period">6개월</a>
                </div>

                <div class="input_period_box flexType3 mr10">
                    <input type="date" class="input_date" name="sdate" id="sdate">
                    <p class="dash">-</p>
                    <input type="date" class="input_date" ame="edate" id="edate">
                </div>
                <select name="cfcode" id="cfcode" class="select_type mr10">
                    <option value="">전체탕전실</option>
                    <?=$body['decoc'];?>
                </select>
                <select name="deliStatus" id="deliStatus" class="select_type mr10">
                    <option value="0">전체상태</option>
                    <option value="1">미확인</option>
                    <option value="2">출하처리</option>
                    <option value="3">발송처리</option>
                    <option value="4">발송완료</option>
                </select>
                <input type="search" id="skey" name="skey" placeholder="주문번호 또는 약재명 입력하세요" class="input_search mr10">
                <button class="btnType32-1 active" name="btnOSearch" id="btnOSearch">조회</button>
            </div>
            <div class="right flexType2 ">
<!--                <select name="sort" id="sort" class="select_type typ2 mr10">-->
<!--                    <option value="0">전체날짜</option>-->
<!--                    <option value="1">결제일기준</option>-->
<!--                    <option value="2">출하처리일 기준</option>-->
<!--                    <option value="3">발송처리일 기준</option>-->
<!--                </select>-->
                <select name="pCnt" id="pCnt" class="select_type typ2 ">
                    <option value="30" selected>30개</option>
                    <option value="50">50개</option>
                    <option value="100">100개</option>
                </select>
            </div>
        </div>
        <div class="flexType7 mb10">
        </div>

        <table class="common_table">
            <thead>
                <tr>
                    <th class="merlirow">상태</th>
                    <th class="merlirow">주문번호</th>
                    <th class="merlirow">업체명</th>
                    <th class="merlirow">약재명</th>
                    <th class="merlirow">원산지</th>
                    <th class="merlirow">단위</th>
                    <th class="merlirow">무게</th>
                    <th class="merlirow">단위가격</th>
                    <th class="merlirow">근당가격</th>
                    <th class="merlirow">구매량</th>
                    <th class="merlirow">총가격</th>
                    <th class="merlirow">현 재고량</th>
                    <th class="merlirow">주문일자</th>
                    <th class="merlirow">출하요청일</th>
                    <th class="merlirow">주문확인</th>
                </tr>
            </thead>
            <tbody id="orderList">

            </tbody>

        </table>

        <div class="main1-1">
            <div class="merbox">
            </div>

            <div class="common_page_box flexType1" id="pageArea" data-page="1" >
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>
