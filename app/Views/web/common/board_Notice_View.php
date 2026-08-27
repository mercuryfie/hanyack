<?= $this->extend("/web/template/layout_board") ?> <?= $this->section("content")
?>

<script src="<?=URL_COMMON_ASSETS?>/board.js"></script>
<script src="<?=URL_COMMON_ASSETS?>/board_Notice_Do.js"></script>
<section class="content">
<form id="thisForm" method="post" onsubmit="return false">
<input type="hidden" name="b_uid" id="b_uid" value="<?=$body['uid'];?>" />
    <div class="noti_wrap  ">
        <div class="title_wrap ">
            <div class="titleBox " id="titi_box" name="titi_box">
<!--                <img src="--><?php //=$body['att']['path']?><!--/--><?php //=$body['att']['fname']?><!--" alt="img">-->
                <p
                        class="title"
                        id="title"
                        name="title"
                        data-mitype="<?=$body['mitype']?>"
                        data-bid="<?=$body['env']['bid']?>"
                >
                    <?=$body['env']['bname']?>
                </p>
                <p class="msg ">새로운 소식과 유용한 정보를 한 곳에서 확인하세요.</p>
            </div>
            <?if($body['mitype']=='master'){?>
                <div class="ticket-box">
                    <button
                            type="button"
                            class="btnType9"
                            name=""
                            id="submitBtn"
                            onclick="go_Board_Form(<?=$body['env']['bid']?>);"
                    >
                        글쓰기
                    </button>
                </div>
            <?}?>
        </div>

        <div class="noticeBox" id="noti_box" name="noti_box">
            <div class="category">
                <p class="number">번호</p>
                <p class="type">분류</p>
                <p class="title">제목</p>
                <p class="writer">작성자</p>
                <p class="date">작성일</p>
            </div>
            <div id="noticeList" name="noticeList" class="boardList"></div>
            <div class="lastContents"></div>
            <div class="more_box" type="button" name="more" id="more">
                <button class="moreList" id="more" name="more" type="button" data-page="<?= $body['page']?>">
                    더보기
                </button>
                <i class="fa-solid fa-angle-down" id="more2" name="more2"></i>
            </div>
        </div>
     </div>
</form>
</section>

<?= $this->endSection() ?>
