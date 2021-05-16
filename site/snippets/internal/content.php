<main class="full-height">
  <?php snippet('internal/menu') ?>
  <div class="content">
    <section class="markdown-body">
      <h1><?= $page->title() ?></h1>
      <?= $page->text()->kt() ?>
    </section>
  </div>
</main>