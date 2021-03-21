<div class="content-row full-column grey"></div>
<div class="content-row main-column flex-column faq">
  <div style="display: flex;" class="justify-between">
    <?php if ($page->headline()->isNotEmpty()) : ?>
      <h1><?= $page->headline()->html() ?></h1>
    <?php else : ?>
      <h1><?= $page->title()->html() ?></h1>
    <?php endif ?>
    <div style="display: flex;" class="flex-column justify-center">
      <button type="button" id="toggleDetailsButton">Alle ausklappen</button>
    </div>
  </div>
  <div class="layouts-content">
    <?php foreach ($page->text()->toLayouts() as $layout) : ?>
      <section class="grid" id="<?= $layout->id() ?>">
        <?php foreach ($layout->columns() as $column) : ?>
          <div class="column" style="--columns:<?= $column->span() ?>">
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
</div>