<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/claimList_Do.js?rnd=<?=rand();?>"></script>

<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>

<section class="orderlist_dec">
    <!--    <div class="decorderli1-0">-->
    <!--    </div>-->
    <div class="common_list_wrap clp_wrap">
        <div class="area area1">
            <p class="main_title">취소·반품 내역</p>

        </div>
        <div class="area area2">
            <div class="flexType3">
                <div class="left flexType2">
                    <input type="search" name="" id="" class="input_type"
                           placeholder="약재명을 검색하십시오.">
                    <button class="btnType32 ">조회하기</button>
                </div>
                <div class="right">
                    <button class="btnType32 active mr5">전체</button>
                    <button class="btnType32 mr5">취소</button>
                    <button class="btnType32 mr5">반품</button>
                    <button class="btnType32 mr5">교환</button>
                    <select name="" id="pharli" class="select_type">
                        <option value="">제약사</option>
                        <option value="">전체</option>
                        <option value="광명당">광명당</option>
                        <option value="대연제약">대연제약</option>
                        <option value="디제이허브">디제이허브</option>
                        <option value="바른한방">바른한방</option>
                        <option value="영천">영천</option>
                        <option value="CJ">CJ</option>
                        <option value="CK">CK</option>
                        <option value="허브팜">허브팜dd</option>
                    </select>
                </div>

            </div>

        </div>
        <div class="area area3">
            <table class="common_table" id="" name="">
                <thead>
                <tr>
                    <th>hello</th>
                    <th>hello</th>
                    <th>hello</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?= $this->include('/web/include/pop_DeliveryStatus_View') ?>
    <?= $this->include('/web/include/pop_CancelOrderDecoc_View') ?>
</section>

<?= $this->endSection() ?>
