<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>
<script src="<?=URL_PHARM_ASSETS?>/shipListPharm_Do.js?rnd=<?=rand();?>"></script>

<section class="merright">
    <div class="merright1-0">
    </div>
    <div class="common_list_wrap slp_wrap">
        <p class="main_title">배송내역</p>
        <div class="area area2 mt10">
            <div class="left flexType2 ">
                <div class="left period_box flexType2 mr10">
                    <a href="#" role="button"  class="period active" >전체</a>
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
                    <option value="1">출고준비</option>
                    <option value="2">출고시작</option>
                    <option value="3">출고완료</option>
                </select>
                <input type="search" id="skey" name="skey" placeholder="배송코드를 입력해 주세요." class="input_search mr10">
                <button class="btnType32-1 active" name="btnOSearch" id="btnOSearch">조회</button>
            </div>

        </div>
        <div class="area area3">
            <p class="sub_title">배송 목록</p>
        </div>
        <div class="area area4">
            <table class="common_table slp_table">
                <thead>
                <tr>
                    <th class="merlirow">상태</th>
                    <th class="merlirow">배송코드</th>
                    <th class="merlirow">업체명</th>
                    <th class="merlirow">총 갯수</th>
                    <th class="merlirow">총 무게</th>
                    <th class="merlirow">발송타입</th>
                    <th class="merlirow">송장번호</th>
                    <th class="merlirow">확인</th>
                    <th class="merlirow">출력</th>
                    <th class="merlirow">등록일</th>
                </tr>
                </thead>
                <tbody id="packagelist" name="packagelist">

                </tbody>
            </table>
        </div>
        <div class="main1-1">
            <div class="merbox">
            </div>

            <div class="common_page_box flexType1" id="pageArea" data-page="1" >
            </div>
        </div>
        <div class="shipBox shipBox1-3">
        <div class="area area5">
            <p class="sub_title">배송 상세</p>
        </div>
        <div class="shipBox shipBox1-2">

        <div class="area area6">
<!--            table2-->
            <table class="common_table slp_table_detail">
                <thead>
                <tr>
                    <th class="merlirow">요청코드</th>
                    <th class="merlirow">배송코드</th>
                    <th class="merlirow">제품코드</th>
                    <th class="merlirow">약재명</th>
                    <th class="merlirow">구분</th>
                    <th class="merlirow">가공방법</th>
                    <th class="merlirow">갯수</th>
                    <th class="merlirow">포장단위(g)</th>
                    <th class="merlirow">출하예정일자</th>
                </tr>
                </thead>

                <tbody id="packagelistinfo" name="packagelistinfo">


                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

