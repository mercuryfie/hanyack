<?= $this->extend("/web/template/layout_board") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/board.js"> </script>
<script src="<?=URL_COMMON_ASSETS?>/board_Form_Do.js"> </script>

<?php //print_r($body) ?>

<section class="content">
    <form id="thisForm" method="post" onsubmit="return false">
<!--        <input type="hidden" name="h_uid" id="h_uid" value="--><?php //=$body['uid'];?><!--" />-->
        <input type="hidden" name="method" id="method" />
        <input type="hidden" name="method" id="method" />
        <input type="hidden" name="method" id="method" />
        <input type="hidden" name="buymethod" id="buymethod" value="1" />
        <input type="hidden" name="salemethod" id="salemethod" value="1" />
        <input type="hidden" name="tax" id="tax" value="1" />

        <div class="noti_form_wrap">

            <div class="titleBox b_bottom" id="titi_box" name="titi_box">
                <p
                        class="title"
                        id="title"
                        name="title"
                        data-bid="<?=$body['env']['bid']?>"
                >
                    <?php print_r($body['env']['bid']) ?>

                    <?=$body['env']['bname']?>
                </p>
            </div>
<!--            <div class="titleBox b_bottom">-->
<!--                <p class="title">공지사항</p>-->
<!--            </div>-->
            <div class="inq_box2">
                <p class="title">제목</p>
                <input type="text" name="" id="" placeholder="제목을 입력해주세요" class="inputType2">
            </div>
            <div class="inq_box3">
                <p class="title">내용</p>
                <textarea name="" id="" cols="" rows=""  placeholder="내용을 입력해주세요" aria-label="" id="editor_data" name="editor_data"></textarea>
            </div>
            <div class="inq_box4">
                <p class="title"></p>
                <div id="thumbArea" name="thumbArea" class="thum_arange"></div>
                <div class="thum_taker_box" id="thum_wrap" name="thum_wrap">
                    <label for="attachedFile" class="photo-picker">
                        <button type="button" class="thum_taker" id="thum_taker" name="thum_taker" onclick="">
                            <i class="fa-solid fa-camera"></i>
                        </button>
                        <input type="file" name="attachedFile" id="attachedFile" accept="image/jpg, image/jpeg, image/png, image/bmp" multiple style="display: none;">
                    </label>

                </div>

            </div>

            <div class="desc">
                <p>- 5MB 이미지만 업로드 가능합니다. </p>
                <p>- 사진은 최대 3장까지 등록 가능합니다. </p>
            </div>
            <div class="inq_last_box">
                <button type="button" class="btnType9" onclick="" name="" id="submitBtn">등록</button>
            </div>
        </div>
    </form>
</section>

<?= $this->endSection() ?>
