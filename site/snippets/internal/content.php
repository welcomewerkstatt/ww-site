<main class="h-full">
  <?php if ($hasMenu ?? false) snippet('internal/menu') ?>
  <div class="<?= $hasMenu ? 'content' : 'content-no-menu'?> h-0-mobile">
    <?php snippet('internal/floating-button') ?>
    <section class="markdown-body max-w-980">
      <h1><?= $page->title() ?></h1>
      <?= $page->text()->kt() ?>
      <p class="last-edited">Zuletzt bearbeitet am <?= $page->modified('d.m.Y \u\m H:i \U\h\r') ?></p>
    </section>
  </div>
</main>