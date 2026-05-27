<?= $this->extend("/web/template/layout_mypage_dj") ?>
<?= $this->section("content") ?>
<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
<!-- js ----------------------------  -->
<script src="<?=URL_MASTER_ASSETS?>/burkOrderForm_Do.js?rnd=<?= rand(); ?>"></script>
<script>
</script>
<?php //print_r($body)?>

    <section class="merright">
        <div class="merright1-0">

        </div>

        <div class="rightBox  burkOrderForm_wrap">
            <div class="firstBox">
                <div class="head_title flexStart">
                    <p class="title">대량 주문</p>

                </div>
                <div class="infobox">
                    <div class="merinfo ">
                        <p class="title">약재검색</p>
                        <div class="herbbox">
                            <div class="herbbtn1-1 flexType3">
                                <input type="search" class="searchInput" id="txtHD" name="txtHD" placeholder="검색어 입력 후, 엔터를 누르세요." onfocus="ini_Form1();">
                                <button class="herbtoggle" type="button">
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                            </div>
                            <div class="herbbtn1-2" id="HD_List">
                            </div>
                        </div>
                    </div>
                    <div class="merinfo " >
                        <p class="title">제약사</p>
                        <p class="data" id="miname"></p>
                    </div>
                    <div class="merinfo " >
                        <p class="title">본초명</p>
                        <p class="data" id="mdname"></p>
                    </div>
                    <div class="merinfo ">
                        <p class="title">약재명</p>
                        <p class="data" id="hnname"></p>
                    </div>
                    <div class="merinfo ">
                        <p class="title">구분/가공방법</p>
                        <p class="data" id="option"></p>
                    </div>
                    <div class="merinfo " >
                        <p class="title">제조번호</p>
                        <p class="data" id="hnnumber"></p>
                    </div>
                    <div class="merinfo " >
                        <p class="title">제조일자</p>
                        <p class="data" id="makedate"></p>
                    </div>
                    <div class="merinfo " >
                        <p class="title">유통기한</p>
                        <p class="data" id="selledate"></p>
                    </div>
                    <div class="merinfo ">
                        <p class="title">원산지</p>
                        <p class="data" id="nation"></p>
                    </div>
                    <div class="merinfo ">
                        <p class="title">포장단위</p>
                        <p class="data" id="option2"></p>
                    </div>
                    <div class="merinfo ">
                        <p class="title">원포장단위가격</p>
                        <p class="data" id="gPrice"></p>
                    </div>
                    <div class="merinfo ">
                        <p class="title">탕전실</p>
                        <select name="micode" id="micode">
                            <?= $body['d_list']; ?>
                        </select>
                    </div>
<!--                    <div class="merinfo ">-->
<!--                        <p class="title">매칭약재</p>-->
<!--                        <p class="data"></p>-->
<!--                    </div>-->
                    <div class="merinfo ">
                        <p class="title">포장단위가격</p>
                        <input type="number" name="txtpPrice" id="txtpPrice" class="inputType240" placeholder="숫자만 입력" oninput="if(this.value.length > 8) this.value = this.value.slice(0,8);">
                        <p class="unit">원</p>
                    </div>
                    <div class="merinfo ">
                        <p class="title">총 박스 수</p>
                        <input type="number" name="txttBox" id="txttBox" class="inputType240" placeholder="숫자만 입력" oninput="if(this.value.length > 4) this.value = this.value.slice(0,4);">
                        <p class="unit">Box</p>
                    </div>
                </div>
            </div>
            <div class="secondBox">
            </div>
            <div class="lastBox">
                <button type="button" class="btnType3">취소</button>
                <button type="button" id="submitBtn" name="submitBtn" class="btnType4" data-hncode="" data-boxcnt="" data-wicode="">확인</button>
            </div>
    </section>

<?= $this->endSection() ?>