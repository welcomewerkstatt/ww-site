<?php if ($error) go('/') ?>

<?php snippet('internal/header') ?>
<?php snippet('internal/content', ['hasMenu' => $hasMenu]) ?>
<?php snippet('internal/footer') ?>