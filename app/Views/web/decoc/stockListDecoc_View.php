<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<script src="<?=URL_DECOC_ASSETS?>/stockListDecoc_Do.js"> </script>
<script>
</script>

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
    <div class="merlibox1-1 mt20">
        <p>약재관리</p>
        <!-- <button>새 창</button> -->

        <div class="stockBox1-1 flexType3">
            <div class="stockBox1-1-1">
                <div class="upside flexType2">
                    <div class="left flexType2">
                        <p class="title1">원산지</p>
                        <select class="filter selectType3" name="snation" id="snation">
                            <option value="0" select>전체</option>
                            <option value="1">국산</option>
                            <option value="2">수입</option>
                        </select>
                    </div>
                    <div class="right flexType2">
                        <p class="title1">재고량</p>
                        <select class="filter selectType3" name="stype" id="stype">
                            <option value="0" select>전체</option>
                            <option value="1" select>재고적음</option>
                            <option value="2">재고충분</option>

                        </select>
                    </div>
                </div>
                <div class="downside flexType3">
                    <div class="left flexType2">
                        <p class="title2">검색창</p>
                        <input class="inputSearch mr10" type="search" name="hnname" id="hnname" placeholder="약재를 검색하세요">
                        <button type="button" class="btnType1" id="btn_search" name="btn_search">검색</button>
                    </div>
                    <button type="button" id="" name="" class="btnType3">엑셀다운</button>
                </div>
            </div>
            <!--            <div class="odrbox1-1-2">-->
            <!--                <button type="button" id="" name="" class="btnType3">엑셀다운</button>-->
            <!--            </div>-->
        </div>

        <table class="merlitable herbListDecTable">
            <thead>
            <tr>
                <td class="merlirow">번호</td>
                <td class="merlirow">약재코드</td>
                <td class="merlirow">약재명</td>
                <td class="merlirow">총 재고량</td>
                <td class="merlirow">적정재고량</td>
                <td class="merlirow">최근 주문량</td>
            </tr>
            </thead>

            <tbody id="stocklist" name="stocklist">
            </tbody>
        </table>

        <div class="moreListBox">
            <button class="moreList" id="more1" name="more1" type="button" data-page="1">
                더보기
            </button>
            <i class="fa-solid fa-angle-down" id="more2" name="more2"></i>
        </div>



</section>

<?= $this->endSection() ?>
