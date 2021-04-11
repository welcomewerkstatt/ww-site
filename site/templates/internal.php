<?php if ($error) go('/') ?>

<script>
  console.log("Debug: ", <?= $debug ?>);
</script>

<?php snippet('internal/header') ?>
<?php snippet('internal/content') ?>
<?php snippet('internal/footer') ?>