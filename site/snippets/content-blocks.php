<div class="content-row full-column grey"></div>
<div class="content-row main-column flex-column">
  <?php foreach ($page->text()->toLayouts() as $layout) : ?>
    <section class="content-layout" id="<?= $layout->id() ?>">
      <?php foreach ($layout->columns() as $column) : ?>
        <div class="blocks" style="flex: <?= $column->span() ?>">
          <?= $column->blocks() ?>
        </div>
      <?php endforeach ?>
    </section>
  <?php endforeach ?>
</div>