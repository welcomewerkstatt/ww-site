<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= css([
    'assets/css/templates/internal/internal.css',
    'assets/css/templates/internal/github-markdown.css',
  ]) ?>
  <?= js('@auto', true) ?>
  <title><?= $page->title() ?></title>
</head>

<body class="full-height">