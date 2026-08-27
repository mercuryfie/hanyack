<?= $this->extend('/web/template/layout_default') ?>
<?= $this->section('content') ?>


<script src="<?=URL_COMMON_ASSETS?>/login.js?rnd=<?=rand();?>"></script>
<script src="<?=URL_COMMON_ASSETS?>/login_Do.js?rnd=<?=rand();?>"></script>
<input type="hidden" id="redirect_url" value="<?= $main['rec_url'] ?>">
<section class="login">
    <div class="login_wrap">

        <p class="main_title">로그인</p>
        <div class="login_con id_con">

            <input type="text" class="idinput" id='userid' placeholder="아이디" value="<?=$main['saveid'];?>">

            <button type="button" class="clearBtn id_clear" data-target="#userid">
                <i class="fa-solid fa-xmark"></i>
            </button>
<!--            <button type="button" class="clearBtn id_clear">-->
<!--                <i class="fa-solid fa-xmark"></i>-->
<!--            </button>-->
            <!--        <span class="clearbtn">-->
            <!--            <i class="fa-solid fa-x"></i>-->
            <!--        </span>-->
        </div>
        <div class="login_con pw_con">
            <input
                    type="password"
                    class="pwinput"
                    id="passwd"
                    placeholder="비밀번호"
            >

            <div class="btn_box flexType2">

                <button type="button" class="pw_toggle mr10" aria-label="비밀번호 보기">
                    <i class="fa-solid fa-eye-slash"></i>
                </button>
                <button type="button" class="clearBtn pw_clear" data-target="#passwd">
                    <i class="fa-solid fa-xmark"></i>
                </button>
<!--                <button type="button" class="pw_clear " aria-label="비밀번호 지우기">-->
<!--                    <i class="fa-solid fa-xmark"></i>-->
<!--                </button>-->


            </div>
        </div>
        <!--    <div class="inputcon">-->
        <!--        <input type="search" class="pwinput" id='passwd' placeholder="비밀번호">-->
        <!--        <span class="clearbtn">-->
        <!--            <i class="fa-solid fa-x"></i>-->
        <!--        </span>-->
        <!--    </div>-->
        <button type="submit" id="btn_login" onclick="Login_Do();" class="btnLogin">로그인</button>
        <div class="autoLogin flexType1">
            <div class="area area1 mr20 flexType2">
                <?if($main['saveid']==''):?>
                    <input type="checkbox" name="saveid" id="saveid1">
                <?else:?>
                    <input type="checkbox" name="saveid" id="saveid2" checked>
                <?endif?>
                <label for="">아이디 저장</label>
            </div>
            <input type="checkbox" name="autolg" id="autolg">
            <label for="">자동 로그인</label>
        </div>
    </div>
</section>



<?= $this->endSection() ?>


