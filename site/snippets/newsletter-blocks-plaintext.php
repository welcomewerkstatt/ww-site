<?php foreach ($page->text()->toBlocks() as $block): ?>
<?php if ($block->type() == 'news-item'): ?>
## <?= $block->title() ?>
<?= $block->body()->kt() ?>
<?php else: ?>
<?= $block->toHtml() ?>
<?php endif ?>
<?php endforeach ?>