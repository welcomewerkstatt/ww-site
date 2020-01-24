<h4><?= $data->headline()->html() ?></h4>
<?php foreach ($page->files()->template('sidebarimage')->sortBy('sort') as $image) : ?>
  <?= $image->thumb('header') ?>
<?php endforeach ?>