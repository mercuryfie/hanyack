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
                    <a href="#" role="button"  class="period active" >오늘</a>
                    <a href="#" role="button" class="period">1개월</a>
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
            <table class="common_table slp_table" id="ship_list_tbl" name="">
                <thead>
                <tr>
                    <th class="merlirow">상태</th>
                    <th class="merlirow">배송코드</th>
                    <th class="merlirow">업체명</th>
                    <th class="merlirow">총 수량</th>
                    <th class="merlirow">총 무게</th>
                    <th class="merlirow">배송타입</th>
                    <th class="merlirow">송장번호</th>
                    <th class="merlirow">입력</th>
                    <th class="merlirow">출력</th>
                    <th class="merlirow">등록일</th>
                </tr>
                </thead>
                <tbody id="packagelist" name="packagelist">

                </tbody>
            </table>
        </div><div class="area area8">
            <div class="page_box flexType1" id="pageArea" data-page="1" >
            </div>

        </div>
        <div class="area area5">
            <p class="sub_title">배송 상세</p>
        </div>

        <div class="area area6">
<!--            table2-->
            <table class="common_table slp_table_detail">
                <thead>
                <tr>
                    <th class="merlirow">
                        <input type="checkbox" name="" id="" class="input_check">
                    </th>
                    <th class="merlirow fixed_w">
                        <div class="flexCol2">
                            <p class="cat">요청코드</p>
<!--                            <p class="cat">배송코드</p>-->
<!--                            <p class="cat">제품코드</p>-->
                        </div>
                    </th>
                    <th class="merlirow fixed_w">
                        <div class="h_name_box flexCol2">
                            <p class="h_name">약재명</p>
                            <p class="t_value">구분/가공방법</p>
                        </div>
                    </th>
                    <th class="merlirow">수량</th>
                    <th class="merlirow">포장단위(g)</th>
                    <th class="merlirow fixed_w2">출하예정일자</th>
                    <th class="merlirow">초기화</th>
                </tr>
                </thead>

                <tbody id="packagelistinfo" name="packagelistinfo">

                </tbody>
            </table>
        </div>

        <div class="area area7 flexType3-1">
            <div class="left"></div>
            <div class="set_delityp flexType2-1">
                <div class="delityp flexType2 mr40 mb10">
                    <p class="cat mr10">배송방법</p>
                    <select name="" id="" class="inputType1">
                        <option value="">11</option>
                        <option value="">22</option>
                        <option value="">33</option>
                    </select>
                </div>
                <div class="delityp flexType2 mr40 mb10">
                    <p class="cat mr10">송장번호</p>
                    <input type="search" name="" id="" class="inputType1" placeholder="송장번호 입력">
                </div>
                <div class="delityp flexType2  mb10">

                    <button type="button" class="btnType32" onclick="go_productList('2')">
                        확인
                    </button>
                </div>
            </div>


        </div>
<!--        <div class="area area8">-->
<!--            <div class="common_page_box flexType1" id="pageArea" data-page="1" >-->
<!--            </div>-->
<!---->
<!--        </div>-->
    </div>
</section>

<?= $this->endSection() ?>

