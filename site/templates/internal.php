<?php if (!$kirby->user()) go('/') ?>

<?php snippet('internal/header') ?>
<script>
console.log("Headers: ", <?= $debug ?>);
</script>
<?php snippet('internal/content') ?>
<?php snippet('internal/footer') ?>
