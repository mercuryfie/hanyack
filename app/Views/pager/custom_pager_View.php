<div class="page_box flexType1">
    <?php if ($pager->hasPrevious()): ?>
        <button type="button" class="page flexType1" name="btnLinkPaging" onclick="location.href='<?= $pager->getPrevious() ?>'">
            <i class="fa-solid fa-angles-left"></i>
        </button>
    <?php endif ?>

    <?php foreach ($pager->links() as $link): ?>
        <button type="button" class="page flexType1 <?= $link['active'] ? 'active' : '' ?>" name="btnLinkPaging" onclick="location.href='<?= $link['uri'] ?>'">
            <p class="page_p <?= $link['active'] ? 'active' : '' ?>"><?= $link['title'] ?></p>
        </button>
    <?php endforeach ?>

    <?php if ($pager->hasNext()): ?>
        <button type="button" class="page flexType1" name="btnLinkPaging" onclick="location.href='<?= $pager->getNext() ?>'">
            <i class="fa-solid fa-angles-right"></i>
        </button>
    <?php endif ?>
</div>