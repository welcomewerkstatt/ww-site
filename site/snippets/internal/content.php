<main class="h-full">
  <h1><?= $hasMenu ?></h1>
  <?php if ($hasMenu ?? false) snippet('internal/menu') ?>
  <div class="content h-0-mobile">
    <?php snippet('internal/floating-button') ?>
    <section class="markdown-body max-w-980">
      <h1><?= $page->title() ?></h1>
      <?= $page->text()->kt() ?>
      <p class="last-edited">Zuletzt bearbeitet am <?= $page->modified('d.m.Y \u\m H:i \U\h\r') ?></p>
    </section>
  </div>
</main>