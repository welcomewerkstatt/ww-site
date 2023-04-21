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
      <h1><?= $page->title() ?> (<?= $items->count() ?> Gegenstände)</h1>
      <?= $page->text()->kt() ?>
      <table class="sortable full-bleed">
        <thead>
          <tr>
            <th>Nr.</th>
            <th>Name</th>
            <th>Hersteller</th>
            <th>Modell</th>
            <th>Ort</th>
            <th>Eigentümer</th>
            <th>Bilder</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item) : ?>
            <tr>
              <td><?= $item->invnum() ?></td>
              <td><?= $item->name() ?></td>
              <td><?= $item->manufacturer() ?></td>
              <td><?= $item->model() ?></td>
              <td><?= $options[$item->location()->value()] ?? '' ?></td>
              <td><?= $item->owner() ?></td>
              <td>
                <?php foreach ($item->images()->toFiles() as $image) : ?>
                  <?php
                  $caption = implode(" - ", array_filter([$item->name(), $item->manufacturer(), $item->model()], 'strlen'));
                  ?>
                  <a href="<?= $image->url() ?>" data-caption="<?= $caption ?>" class="lightbox" data-group="<?= $item->name() ?>">
                    <img src="<?= $image->resize(300, 200)->url() ?>" />
                  </a>
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