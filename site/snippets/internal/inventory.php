<?php

  // Filter out discharged items
  $items = $site->pages()->get('inventar')->items()->toStructure()->filterBy('discharge', 'maxlength', '0');

  $options = [
    'storage' => 'Lager',
    'office' => 'Büro',
    'basement' => 'Keller',
    'hall' => 'Halle',
    'machineroom' => 'Maschinenraum',
    'electronicarea' => 'Elektronikbereich',
    'bikearea' => 'Fahrradecke',
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
              <td><?= $item->invnum() ?></td>
              <td><?= $item->name() ?></td>
              <td><?= $item->manufacturer() ?></td>
              <td><?= $item->model() ?></td>
              <td><?= $options[$item->location()->value()] ?? '' ?><?= $item->locationdetail()->value() ? '<br/>('.$item->locationdetail()->value().')' :'' ?></td>
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
                    <img class="table-thumbnail" src="<?= $image->resize(300)->url() ?>" />
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