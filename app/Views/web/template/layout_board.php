<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('/web/include/meta_View',$meta);?>
    <!-- font1 ----------------------------  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+KR:wght@100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Birthstone&display=swap" rel="stylesheet"> 
    <!-- icon fontawesome ----------------------------  -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" /> 
    <!--CSS section-->
    <link rel="stylesheet" href="/assets/web/css/style.css?rnd=<?=rand();?>">

<!--    <link rel="stylesheet" href="/assets/web/css/style.css?rnd=--><?//echo(rand());?><!--"> -->
    <!--###############-->
    <!--JS section-->
    <?= $this->include('/web/include/script_View'); ?>
<!--    --><?php //= $this->include('/web/js/common/control.js'); ?>
    <!--###############-->
</head>
<body>
<?= $this->include('/web/include/header_topGnb_View',$header); ?>
<?= $this->include('/web/include/global_View',$header); ?>

<main>
    <div class="boardWrap">
        <div class="b_Left">
            <p class="title">고객센터</p>
            <div class="menubox" onclick="go_Board_Notice();" tabindex="0" role="button">
                <a href="#" class="menutab">
                    공지사항
                </a>
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="menubox" onclick="go_Board_Faq();" tabindex="1" role="button">
                <a href="#" class="menutab">
                    자주하는 질문
                </a>
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="menubox" onclick="go_Board_Inquiry();" tabindex="2" role="button">
                <a href="#" class="menutab">
                    1:1 문의
                </a>
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="menubox menuboxLast" onclick="go_Board_Notice();" tabindex="3" role="button">
                <a href="#" class="menutab">
                    대량주문 문의
                </a>
                <i class="fa-solid fa-angle-right"></i>
            </div>

            <div class="helpbox"  onclick="go_Board_Inquiry();">
                <div class="helpmsg">
                    <p class="help1">도움이 필요하신가요?</p>
                    <p class="help2">1:1 문의하기</p>
                </div>
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>

        <div class="b_Right">
            <?= $this->renderSection("content") ?>
        </div>
    </div>
</main>
<?= $this->include('/web/include/foot_View');?>

</body>
</html>
