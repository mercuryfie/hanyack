<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
crossorigin="anonymous" referrerPolicy="no-referrer" />

<script src="<?=URL_DECOC_ASSETS?>/smartOrder.js?rnd=<?echo(rand()); ?>"> </script>
<script src="<?=URL_DECOC_ASSETS?>/smartOrder_Do.js?rnd=<?echo(rand()); ?>"> </script>
<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<section class="smartOrder">
      <div class="smartwrap">
        <div class="smartcon3">
            <p class="smart_head_title">스마트 오더 목록</p>

          <div class="scbtnbox">
              <div class="btnon btnli1 flexType2">
                  <!--                <div class="so_herb_search">-->
                  <!--                    <div class="searchBox">-->
                  <!--                        <input type="search" name="" id="ipSearch" placeholder="약재명을 검색하십시오" class="inputType2">-->
                  <!--                        <i class="fa-solid fa-magnifying-glass searchbtn"></i>-->
                  <!---->
                  <!--                    </div>-->
                  <!--                </div>-->
            </div>
            <div class="btnli2 flexType3">

                <!--                <select name="" id="originli" class="filter">-->
                <!--                    <option value="">전체</option>-->
                <!--                    <option value="국산">국산</option>-->
                <!--                    <option value="수입">수입</option>-->
                <!--                </select>-->
                <!--                <select name="" id="pharli" class="filter mr10">-->
                <!--                    <option value="">제약사</option>-->
                <!--                    <option value="">전체</option>-->
                <!--                    <option value="광명당">광명당</option>-->
                <!--                    <option value="대연제약">대연제약</option>-->
                <!--                    <option value="디제이허브">디제이허브</option>-->
                <!--                    <option value="바른한방">바른한방</option>-->
                <!--                    <option value="영천">영천</option>-->
                <!--                    <option value="CJ">CJ</option>-->
                <!--                    <option value="CK">CK</option>-->
                <!--                    <option value="허브팜">허브팜</option>-->
                <!--                </select>-->
                <!--                <select name="" id="orderli" class="filter">-->
                <!--                    <option value="">판매량순</option>-->
                <!--                    <option value="저가순">저가순</option>-->
                <!--                    <option value="고가순">고가순</option>-->
                <!--                </select>-->
                <!--                <div class="menu">-->
                <!--                    <button>전체</button>-->
                <!--                    <button>인기</button>-->
                <!--                    <button>최신</button>-->
                <!--                </div>-->
                <div class="left">
                    <button type="button" id="" name="" class="filterType1 active">30개</button>
                    <button type="button" id="" name="" class="filterType1 ">50개</button>
                    <button type="button" id="" name="" class="filterType1">100개</button>
                </div>
                <div class="right">
                    <button type="button" id="" name="" class="filterType1">저가순</button>
                    <button type="button" id="" name="" class="filterType1">고가순</button>
                </div>
                <!--              <button type="button" id="selectView" name="selectView" class="btnType1">선택보기</button>-->
                <!--              <button type="button" id="AllView" name="AllView" class="btnType1">선택해제</button>-->
            </div>
          </div>

        </div>
        <?= $this->include("/web/include/pop_Matching_View") ?>
        <?= $this->include("/web/include/pop_Matching2_View") ?>
        <?= $this->include("/web/include/pop_Price_View") ?>
        <?= $this->include("/web/include/pop_ConfirmOrder_View") ?>

        <div class="smartcon5">
            <div class="sotablebox">
                <table class="sotable">
                    <thead>
                    <tr class="">
                        <td class="socol1 scidx1-1">
                            <input type="checkbox" class="column-1">
                        </td>
                        <td class="socol1 scidx1-2">약재코드</td>
                        <td class="socol1 scidx1-4">약재명</td>
                        <td class="socol1 scidx1-2">매칭여부</td>
                        <td class="socol1 scidx1-5">추천</td>
                        <td class="socol1 scidx1-3">제약사</td>

                        <td class="socol1 scidx1-6">원산지</td>
                        <td class="socol1 scidx1-7">구분</td>
                        <td class="socol1 scidx1-8">가공방법</td>
                        <td class="socol1 scidx1-9">포장단위(g)</td>
                        <td class="socol1 scidx1-9">구매방법</td>
                        <td class="socol1 scidx1-10">근당가격</td>
                        <td class="socol1 scidx1-12">포장가격</td>
                        <td class="socol1 scidx1-11">수량</td>

                        <td class="socol1 scidx1-13">재고</td>
                        <td class="socol1 scidx1-14">적정재고</td>
                        <td class="socol1 scidx1-15">평균사용량</td>

                        <td class="socol1 scidx1-16">추천수량</td>
                    </tr>
                    </thead>
                    <tbody id="selllist" name="selllist">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="page_box">
            <button type="button">
                <i class="fa-solid fa-angles-left"></i>
            </button>
            <button type="button">1</button>
            <button type="button">1</button>
            <button type="button">1</button>
            <button type="button">
                <i class="fa-solid fa-angles-right"></i>
            </button>
        </div>
        <div class="smartcon4">
          <div class="scon4-1">
            <p id="totalprice" data-tprice="0">총 0원</p>
          </div>
          <div class="scon4-2">
            <button class="addcart" type="button" onclick="go_cart();">장바구니 담기</button>
            <button class="ordernow" type="button" id="order_reg" name="order_reg">바로 주문하기</button>
          </div>

          <div class="gunpop cartpopcon">
              <div class="cartpop">
                  <i class="fa-regular fa-circle-check"></i>
                  <h2>담기 완료!</h2>
                  <p>상품을 장바구니에 담았습니다</p>
                  <div>
                      <button class="closecart" onclick="go_smart();">닫기</button>
                      <button class="opencart" onclick="go_cart()">장바구니 보기</button>
                  </div>
              </div>
          </div>
          <div class="gunpop orderpopcon" id="endOrder" name="endOrder">
              <div class="orderpop">
                  <i class="fa-regular fa-circle-check"></i>
                  <h2>주문 완료!</h2>
                  <p>상품이 주문되었습니다</p>
                  <div>
                      <button class="closegun closeorder"
                              type="button"
                              id="btnclose" name="btnclose" onclick="go_smart();">닫기</button>
                      <button class="openorderli"
                              id="btnorder" name="btnorder"
                              type="button" data-odcode=""
                              onclick="">주문내역 보기</button>
                  </div>
              </div>
          </div>
        </div>
        <div class="smartcon5"></div>
        <div class="smartcon6"></div>
      </div>
    </section>

<?= $this->endSection() ?>
