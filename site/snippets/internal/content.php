<main class="full-height">
  <?php snippet('internal/menu') ?>
  <div class="content">
    <section class="markdown-body">
      <h1><?= $page->title() ?></h1>
      <?= $page->text()->kt() ?>
      <p class="last-edited">Zuletzt bearbeitet am <?= $page->modified('d.m.Y \u\m H:i \U\h\r') ?></p>
    </section>
  </div>
</main>
