<section class="content">
  <?php if ($page->headline()->isNotEmpty()) : ?>
    <h3><?= $page->headline()->html() ?></h3>
  <?php else : ?>
    <h3><?= $page->title()->html() ?></h3>
  <?php endif ?>
  <?= $page->text()->kt() ?>
</section>