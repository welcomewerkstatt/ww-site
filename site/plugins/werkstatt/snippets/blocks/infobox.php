<div class="infobox <?= $block->design() == 'news' ? 'infobox-alert' : 'infobox-info' ?>">
  <h2 class="infobox-title"><?= $block->design() == 'news' ? 'Aktuelles' : 'Info' ?></h2>
  <div class="infobox-content">
    <h2><?= $block->title() ?></h2>
    <?php if ($block->date() != '' or $block->time() != '') { ?>
      <p>
        <?= $block->date() != '' ? $block->date()->toDate('🗓️ d.m.Y') : '' ?>
        <?= $block->date() != '' ? $block->time()->toDate('🕓 H:i') : '' ?>
      </p>
    <?php } ?>
    <p><?= $block->text() ?></p>
  </div>
</div>