<?= $this->extend("/web/template/layout_default") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/mainList_Do.js?rnd=<?=rand();?>"> </script>
<input type="hidden" id="l_typ" name="l_typ" value="<?=$body['typ']?>" >
<section class="mainbanner ">
    <div class="mainListWrap">

        <!--    <div class="resultBox">-->
        <!--        <p>hello</p>-->
        <!--    </div>-->
        <div class="viewBox flexType3">
            <p class="resultText" id="r_txt" name="r_txt"></p>

            <div class="viewFilter flexType2">
                <i class="fa-solid fa-border-all" onclick="go_productList(1);"></i>
                <i class="fa-solid fa-list" onclick="go_productList(2);"></i>
            </div>
        </div>
        <div class="smartcon6">
            <div class="viewChecked">
                <div class="filterBox">
                    <label for="view" class="view mr10">
                        <input type="checkbox" name="show_checked" id="show_checked" class="inputType1 mr10"> 선택항목 보기

                    </label>
                    <select  name="ptyp" id="ptyp" class="inputType120 mr10" >
                        <option value="">구매방법</option>
                        <option value="100">전체</option>
                        <option value="1">일반구매</option>
                        <option value="2">정기구매</option>
                    </select>
                    <select name="pharm" id="pharm" class="inputType120 mr10">
                        <option value="">제약사</option>
                        <?=$body['option'];?>
                    </select>
                </div>

                <div class="orderBox flexType1">
                    <p class="price mr10" id="totalprice" name="totalprice" data-tprice="0">총 0 원</p>
                    <button type="button" class="btnType32" onclick="go_productList('2')">
                        <i class="fa-solid fa-rotate-right"></i>
                    </button>
                    <button type="button" class="btnType3" id="cart_reg" name="cart_reg">카트 담기</button>
                    <button type="button" class="btnType4"  id="order_reg" name="order_reg">바로 주문</button>
                </div>
            </div>
        </div>
        <div class="smartcon5">
            <div class="sotablebox">
                <table class="sotable">
                    <thead>
                    <tr class="">
                        <td class="socol1 scidx1-1">
                            <input type="checkbox" class="column-1" >
                        </td>
                        <td class="socol1 herbName">약재명
                        </td>
                        <td class="socol1 scidx1-3">제약사</td>
                        <td class="socol1 scidx1-6">원산지</td>

                        <td class="socol1 scidx1-7">구분</td>
                        <td class="socol1 scidx1-8">가공방법</td>
                        <td class="socol1 scidx1-8">포장단위</td>
                        <td class="socol1 scidx1-8">구매타입</td>
                        <td class="socol1 scidx1-12">
                            <div class="buyingInfo">
                                <p class="category">구매정보</p>
                                <div class="subCategory flexType1">
                                    <p class="buyType">구독기간</p>
                                    <p class="buyType">근당가격</p>
                                    <p class="buyType">포장가격</p>
                                </div>
                            </div>
                        </td>

                        <td class="socol1 scidx1-3">시세</td>
                        <td class="socol1 scidx1-13">재고</td>
                        <td class="socol1 scidx1-14">적정재고</td>
                        <td class="socol1 scidx1-15">평균사용량</td>
                        <td class="socol1 scidx1-16">추천수량</td>
                        <td class="socol1 scidx1-10">박스당수량</td>

                        <td class="socol1 scidx1-10">박스수량</td>
                        <td class="socol1 scidx1-10">구매수량</td>
                    </tr>
                    </thead>
                    <tbody id="selllist" name="selllist">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="more_box flexType1" type="button" name="more" id="more">
            <button class="moreList" id="btnmore1" name="btnmore1" type="button" data-page="<?=$body['page']?>">
                더보기
            </button>
            <i class="fa-solid fa-angle-down" id="more2" name="btnmore2" data-page="<?=$body['page']?>"></i>
        </div>
    </div>
</section>
<?= $this->include("/web/include/pop_Cart_View") ?>
<?= $this->include("/web/include/pop_Order_View") ?>
<?= $this->endSection() ?>
