<?= $this->extend('/web/template/layout_none') ?>
<?= $this->section('content') ?>


<!--<script src="--><?php //=URL_COMMON_ASSETS?><!--/login.js?rnd=--><?php //=rand();?><!--"></script>-->
<script src="<?=URL_COMMON_ASSETS?>/join_Do.js?rnd=<?=rand();?>"></script>
<input type="hidden" id="redirect_url" value="<?= $main['rec_url'] ?>">
<section class="join_contents">
    <div class="join_wrap">

        <i class="fa-solid fa-xmark" id="Xbtn"></i>
        <div class="area area1 flexType1">
            <img class="logo" src="/assets/web/src/logo_default.png" alt="img" onclick="go_main();">
        </div>

        <div class="area area2 flexCol2">
            <div class="data_box flexType2">
                <p class="cat">아이디</p>
                <input type="search" name="" id="" class="input_type " placeholder="업체명을 입력하십시오.">
            </div>
            <div class="data_box flexType2">
                <p class="cat">비밀번호</p>
                <input type="password" name="" id="" class="input_type " placeholder="업체명을 입력하십시오.">
            </div>
            <div class="data_box flexType2">
                <p class="cat">회사명</p>
                <input type="search" name="" id="" class="input_type " placeholder="업체명을 입력하십시오.">
            </div>
            <div class="data_box flexType2">
                <p class="cat">대표자명</p>
                <input type="search" name="" id="" class="input_type " placeholder="업체명을 입력하십시오.">
            </div>
            <div class="data_box flexType2">
                <p class="cat">연락처</p>
                <input type="search" name="" id="" class="input_type " placeholder="업체명을 입력하십시오.">
            </div>
            <div class="data_box flexType2 mb20">
                <p class="cat">사업자번호</p>

                <div class="wrap_div flexType3">
                    <input type="search" class="input_type typ2 " id="ve_no1">
                    <p class="dash">-</p>
                    <input type="search" class="input_type typ2" id="ve_no2">
                    <p class="dash">-</p>
                    <input type="search" class="input_type typ2" id="ve_no3">
                </div>
<!--                <input type="file" name="" id="" class="input_type " placeholder="업체명을 입력하십시오.">-->
            </div>

            <div class="data_box flexType2-1">
                <p class="cat">사업자등록증</p>

                <div class="file_box flexCol">
                    <input type="file" id="businessFile" class="file_input">

                    <label for="businessFile" class="file_btn">
                        파일 선택
                    </label>

                    <span id="businessFileName" class="file_name">
                    선택된 파일 없음
                </span>
                </div>
            </div>

            <div class="btn_box flexCol2">
                <button type="submit" id=" " onclick="Login_Do();" class="btn_join">회원가입</button>
                <p class="msg">
                    *회원가입은 약 2-3일 이내 승인됩니다.
                </p>
            </div>
        </div>


        <div class="area flexCol">
        </div>
    </div>
</section>



<?= $this->endSection() ?>


