A<?= $this->extend("/web/template/layout_board") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/board.js"> </script>

<?php print_r($body)?>

<section class="content">
    <div class="inq_form_box">
        <div class="titleBox b_bottom">
            <p class="title">1:1 문의</p>
        </div>
    <?if($body['mitype']=='master'){?>
        <div class="inq_box1">
            <p class="title">문의 제목</p>
            <p class=""><?=$body['content']['bTitle']?></p>
        </div>
        <div class="inq_box1 inq_box_scroll">
            <p class="title">문의 내용</p>
            <p class="bContent"><?=$body['content']['bContent']?></p>
        </div>
    <?}?>
    <?if($body['mitype'] != 'master'){?>
        <div class="inq_box1">
            <p class="title">유형</p>
            <select name="" id="" class="selectType4">
                <option value="1">취소/교환/반품</option>
                <option value="2">주문/배송</option>
                <option value="3">회원/쿠폰</option>
                <option value="4">서비스/오류</option>
                <option value="5">기타</option>
            </select>
        </div>
        <div class="inq_box1">
            <p class="title">제목</p>
            <input type="text" name="" id="" placeholder="제목을 입력해주세요" class="inputType2">
        </div>
    <?}?>
        <div class="inq_box3">
            <p class="title">내용</p>
            <textarea name="" id=""
                      class="text" cols="" rows=""
                      placeholder="내용을 입력해주세요" aria-label="textarea-message"></textarea>
        </div>
        <div class="inq_box4">
            <p class="title"></p>
            <div class="thumBox">
                <img src="/assets/web/src/sanyack.jpg" alt="img">
                <button type="button" class="delete-btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="thumBox">
                <img src="/assets/web/src/sanyack.jpg" alt="img">
                <button type="button" class="delete-btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="thum_taker_box">
                <label for="photo-picker" class="photo-picker">
                    <button type="button" class="thum_taker">
                        <i class="fa-solid fa-camera"></i>
                    </button>
                    <input type="file" name="" id="" accept="image/jpg, image/jpeg, image/png, image/bmp" multiple>
                </label>

            </div>

        </div>

        <div class="desc">
            <p>- 50MB 이미지만 업로드 가능합니다. </p>
            <p>- 사진은 최대 3장까지 등록 가능합니다. </p>
        </div>
        <div class="inq_last_box">
            <button type="button" class="btnType9" onclick="">등록</button>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
