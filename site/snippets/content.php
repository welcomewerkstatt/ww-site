<div class="content-row full-column grey"></div>
<div class="content-row main-column <?php e($page->sidebar()->isNotEmpty(), 'two-columns-on-desktop') ?>">
  <section class="content">
    <h2><?= $page->title()->kt() ?></h2>
    <?= $page->text()->kt() ?>
  </section>
  
  <?php snippet('sidebar') ?>

</div>