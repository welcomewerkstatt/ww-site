<!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <?= $page->metaTags() ?>
  <?= css(['assets/css/main.css', '@auto']) ?>
  <!-- <?= css('assets/css/print.css', 'print') ?> -->
</head>

<body>
  <main>
    <div class="logo-row full-column blue"></div>
    <header class="logo-row main-column"></header>
    <div class="slider-row full-column blue flex-container space-between">
      <?php
      $images = [];
      if ($page->files()->template('headerimage')->isNotEmpty()) {
        $images = $page->files()->template('headerimage')->sortBy('sort');
      } else if ($site->files()->isNotEmpty()) {
        $images = $site->files()->sortBy('sort');
      }
      $index = 0;
      foreach ($images as $image) : ?>
        <picture>
          <?php if ($index == 0) : ?>
            <source srcset="<?= $image->thumb('header')->url() ?>" />
          <?php else : ?>
            <source media="(max-width: 799px)" srcset="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" />
            <source media="(min-width: 800px)" srcset="<?= $image->thumb('header')->url() ?>" />
          <?php endif ?>
          <img src="<?= $image->thumb('header')->url() ?>" />
        </picture>
      <?php endforeach ?>
    </div>
    <div class="slider-row main-column"></div>