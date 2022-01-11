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

<main class="full-height">
  <?php snippet('internal/menu') ?>
  <div class="content">
    <section class="markdown-body">
      <h1><?= $page->title() ?> (<?= $items->count() ?> Gegenstände)</h1>
      <?= $page->text()->kt() ?>
      <table class="sortable">
        <thead>
          <tr>
            <th>Hersteller</th>
            <th>Modell</th>
            <th>Name</th>
            <th>Ort</th>
            <th>Eigentümer</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item) : ?>
            <tr>
              <td><?= $item->name() ?></td>
              <td><?= $item->manufacturer() ?></td>
              <td><?= $item->model() ?></td>
              <td><?= $options[$item->location()->value()] ?></td>
              <td><?= $item->owner() ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <p class="last-edited">Zuletzt bearbeitet am <?= $site->pages()->get('inventar')->modified('d.m.Y \u\m H:i \U\h\r') ?></p>
    </section>
  </div>
</main>