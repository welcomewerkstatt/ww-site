<?php

  // Filter out discharged items
  $items = $site->pages()->get('inventar')->items()->toStructure()->filterBy('discharge', 'maxlength', '0')->sortBy('invnum', 'desc');

  $options = [
    'storage' => 'Lager',
    'office' => 'Büro',
    'basement' => 'Keller',
    'hall' => 'Halle',
    'machineroom' => 'Maschinenraum',
    'electronicarea' => 'Elektronikbereich',
    'bikearea' => 'Fahrradecke',
    '3dprint' => '3D-Drucker-Raum'
  ];
?>

<main class="h-full">
  <?php snippet('internal/menu') ?>
  <div class="content h-0-mobile">
    <?php snippet('internal/floating-button') ?>
    <section class="markdown-body content-grid">
      <h1><a class="anchor" aria-hidden="true" style="cursor: pointer;" onclick="(() => {navigator.clipboard.writeText('https://cloud.welcome-werkstatt.de/apps/external/1/<?= str_replace("internes/","",$page->id()) ?>')})()"><span class="octicon octicon-link"></span></a><?= $page->title() ?> (<?= $items->count() ?> Gegenstände)</h1>
      <?= $page->text()->kt() ?>
      <table class="sortable full-bleed-table">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Name</th>
            <th>Hersteller</th>
            <th>Modell</th>
            <th>Ort</th>
            <th>Eigentümer</th>
            <th class="no-sort">Bilder</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item) : ?>
            <tr>
              <td>
                <div style="display: flex; flex-direction: column; align-items: center;">
                  <?= $item->invnum() ?>
                  <?php if ($item->internalpage()->isNotEmpty()): ?>
                    <br/><a href="<?= $item->internalpage()->toPage()->url() ?>">
                      <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <title>Zur Bedienungsanleitung</title>
                        <path d="M13 21V23H11V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H9C10.1947 3 11.2671 3.52375 12 4.35418C12.7329 3.52375 13.8053 3 15 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H13ZM20 19V5H15C13.8954 5 13 5.89543 13 7V19H20ZM11 19V7C11 5.89543 10.1046 5 9 5H4V19H11Z"></path>
                      </svg>
                    </a>
                  <?php endif ?>
                  </div>
                </td>
              <td><?= $item->name() ?></td>
              <td><?= $item->manufacturer() ?></td>
              <td><?= $item->model() ?></td>
              <td><?= $options[$item->location()->value()] ?? $item->location()->value() ?><?= $item->locationdetail()->value() ? '<br/>('.$item->locationdetail()->value().')' :'' ?></td>
              <td><?= $item->owner() ?></td>
              <td style="padding: 0;">
                <?php
                  $index = 0;
                  $images = $item->images()->toFiles();
                ?>
                <?php foreach ($images as $image) : ?>
                  <?php
                    $caption = implode(" - ", array_filter([$item->name(), $item->manufacturer(), $item->model()], 'strlen'));
                  ?>
                  <a href="<?= $image->url() ?>" data-caption="<?= $caption ?>" class="lightbox table-thumbnail-container <?php e($index !== 0, 'hidden', '') ?>" data-group="<?= $item->invnum() ?>">
                    <img class="table-thumbnail" loading="lazy" src="<?= $image->resize(300)->url() ?>" />
                    <?php if (count($images) > 1) : ?>
                      <div style="position: absolute; bottom: 0; right: 0; border-radius: 9999px; background-color: white; width: 1.6rem; height: 1.6rem; margin: 5px; display: flex; justify-content: center; align-items: center;"><?= count($images) ?></div>
                    <?php endif ?>
                  </a>
                  <?php $index++; ?>
                <?php endforeach ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <p class="last-edited">Zuletzt bearbeitet am <?= $site->pages()->get('inventar')->modified('d.m.Y \u\m H:i \U\h\r') ?></p>
    </section>
  </div>
</main>
<script>
  const prvs = new Parvus();
</script>
