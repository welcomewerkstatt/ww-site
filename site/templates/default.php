<?php snippet('header') ?>
<?php snippet('menu') ?>
<div class="content-row full-column grey"></div>
<div class="content-row main-column two-columns-on-desktop">
  <section class="content">
    <h3><?= $page->headline()->html() ?></h3>
    <?= $page->text()->kt() ?>
  </section>
</div>
<?php snippet('footer') ?>