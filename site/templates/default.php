<?php snippet('header') ?>
<?php snippet('menu') ?>
<div class="content-row full-column grey"></div>
<div class="content-row main-column two-columns-on-desktop">
  <section class="content">
    <h3><?= $page->headline()->kt() ?></h3>
    <?= $page->text()->kt() ?>
  </section>
  <aside class="sidebar">
    <?php
      foreach ($page->mybuilder()->toBuilderBlocks() as $block) :
        snippet('blocks/' . $block->_key(), array('data' => $block));
      endforeach;
    ?>
  </aside>
</div>
<?php snippet('footer') ?>