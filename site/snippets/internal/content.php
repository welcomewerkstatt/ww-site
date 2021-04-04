<main class="full-height">
  <?php snippet('internal/menu') ?>
  <section class="content markdown-body">
    <h1><?= $page->title() ?></h1>
    <?= $page->text()->kt() ?>
  </section>
</main>