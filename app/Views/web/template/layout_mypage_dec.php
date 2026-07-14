<!DOCTYPE html>
<html lang="en">
<head>
<?= $this->include("/web/include/meta_View", $meta) ?>
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
<link rel="stylesheet" href="/assets/web/css/style.css?rnd=<?echo(rand()); ?>">
<!--###############-->
<!--JS section-->
<?= $this->include("/web/include/script_View") ?>
<script src="<?=URL_COMMON_ASSETS?>/GaugeMeter.js"></script>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<!--###############-->
</head>
<body>
<?php //= $this->include("/web/include/header_View", $header) ?>
<?= $this->include("/web/include/header_topGnb_View", $header) ?>
<?php //= $this->include("/web/include/top_Gnb_View", $topGnb) ?>
<?= $this->include("/web/include/global_View", $header) ?>

<main >
<section class="merregister greenmain" >
    <div class="merwrap">
        <?= $this->renderSection("content") ?>
        <!--        <div class="mypageContent">-->
        <!--                        <div class="merleft">-->
        <!--                            --><?php //= $this->include("/web/include/left_View", $left_menu) ?>
        <!--                        </div>-->
        <!---->
        <!--                        --><?php //= $this->include("/web/include/top_Gnb_View", $topGnb) ?>
        <!--            --><?php //= $this->renderSection("content") ?>
        <!--                        <div class="merright">-->
        <!--                            --><?php //= $this->include("/web/include/top_Gnb_View", $topGnb) ?>
        <!--                            --><?php //= $this->renderSection("content") ?>
        <!--                        </div>-->
        <!--        </div>-->
    </div>
</section>
</main>

<?= $this->include("/web/include/whitefoot_View") ?>
</body>
</html>
