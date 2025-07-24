<?= $this->extend('/web/template/layout_default') ?>
<?= $this->section('content') ?>


<script src="<?=URL_COMMON_ASSETS?>/login.js?rnd=<?=rand();?>"></script>
<script src="<?=URL_COMMON_ASSETS?>/login_Do.js?rnd=<?=rand();?>"></script>

<section class="login">
    <p>로그인</p>
    <div class="inputcon">
        <input type="text" class="idinput" id='userid' placeholder="아이디" value="<?=$main['saveid'];?>">
        <span class="clearbtn">
            <i class="fa-solid fa-x"></i>
        </span>
    </div>
    <div class="inputcon">
        <input type="password" class="pwinput" id='passwd' placeholder="비밀번호">
        <span class="clearbtn">
            <i class="fa-solid fa-x"></i>
        </span>
    </div>
    <button type="submit" id="btn_login" onclick="Login_Do();">로그인</button>
    <div class="autoLogin flexType">
        <?if($main['saveid']==''):?>
        <input type="checkbox" name="saveid" id="saveid1">
        <?else:?>
        <input type="checkbox" name="saveid" id="saveid2" checked>
        <?endif?>
        <label for="">아이디 저장</label>
        <input type="checkbox" name="autolg" id="autolg">
        <label for="">자동 로그인</label>
    </div>
</section>



<?= $this->endSection() ?>


