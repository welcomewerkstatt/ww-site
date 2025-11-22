<!DOCTYPE html>
<html lang="de" class="overflow-x-hidden">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= css([
    'assets/css/templates/internal/github-markdown.css',
    'assets/css/templates/internal/parvus.min.css',
    'assets/css/templates/internal/sortable.css',
    'assets/css/templates/internal/internal.css',
    'assets/css/templates/internal/infobox.css'
  ]) ?>
  <?= js(['assets/js/templates/sortable.js','assets/js/templates/collapsible.js', 'assets/js/templates/parvus.min.js']) ?>
  <title><?= $page->title() ?> – Welcome Werkstatt Interner Bereich</title>
</head>

<body class="h-full">