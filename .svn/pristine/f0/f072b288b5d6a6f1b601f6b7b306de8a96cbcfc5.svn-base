<?= $this->extend("/web/template/layout_board") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/board.js"> </script>
<script src="<?=URL_COMMON_ASSETS?>/board_editForm_Do.js"> </script>
<?= $body['bContent']['bcode']?>
<?php //print_r($body) ?>
<?php //= isset($body['att'][0]['fname']) ? $body['att'][0]['fname'] : '';?>
<?php //print_r ($body['att'][0]['fname'])?($body['att'][0]['fname']):''; ?>
<?php //print_r($body['bContent']) ?>

<section class="content">
    <form id="boardForm" name="boardForm" method="post">
        <input type="hidden" name="b_uid" id="b_uid" value="<?=$body['uid'];?>" />
        <input type="hidden" name="bid" id="bid" value="<?=$body['env']['bid'];?>" />
        <input type="hidden" name="bcode" id="bcode" value="<?=$body['bContent']['bcode'];?>" />

<!--        <input type="hidden" name="bcode" id="bcode" value="--><?php //=$body['bContent']['bcode'];?><!--" />-->

        <div class="noti_form_wrap formWrap">
            <div class="titleBox b_bottom" id="titi_box" name="titi_box">
                <p class="title"
                    id="title"
                    name="title"
                   data-mitype="<?= $body['mitype']?>"
                    data-bid="<?=$body['env']['bid']?>"
                   data-bcode="<?= $body['bContent']['bcode']?>"
                >
                    <?=$body['env']['bname']?>
                </p>
            </div>
            <div class="inq_box1">
                <p class="title">유형</p>

                <?if($body['env']['bid']=='1'){?>
                <select name="btyp" id="notiTypeMethod" class="selectType4">
                    <option value="1" <?if($body['bContent']['btyp']==1) echo('selected');?>>일반</option>
                    <option value="2" <?if($body['bContent']['btyp']==2) echo('selected');?>>공지</option>
                    <option value="3" <?if($body['bContent']['btyp']==3) echo('selected');?>>서버 관련</option>
                    <option value="4" <?if($body['bContent']['btyp']==4) echo('selected');?>>기타</option>
<!--                        <option value="1" onchange="on_notiTypeMethod('1');">일반</option>-->
<!--                        <option value="2" onchange="on_notiTypeMethod('2');">공지</option>-->
<!--                        <option value="3" onchange="on_notiTypeMethod('3');">서버 관련</option>-->
<!--                        <option value="4" onchange="on_notiTypeMethod('4');">기타</option>-->
                </select>
                <?} else if ($body['env']['bid']=='2') {?>
                <select name="btyp" id="faqTypeMethod" class="selectType4" >
                    <option value="1" <?if($body['bContent']['btyp']==1) echo('selected');?>>시스템오류</option>
                    <option value="2" <?if($body['bContent']['btyp']==2) echo('selected');?>>주문/배송</option>
                    <option value="3" <?if($body['bContent']['btyp']==3) echo('selected');?>>취소/교환/반품</option>
                    <option value="4" <?if($body['bContent']['btyp']==4) echo('selected');?>>기타</option>
                </select>
                <?} else if($body['env']['bid']=='3'){?>
                <select name="btyp" id="inqTypeMethod" class="selectType4" >
                    <option value="1" <?if($body['bContent']['btyp']==1) echo('selected');?>>시스템오류</option>
                    <option value="2" <?if($body['bContent']['btyp']==2) echo('selected');?>>주문/배송</option>
                    <option value="3" <?if($body['bContent']['btyp']==3) echo('selected');?>>취소/교환/반품</option>
                    <option value="4" <?if($body['bContent']['btyp']==4) echo('selected');?>>기타</option>
                </select>
               <?}?>
            </div>
            <div class="inq_box1 flexCol"
                id="inqContentBox" name="inqContentBox">
<!--                <p>hellooo</p> -->


            </div>
            <div class="inq_box1">
                <p class="title">제목</p>
                <input type="text" name="bTitle" id="bTitle"
                       class="inputType2"
                       value="<?= isset($body['bContent']['bTitle']) ?
                           $body['bContent']['bTitle'] : '' ?>">
            </div>
            <div class="inq_box3">
                <p class="title">내용</p>
                <textarea class="" cols="" rows=""
                          aria-label="" id="bContent"
                          name="bContent"><?= isset($body['bContent']['bContent']) ? trim($body['bContent']['bContent']) : '' ?></textarea>
            </div>
            <!--            --><?//if($body['mitype']!='master'){?>
            <!--            --><?//if($body['env']['bid']!='3'){?>
            <!--            --><?//} else {?>
            <!--            --><?//}?>
            <div class="inq_box4">
                <p class="title"></p>

                <div id="thumbArea" name="thumbArea" class="thum_arange">
                    <?if (isset($body['att'][0]['fname'])) {?>
                        <div class="thumCon flexType2" id="" name="">
                            <?php if (isset($body['att']) && is_array($body['att'])) { // 'att' 배열이 존재하는지 확인 ?>
                                <?php foreach ($body['att'] as $index => $attachment) { // 각 첨부파일을 반복 ?>
                                    <?php if (isset($attachment['fname']) && isset($attachment['path'])) { ?>
                                        <div class="thumBox" name="thumPreview" data-file-id="<?= $attachment['file_id'] ?? '' ?>">
                                            <img src="<?= $attachment['path'] ?>/<?= $attachment['fname'] ?>" alt="img" class="addedImg">
                                            <button type="button" class="delete-btn"
                                                    name="delImg"
                                                    data-type="existing">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
<!--                            <div class="thumBox " name="thumPreview">-->
<!---->
<!--                                <img src="--><?php //=$body['att'][0]['path']?><!--/--><?php //=$body['att'][0]['fname']?><!--"-->
<!--                                     alt="img" class="addedImg">-->
<!--                                <button class="delete-btn" type="button" id="deleteBtn" name="deleteBtn">-->
<!--                                    <i class="fa-solid fa-xmark"></i>-->
<!--                                </button>-->
<!--                            </div>-->
                        </div>
                    <?}?>
                </div>
                <label for="attachedImg" class="photo-picker"
                       data-ext="jpg,jpeg,png,gif">
                    <!--                        <button type="button" class="thum_taker" id="thum_taker" name="thum_taker" onclick="">-->
                    <!--                            <i class="fa-solid fa-camera"></i>-->
                    <!--                        </button>-->
                    <input class="" ref={fileRef}
                           type="file" name="attachedImg" id="attachedImg"
                           multiple style=""
                           data-ext="jpg,jpeg,png,gif"
                           onChange={this.handleFileOnChange}
                           accept="image/*">
                    <i class="fa-solid fa-camera"></i>
                </label>
<!--                <div id="thumbArea" name="thumbArea" class="thum_arange">-->
<!--                    --><?//if($body['att'][0]['fname']!=''){?>
<!--                        <div class="thumCon" id="orgImageView" name="orgImageView">-->
<!--                            <div class="thumBox" name="thumPreview">-->
<!--                                <button class="delete-btn" type="button" id="deleteBtn" name="deleteBtn">-->
<!--                                    <i class="fa-solid fa-xmark"></i>-->
<!--                                </button>-->
<!--                                <img src="--><?php //=$body['att'][0]['path']?><!--/--><?php //=$body['att'][0]['fname']?><!--"-->
<!--                                     alt="img" class="addedImg"-->
<!--                                    id="attachImg" name="attachImg">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    --><?//}?>

<!--                </div> -->

            </div>

            <div class="desc">
                <p>- 5MB 이미지만 업로드 가능합니다. </p>
                <p>- 사진은 최대 3장까지 등록 가능합니다. </p>
            </div>
            <div class="inq_last_box mb40">
                <button type="button" class="btnType99 mr10"
                        data-bid="<?= $body['bContent']['bid']?>"
                        data-bcode="<?= $body['bContent']['bcode']?>"
                        onclick="" name="subbitDel" id="subbitDel">삭제</button>
                <button type="button" class="btnType9"
                        onclick="" name="submitBtn" id="submitBtn">등록</button>
            </div>
        </div>
    </form>
</section>

<?= $this->endSection() ?>
