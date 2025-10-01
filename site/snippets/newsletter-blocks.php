<?php foreach ($page->text()->toBlocks() as $block): ?>
  <div class="block">
    <?php if ($block->type() == 'news-item'): ?>
      <div class="block-item">
        <h2 class="divider"><?= $block->title() ?></h2>
        <div class="block-content">
          <div class="block-text">
            <?= $block->body()->kt() ?>
          </div>
          <?php if ($block->image()->isNotEmpty()): ?>
            <div class="block-image">
              <img src="<?= $block->image()->toFile()->thumb('newsletter')->url() ?>" alt="<?= $block->image()->toFile()->alt() ?>" />
            </div>
          <?php endif ?>
        </div>
      </div>
    <?php else: ?>
      <?= $block->toHtml() ?>
    <?php endif ?>
  </div>
<?php endforeach ?>
