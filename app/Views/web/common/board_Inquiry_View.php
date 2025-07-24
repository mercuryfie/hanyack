<?= $this->extend("/web/template/layout_board") ?>
<?= $this->section("content") ?>

<script src="<?=URL_COMMON_ASSETS?>/board_Inquiry_Do.js"> </script>
<!--reply-->
<?php //print_r($body)?>
<?php //print_r($body['r eply']['rContent'])?>

<?php //= print_r(['hello', $body['env']['bid'], $body['content']['bcode']]);?>
<section class="content">
<!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias amet cum cupiditate ea itaque laborum, nam nesciunt possimus quae quis, reiciendis temporibus voluptate. Eius minus quas recusandae repellat unde vitae.-->
<?= $this->include("/web/include/pop_ThumMaster_View") ?>
<form id="thisForm" method="post" onsubmit="return false">
<input type="hidden" name="b_uid" id="b_uid" value="<?=$body['uid'];?>" />
<input type="hidden" name="bid" id="bid" value="<?=$body['env']['bid'];?>" />
    <div class="inq_wrap">
        <div class="titleBox" id="titi_box" name="titi_box" >
             <p class="title"
                id="title"
                name="title"
                data-bid="<?=$body['env']['bid']?>"
                data-mitype="<?=$body['mitype']?>"  >
                <?=$body['env']['bname']?>

            </p>
            <button id="hello">hello</button>
        </div>
        <div class="inquiryBox ">
            <div class="colname">
                <p class="title">제목</p>
                <p class="date">작성일</p>
                <p class="writer">작성자</p>
                <p class="status">상태</p>
            </div>
            <div id="inquiryList" name="inquiryList" class="boardList">

            </div>
            <div class="lastContents"></div>

            <div class="moreBox720" id="moreBox" name="moreBox">
                <button class="moreList" id="more" name="more" type="button" data-page="<?=$body['page']?>">
                    더보기
                </button>
                <i class="fa-solid fa-angle-down" id="more2" name="more2"></i>
            </div>
            <div class="inq_last_box">
                <button type="button" class="btnType9" onclick="go_Board_Form('<?=$body['env']['bid']?>');">문의하기</button>
            </div> 

        </div>
    </div>
</form>
</section>

<?= $this->endSection() ?>
