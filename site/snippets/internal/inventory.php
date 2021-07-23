<?php
$items = $site->pages()->get('inventar')->items()->toStructure();
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
      <h1><?= $page->title() ?></h1>
      <table>
        <tr>
          <th>Hersteller</th>
          <th>Modell</th>
          <th>Name</th>
          <th>Ort</th>
        </tr>
        <?php foreach ($items as $item) : ?>
          <tr>
            <td><?= $item->manufacturer() ?></td>
            <td><?= $item->model() ?></td>
            <td><?= $item->name() ?></td>
            <td><?= $options[$item->location()->value()] ?></td>
          </tr>
        <?php endforeach ?>
      </table>
      <p class="last-edited">Zuletzt bearbeitet am <?= $page->modified('d.m.Y \u\m H:i \U\h\r') ?></p>
    </section>
  </div>
</main>