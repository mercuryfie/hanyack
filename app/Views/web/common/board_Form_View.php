<?= $this->extend("/web/template/layout_board") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/board.js"> </script>
<script src="<?=URL_COMMON_ASSETS?>/board_Form_Do.js"> </script>

<?php print_r($body) ?>

<section class="content">
    <form id="boardForm" name="boardForm" method="post">
        <input type="hidden" name="p_uid" id="p_uid" value="<?=$body['uid'];?>" />
        <input type="hidden" name="bid" id="bid" value="<?=$body['env']['bid'];?>" />

        <div class="noti_form_wrap">
            <div class="titleBox b_bottom" id="titi_box" name="titi_box">
                <p class="title"
                    id="title"
                    name="title"
                    data-bid="<?=$body['env']['bid']?>"
                >
                    <?=$body['env']['bname']?>
                </p>
            </div>
                <div class="inq_box1">
                    <p class="title">유형</p>

                    <?if($body['env']['bid']=='1'){?>
                    <select name="btyp" id="notiTypeMethod" class="selectType4">
                        <option value="1" onchange="on_notiTypeMethod('1');">일반</option>
                        <option value="2" onchange="on_notiTypeMethod('2');">공지</option>
                        <option value="3" onchange="on_notiTypeMethod('3');">서버 관련</option>
                        <option value="4" onchange="on_notiTypeMethod('4');">기타</option>
                    </select>
                    <?} else if ($body['env']['bid']=='2') {?>
                    <select name="btyp" id="faqTypeMethod" class="selectType4" >
                        <option value="1" onchange="on_faqTypeMethod('1');">시스템오류</option>
                        <option value="2" onchange="on_faqTypeMethod('2');">주문/배송</option>
                        <option value="3" onchange="on_faqTypeMethod('3');">취소/교환/반품</option>
                        <option value="4" onchange="on_faqTypeMethod('4');">기타</option>
                    </select>
                    <?} else if($body['env']['bid']=='3'){?>
                    <select name="btyp" id="inqTypeMethod" class="selectType4" >
                        <option value="1" onchange="on_inqTypeMethod('1');">시스템오류</option>
                        <option value="2" onchange="on_inqTypeMethod('2');">주문/배송</option>
                        <option value="3" onchange="on_inqTypeMethod('3');">취소/교환/반품</option>
                        <option value="4" onchange="on_inqTypeMethod('4');">기타</option>
                    </select>
                   <?}?>
                </div>
            <div class="inq_box1">
                <p class="title">제목</p>
                <input type="text" name="bTitle" id="bTitle" placeholder="제목을 입력해주세요" class="inputType2"

                       value="">
            </div>
            <div class="inq_box3">
                <p class="title">내용</p>
                <textarea class="" cols="" rows=""
                          placeholder="내용을 입력해주세요"
                          aria-label="" id="bContent"
                          name="bContent"></textarea>
            </div>
            <div class="inq_box4">
                <p class="title"></p>
                <div id="thumbArea" name="thumbArea" class="thum_arange">
                </div>
                <div class="thum_taker_box" id="thum_wrap" name="thum_wrap">
                    <label for="attachedImg" class="photo-picker"
                           data-ext="jpg,jpeg,png,gif">
<!--                        <button type="button" class="thum_taker" id="thum_taker" name="thum_taker" onclick="">-->
<!--                            <i class="fa-solid fa-camera"></i>-->
<!--                        </button>-->
                        <input class=""
                                type="file" name="attachedImg" id="attachedImg"
                               multiple style=""
                                data-ext="jpg,jpeg,png,gif">
                        <i class="fa-solid fa-camera"></i>
                    </label>
                </div>

            </div>

            <div class="desc">
                <p>- 5MB 이미지만 업로드 가능합니다. </p>
                <p>- 사진은 최대 3장까지 등록 가능합니다. </p>
            </div>
            <div class="inq_last_box mb40">
                <button type="button" class="btnType2"
                        onclick="" name="submitBtn" id="submitBtn">등록</button>
            </div>
        </div>
    </form>
</section>

<?= $this->endSection() ?>
