<?= $this->extend("/web/template/layout_mypage_dec") ?>
<?= $this->section("content") ?>


<script src="<?=URL_DECOC_ASSETS?>/herbListDecoc.js?rnd=<?=rand();?>"></script>
<script src="<?=URL_DECOC_ASSETS?>/herbListDecoc_Do.js?rnd=<?=rand();?>"></script>

<script>

</script>
<section class="merright">
    <div class="merright1-0">
    </div>
    <div class="merright1-1">
        <p>필터</p>
        <div class="merli1-1">
            <div class="merli1-1-1">
<!--                <button class="itemFilter">전체보기</button>-->
<!--                <button class="itemFilter">매칭</button>-->
<!--                <button class="itemFilter">미매칭</button>-->

                <label>
                    <input type="radio" name="herbFilter" value="all"  >
                    전체보기
                </label>
                <label>
                    <input type="radio" name="herbFilter" value="matched" checked>
                    매칭약재
                </label>
                <label>
                    <input type="radio" name="herbFilter" value="unmatched">
                    미매칭 약재
                </label>
                <select name="" id="pharli" class="pharmList">
                    <option value="">제약사</option>
                    <option value="">전체</option>
                    <option value="광명당">광명당</option>
                    <option value="대연제약">대연제약</option>
                    <option value="디제이허브">디제이허브</option>
                    <option value="바른한방">바른한방</option>
                    <option value="영천">영천</option>
                    <option value="CJ">CJ</option>
                    <option value="CK">CK</option>
                    <option value="허브팜">허브팜</option>
                </select>

            </div>
            <div class="merli1-1-2">

            </div>
        </div>
    </div>
    <div class="merlibox1-1">
        <p>약재목록</p>
        <div class="submitBox stockSubmitBox">
            <button type="button" id="btn_cancle" name="btn_cancle" class="btnType3">약재등록</button>
            <!--            <button type="button" id="btn_deli" name="btn_deli">입고처리</button>-->
        </div>
        <table class="merlitable herbListDecTable">
            <thead>
                <tr>
                    <td class="merlirow">약재코드</td>
                    <td class="merlirow">매칭여부</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">원산지</td>
                    <td class="merlirow">제약사</td>
                    <td class="merlirow">적정재고</td>

<!--                    <td class="merlirow">재고</td>-->
<!--                    <td class="merlirow">적정재고</td>-->
<!--                    <td class="merlirow">재고율</td>-->
                </tr>
            </thead>

            <?= $this->include("/web/include/pop_Matching_View") ?>
            <tbody id="herblist" name="herblist">
            </tbody>
        </table>

        <div class="moreListBox">
            <button class="moreList" id="more" name="more" type="button" data-page="1">
                더보기
            </button>
            <i class="fa-solid fa-angle-down" id="more2" name="more2"></i>
        </div>

        <div class="authpopcon">
            <div class="authpop">
                <i class="fa-regular fa-circle-question"></i>
                <h2>승인 확인</h2>
                <p>약재를 승인하시겠습니까?</p>
                <div>
                    <button class="closeauth">닫기</button>
                    <button class="allowauth">확인</button>
                </div>
            </div>
            <button class="merliauthbtn">승인하기</button>
        </div>
        <div class="authpopcon">
            <div class="authpop">
                <i class="fa-regular fa-circle-question"></i>
                <h2>승인 확인</h2>
                <p>약재를 승인하시겠습니까?</p>
                <div>
                    <button class="closeauth">닫기</button>
                    <button class="allowauth">확인</button>
                </div>
            </div>
            <button class="merliauthbtn">승인하기</button>
        </div>
    </div>

<!--    <div class="merrightlast">-->
<!--        <button>취소</button>-->
<!--        <button>저장</button>-->
<!--    </div>-->
</section>

<?= $this->include("/web/include/pop_Matching_View") ?>

<?= $this->endSection() ?>
