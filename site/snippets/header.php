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

      <?php if ($page->files()->template('headerimage')->isNotEmpty()) : ?>
        <?php foreach ($page->files()->template('headerimage')->sortBy('sort') as $image) : ?>
          <?= $image->thumb('header') ?>
        <?php endforeach ?>
      <?php else : ?>
        <?php if ($site->files()->isNotEmpty()) : ?>
          <?php foreach ($site->files()->sortBy('sort') as $image) : ?>
            <?= $image->thumb('header') ?>
          <?php endforeach ?>
        <?php else : ?>
          <img src="https://picsum.photos/1280/720?random=1">
          <img src="https://picsum.photos/1280/853?random=2">
          <img src="https://picsum.photos/600/600?random=3">
          <img src="https://picsum.photos/1280/720?random=4">
        <?php endif ?>
      <?php endif ?>

    </div>
    <div class="slider-row main-column"></div>