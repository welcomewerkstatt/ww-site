<?php if (!$kirby->user() || $error) go('/') ?>

<?php snippet('internal/header') ?>
<?php snippet('internal/content') ?>
<?php snippet('internal/footer') ?>
