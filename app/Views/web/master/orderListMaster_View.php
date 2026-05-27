<?= $this->extend("/web/template/layout_mypage_dj") ?>
<?= $this->section("content") ?>

<script src="<?=URL_MASTER_ASSETS?>/orderListMaster_Do.js?rnd=<?=rand();?>"></script>

<section class="merright">
    <div class="merright1-0">
    </div>
    <!-- <div class="merright1-1">
        <p>필터</p>
        <div class="merli1-1">
            <button>전체보기</button>
            <button>매칭약재</button>
            <button>미매칭약재</button>
        </div>
    </div> -->
    <div class="merlibox1-1 order_list_master_wrap">
        <!-- <button>새 창</button> -->
        <div class="ttl_box">
            <p class="head_ttl">주문내역</p>

        </div>
        <div class="odrbox1-1 orderBoxMaster">

            <div class=" flexType3 mb10">
                <div class="flexType2">
                    <div class="left period_box flexType2 mr10">
                        <a href="javascript:;" class="period active">오늘</a>
                        <a href="javascript:;" class="period">1주일</a>
                        <a href="javascript:;" class="period">1개월</a>
                        <a href="javascript:;" class="period">3개월</a>
                    </div>
                    <div class="filter_box flexType2">
                        <select name="" id="date_filter" class="selectType1">
                            <option value="결제일">날짜별</option>
                            <option value="결제일">결제일</option>
                            <option value="주문확인일">주문확인일</option>
                            <option value="발송처리일">발송처리일</option>
                        </select>
                        <select name="" id="decoc_filter" class="selectType4-1">
                            <option value="">탕전실별</option>
                            <?=$body['option1'];?>
                        </select>
                        <select name="" id="pharm_filter" class="selectType4-1">
                            <option value="">제약사별</option>
                            <?=$body['option2'];?>
                        </select>
                    </div>
                </div>
                <div class="right flexType2">
                    <button type="button" id="btn_deli" name="btn_deli" class="btnType4-1 mr10" onclick="go_RegularOrder();">정기구독 주문</button>
                    <button type="button" id="btn_deli" name="btn_deli" class="btnType4-1" onclick="go_BigOrder();">대량 주문</button>

                </div>
            </div>

        </div>

        <div class="order_box40c">
            <table class="merlitable">
                <thead>
                <tr>
                    <td class="merlirow">상태</td>
                    <td class="merlirow">주문번호</td>
                    <td class="merlirow">주문일자</td>
                    <td class="merlirow">재약사</td>
                    <td class="merlirow">탕전실</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">주문방식</td>
                    <td class="merlirow">옵션</td>
                    <td class="merlirow">수량</td>
                    <td class="merlirow">포장단위가격</td>
                    <td class="merlirow">총액</td>
                    <td class="merlirow">확인</td>
                </tr>
                </thead>
                <tbody id="orderlist" class="">
                </tbody>
            </table>
        </div>

        <div class="moreListBox">
            <button class="moreList" id="more1" name="more1" type="button" data-page="1">
                더보기
            </button>
            <i class="fa-solid fa-angle-down" id="more2" name="more2"></i>
        </div>

    </div>



</section>

<?= $this->endSection() ?>
