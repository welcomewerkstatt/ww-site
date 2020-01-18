<aside class="sidebar">
  <?php snippet('sidebarVideo') ?>
  <?php if ($calendar) : ?>
    <?php snippet('sidebarCalendar', ['calendar' => $calendar]) ?>
  <?php endif ?>
</aside>