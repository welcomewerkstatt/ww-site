<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?= $site->title() ?> | <?= $page->title() ?></title>
  <?= css(['assets/css/normalize.css','assets/css/style.css', '@auto']) ?>
</head>

<body>
  <main>
    <div class="logo-row full-column blue"></div>
        <header class="logo-row main-column"></header>
        <div class="slider-row full-column blue flex-container space-between">
          <img src="https://picsum.photos/1280/720?random=1">
          <img src="https://picsum.photos/1280/853?random=2">
          <img src="https://picsum.photos/600/600?random=3">
          <img src="https://picsum.photos/1280/720?random=4">
        </div>
        <div class="slider-row main-column"></div>