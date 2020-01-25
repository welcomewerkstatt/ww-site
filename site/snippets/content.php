<section class="content">
  <?php if ($page->headline()->isNotEmpty()) : ?>
    <h1><?= $page->headline()->html() ?></h1>
  <?php else : ?>
    <h1><?= $page->title()->html() ?></h1>
  <?php endif ?>
  <?= $page->text()->kt() ?>
</section>