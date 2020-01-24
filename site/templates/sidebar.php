<?php snippet('header') ?>
<?php snippet('menu') ?>
<div class="content-row full-column grey"></div>
<div class="content-row main-column two-columns-on-desktop">
  <section class="content">
    <?= $page->text()->kt() ?>
  </section>
  <?php if ($page->mybuilder()->toBuilderBlocks()->isNotEmpty()) : ?>
    <aside class="sidebar">
      <?php
      foreach ($page->mybuilder()->toBuilderBlocks() as $block) :
        snippet('blocks/' . $block->_key(), array('data' => $block, 'calendar' => $calendar));
      endforeach;
      ?>
    </aside>
  <?php endif ?>
</div>
<?php snippet('footer') ?>