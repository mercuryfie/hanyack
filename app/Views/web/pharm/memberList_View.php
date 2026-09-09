<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>

<script src="<?=URL_PHARM_ASSETS?>/memberList_Do.js?rnd=<?=rand();?>"></script>

<section class="orderlist_dec">
    <!--    <div class="decorderli1-0">-->
    <!--    </div>-->
    <div class="common_list_wrap mlp_wrap">
        <div class="area area1">
            <p class="main_title">회원 목록</p>

        </div>
        <div class="area area2">
            <div class="flexType3">
                <div class="right">
                    <select name="" id="pharli" class="select_type">
                        <option value="">전체</option>
                        <option value="승인">승인</option>
                        <option value="미승인">미승인</option>
                    </select>
                </div>
                <div class="left flexType2">
                    <input type="search" name="" id="" class="input_type"
                           placeholder="ID 혹은 업체명을 검색하십시오.">
                    <button class="btnType32 ">조회하기</button>
                </div>

            </div>

        </div>
        <div class="area area3">
            <table class="common_table mlp_tbl" id="" name="">
                <thead>
                <tr>
                    <th class="row bu_id">ID</th>
                    <th class="row bu_name">회사명</th>
                    <th>대표자명</th>
                    <th>연락처</th>
                    <th>사업자번호</th>
                    <th>사업장등록증</th>
                    <th>상태</th>
                    <th>승인</th>
                </tr>
                </thead>
                <tbody id="" name="">
                <tr>
                    <td>hello</td>
                    <td>hello</td>
                    <td>Jogn Doe</td>
                    <td>010-1234-1234</td>
                    <td>123-12-12345</td>
                    <td>hello</td>
                    <td>
                        <p class="status">승인</p>
                    </td>
                    <td>
                        <button type="button" class="btnType32" id="" name="">승인하기</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?= $this->include('/web/include/pop_DeliveryStatus_View') ?>
    <?= $this->include('/web/include/pop_CancelOrderDecoc_View') ?>
</section>

<?= $this->endSection() ?>
