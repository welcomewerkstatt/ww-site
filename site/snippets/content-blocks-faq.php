<div class="content-row full-column grey"></div>
<div class="content-row main-column flex-column faq">
  <div class="flex justify-between">
    <?php if ($page->headline()->isNotEmpty()) : ?>
      <h1><?= $page->headline()->html() ?></h1>
    <?php else : ?>
      <h1><?= $page->title()->html() ?></h1>
    <?php endif ?>
    <div class="flex flex-column justify-center">
      <button type="button" id="toggleDetailsButton">Alle ausklappen</button>
    </div>
  </div>
  <?php foreach ($page->text()->toLayouts() as $layout) : ?>
    <section class="content-layout" id="<?= $layout->id() ?>">
      <?php foreach ($layout->columns() as $column) : ?>
        <div class="blocks" style="flex: <?= $column->span() ?>">
          <?php foreach ($column->blocks() as $block) : ?>
            <div class="block">
              <?= $block ?>
            </div>
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    </section>
  <?php endforeach ?>
</div>