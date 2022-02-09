<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= css([
    'assets/css/templates/internal/github-markdown.css',
    'assets/css/templates/internal/parvus.min.css',
    'assets/css/templates/internal/internal.css'
  ]) ?>
  <?= js(['assets/js/templates/internal-inventory.js', 'assets/js/templates/parvus.min.js']) ?>
  <title><?= $page->title() ?> – Welcome Werkstatt Interner Bereich</title>
</head>

<body class="full-height">