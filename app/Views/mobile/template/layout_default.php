<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('/mobile/include/meta_View', $meta); ?>
    <!--CSS section-->
    <!--    <link rel="stylesheet" href="/assets/web/css/style.css?rnd=--><?php //=rand();?><!--">-->
    <link rel="stylesheet" href="/assets/web/css/styleM.css?rnd=<?= rand(); ?>">
    <!--JS section-->
    <?= $this->include('/mobile/include/script_View'); ?>
    <!--###############-->
</head>
<body>
<?= $this->include('/web/include/header_topGnb_View',$header); ?>
<?= $this->include('/mobile/include/global_View', $header); ?>

<main>
    <?= $this->renderSection('content') ?>
</main>
<?= $this->include('/mobile/include/foot_View'); ?>

</body>
</html>
