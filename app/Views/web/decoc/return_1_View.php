<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_DECOC_ASSETS?>/orderListDecoc.js?rnd=<?=rand();?>"></script>
<script src="<?=URL_DECOC_ASSETS?>/orderListDecoc_Do.js?rnd=<?=rand();?>"></script>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<section class="orderlist_dec">
    <!--    <div class="decorderli1-0">-->
    <!--    </div>-->
    <div class="decodr refund_boxtc6">
        <div class="area area1">
            <p class="head_title">반품/교환 접수</p>
        </div>
        <div class="area area2">
            <label for="claim" class="label2">
                <input type="radio" name="claim" id="" checked>반품
            </label>
            <label for="claim" class="label1">
                <input type="radio" name="claim" id="" >교환
            </label>
        </div>
        <div class="area area3 flexCol el_box1od">
            <div class="element element1 flexType2">
                <input type="checkbox" name="" id="" class="mr10" checked>
                <p class="tagType1 mr10">일반</p>
                <p class="hnname mr10">[허브팜] 황기 (황기)</p>
                <p class="option">대/수입/600g</p>
            </div>
            <div class="element element2 flexType2">
                <p class="count">102개</p>
                <p class="price">10,000원</p>
            </div>
            <div class="element element3 flexType2">
                <div class="left flexType3">
                    <i class="fa-solid fa-minus"></i>
                    <p class="count">1</p>
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="right">
                    <p class="msg">(포장단위당 갯수)</p>
                </div>
            </div>
        </div>
        <div class="area area6 el_box2w9 flexType2">
            <p class="title">주문번호</p>
            <p class="odcode">12341234</p>
        </div>
        <div class="area el_boxatq flexType2">
            <p class="title">금액</p>
            <p class="price">10,000원</p>
        </div>
        <!--        <div class="area el_boxatq flexType2">-->
        <!--            <p class="title">탕전실명</p>-->
        <!--            <p class="price">ㅇㅇ탕전실</p>-->
        <!--        </div>-->
        <!--        <div class="area el_boxatq flexType4">-->
        <!--            <p class="title">주소</p>-->
        <!--            <div class="flexCol">-->
        <!--                <input type="search"-->
        <!--                       class="address" name="" id="" placeholder="주소" readonly>-->
        <!--                <input type="search"-->
        <!--                       class="address" name="" id="" placeholder="상세주소" readonly>-->
        <!--            </div>-->
        <!--        </div>-->
        <div class="area area5 el_box2w9 flexType2">
            <p class="title">택배사</p>
            <select name="" id="" class="">
                <option value="">선택</option>
                <option value="">로젠</option>
                <option value="">CJ</option>
                <option value="">기타(직접입력)</option>
            </select>
            <input type="search"
                   class="carrier" name="" id="" placeholder="직접입력">
            <label for="" class="ml10 flexType2" >
                <input type="checkbox" name="" id="" checked class="">
                <p class="colect">착불</p>
            </label>
        </div>
        <div class="area area3 el_box2w9 flexType2">
            <p class="title">송장번호</p>
            <input type="search"
                   class="delicode" name="" id="" placeholder="숫자만 입력하세요">
        </div>
        <div class="area area4 el_box2w9 flexType4">
            <p class="title">상세설명</p>
            <textarea type="search"
                      class="desc" name="" id="" placeholder="상세설명을 입력하세요"></textarea>
        </div>

    </div>
    <div class="decodr refund_boxtc6">
        <button type="button" class="btnType100">다음</button>
    </div>

    <?= $this->include('/web/include/pop_DeliveryStatus_View') ?>
    <?= $this->include('/web/include/pop_CancelOrderDecoc_View') ?>
</section>

<?= $this->endSection() ?>
