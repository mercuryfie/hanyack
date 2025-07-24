<?= $this->extend("/web/template/layout_board") ?>
<?= $this->section("content") ?>

<!--<script src="--><?php //=URL_COMMON_ASSETS?><!--/board.js"> </script>-->
<script src="<?=URL_COMMON_ASSETS?>/board_replyForm_Do.js"> </script>

<?php print_r($body['env']['bid']) ?>
<?php print_r($body['bContent']['bcode']) ?>
<?php //= isset($body['att'][0]['fname']) ? $body['att'][0]['fname'] : '';?>
<?php //print_r ($body['att'][0]['fname'])?($body['att'][0]['fname']):''; ?>
<?php //print_r($body['bContent']) ?>

<section class="content">
    <form id="boardForm" name="boardForm" method="post">
        <input type="hidden" name="p_uid" id="p_uid" value="<?=$body['uid'];?>" />
        <input type="hidden" name="bid" id="bid" value="<?=$body['env']['bid'];?>" />
        <input type="hidden" name="bcode" id="bcode" value="<?=$body['bContent']['bcode'];?>" />

        <div class="noti_form_wrap replyFormWrap formWrap flexCol">
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
                <button id="hello">hello</button>
            </div>
            <div class="inq_box1">
                <p class="title">유형</p>

                <?if($body['env']['bid']=='1'){?>
                <select name="btyp" id="notiTypeMethod" class="selectType4" disabled>
                    <option value="1" <?if($body['bContent']['btyp']==1) echo('selected');?> disabled>일반</option>
                    <option value="2" <?if($body['bContent']['btyp']==2) echo('selected');?>>공지</option>
                    <option value="3" <?if($body['bContent']['btyp']==3) echo('selected');?>>서버 관련</option>
                    <option value="4" <?if($body['bContent']['btyp']==4) echo('selected');?>>기타</option>
<!--                        <option value="1" onchange="on_notiTypeMethod('1');">일반</option>-->
<!--                        <option value="2" onchange="on_notiTypeMethod('2');">공지</option>-->
<!--                        <option value="3" onchange="on_notiTypeMethod('3');">서버 관련</option>-->
<!--                        <option value="4" onchange="on_notiTypeMethod('4');">기타</option>-->
                </select>
                <?} else if ($body['env']['bid']=='2') {?>
                <select name="btyp" id="faqTypeMethod" class="selectType4"  disabled>
                    <option value="1" <?if($body['bContent']['btyp']==1) echo('selected');?>>시스템오류</option>
                    <option value="2" <?if($body['bContent']['btyp']==2) echo('selected');?>>주문/배송</option>
                    <option value="3" <?if($body['bContent']['btyp']==3) echo('selected');?>>취소/교환/반품</option>
                    <option value="4" <?if($body['bContent']['btyp']==4) echo('selected');?>>기타</option>
                </select>
                <?} else if($body['env']['bid']=='3'){?>
                <select name="btyp" id="inqTypeMethod" class="selectType4" disabled >
                    <option value="1" <?if($body['bContent']['btyp']==1) echo('selected');?>>시스템오류</option>
                    <option value="2" <?if($body['bContent']['btyp']==2) echo('selected');?>>주문/배송</option>
                    <option value="3" <?if($body['bContent']['btyp']==3) echo('selected');?>>취소/교환/반품</option>
                    <option value="4" <?if($body['bContent']['btyp']==4) echo('selected');?>>기타</option>
                </select>
               <?}?>
            </div>
            <div class="replyBox ">
                <div class="inq_box_child flexType4">
                    <p class="title">문의 제목</p>
                    <p class="data"><?=$body['bContent']['bTitle']?></p>
                    <!--                    --><?php //= print_r( $body['mitype'] )?><!--</p>-->
                </div>
                <div class="inq_box_child flexType4">
                    <p class="title">문의 내용</p>
                    <p class="data"><?=$body['bContent']['bContent']?>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci alias asperiores atque, consequuntur deleniti dicta dignissimos distinctio ducimus ea esse explicabo ipsam labore, officia officiis quia similique soluta vero, voluptatibus?

                    </p>
<!--                    <textarea name="" id="" cols="30" rows="10">--><?php //=$body['bContent']['bContent']?><!--</textarea>-->
<!--                    <p class="bContent inq_box_scroll">-->
<!--                        --><?php //=$body['bContent']['bContent']?>
<!---->
<!---->
<!--                    </p>-->

                </div>
                <div class="inq_box_child flexType4">
                    <p class="title">내용</p>
                    <textarea
                            placeholder="내용을 입력해주세요"
                            id="rContent"
                            name="rContent"
                            cols=""
                            rows=""
                    ><?= isset($body['reply'][0]['rContent'])  != '' ? $body['reply'][0]['rContent'] : '' ?></textarea>

                </div>



            </div>

            <div class="inq_box4">
                <p class="title"></p>

                <div id="thumbArea" name="thumbArea" class="thum_arange">
                    <?if (isset($body['att'][0]['fname'])) {?>
                        <div class="thumCon" id="" name="">
                            <div class="thumBox" name="thumPreview">
                                <button class="delete-btn" type="button" id="deleteBtn" name="deleteBtn">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                                <img src="<?=$body['att'][0]['path']?>/<?=$body['att'][0]['fname']?>"
                                     alt="img" class="addedImg">
                            </div>
                        </div>
                    <?}?>
                </div>
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

            <div class="desc">
                <p>- 5MB 이미지만 업로드 가능합니다. </p>
                <p>- 사진은 최대 3장까지 등록 가능합니다. </p>
            </div>
            <div class="inq_last_box mb40">
                <button type="button" class="btnType99 mr10"
                        data-bid="<?= $body['bContent']['bid']?>"
                        data-bcode="<?= $body['bContent']['bcode']?>"
                         name="delBtn" id="delBtn">삭제</button>
                <button type="button" class="btnType9"
                         name="submitBtn" id="submitBtn">등록</button>
            </div>
        </div>
    </form>
</section>

<?= $this->endSection() ?>
