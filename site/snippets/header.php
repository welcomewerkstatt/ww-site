<!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <?= js('@auto', true) ?>
  <?= css(['@auto', 'assets/css/main.css', 'media/plugins/preya/kirby-link-button-block/link-button.css', 'media/plugins/welcome-werkstatt/kirby-notification-box-block/notification-box.css', 'media/plugins/preya/kirby-next-events-block/next-events.css', 'media/plugins/preya/kirby-accordion-block/accordion.css', 'media/plugins/preya/kirby-team-box-block/team-box.css']) ?>
  <?php snippet('seo/head'); ?>
  <script async src="https://analytics.welcome-werkstatt.de/script.js" data-website-id="4ca23a6e-edb6-45c2-91d8-b982951d748c"></script>
</head>

<body>
  <main>
    <div class="logo-row full-column blue"></div>
    <header class="logo-row main-column">
      <a href="/">
        <picture>
          <source media="(min-width: 800px)" srcset="/assets/img/ww_website_logo.svg" />
          <img class="logo" src="/assets/img/ww_website_logo_mobile.svg" alt="Welcome Werkstatt Logo" />
        </picture>
      </a>
    </header>
    <div class="slider-row full-column blue flex justify-between">
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