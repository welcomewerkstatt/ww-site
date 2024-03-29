<main class="h-full">
  <?php snippet('internal/menu') ?>
  <div class="content h-0-mobile">
    <?php snippet('internal/floating-button') ?>
    <section class="markdown-body max-w-980">
      <h1><?= $page->title() ?></h1>
      <?= $page->text()->toBlocks() ?>
      <p class="last-edited">Zuletzt bearbeitet am <?= $page->modified('d.m.Y \u\m H:i \U\h\r') ?></p>
    </section>
  </div>
</main>