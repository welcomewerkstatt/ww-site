<div class="content-row full-column grey"></div>
<div class="content-row content main-column flex-column">
  <?php if ($page->headline()->isNotEmpty()) : ?>
    <h1><?= $page->headline()->html() ?></h1>
  <?php else : ?>
    <h1><?= $page->title()->html() ?></h1>
  <?php endif ?>
  <?php foreach ($page->text()->toLayouts() as $layout) : ?>
    <section class="content-layout" id="<?= $layout->id() ?>">
      <?php foreach ($layout->columns() as $column) : ?>
        <div class="blocks" style="flex: <?= $column->span() ?>">
          <?php foreach ($column->blocks() as $block) : ?>
            <?= $block ?>
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    </section>
  <?php endforeach ?>
</div>