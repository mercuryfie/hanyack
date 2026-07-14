<?= $this->extend("/mobile/template/layout_default") ?>
<?= $this->section("content") ?>

<link rel="stylesheet" href="./assets/web/slick/ajax-loader.gif">
<link rel="stylesheet" href="./assets/web/slick/slick-theme.css">
<link rel="stylesheet" href="./assets/web/slick/slick.css">

<!--<link rel="stylesheet" href="/path/to/react-mobile-main.css" />-->

<script src="<?= URL_COMMON_ASSETS ?>/main.js?rnd=<?= rand(); ?>"></script>
<script src="<?= URL_COMMON_ASSETS ?>/main_Do.js?rnd=<?= rand(); ?>"></script>
<script src="<?= URL_COMMON_ASSETS ?>/GaugeMeter.js"></script>


<section class="mainbanner">
    <div id="root"></div>
    <script src="/react/static/js/main.js"></script>
    <link href="/react/static/css/main.css" rel="stylesheet">
</section>

<?= $this->endSection() ?>
