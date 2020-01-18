<?php if ($calendar) : ?>
  <h4>Aktuelle Veranstaltungen</h4>
  <ul class="calendar">
    <?php foreach ($calendar as $event) : ?>
      <li>
        <div><?= $event['startDateString'] ?></div>
        <div style="text-align: right">
          <?php if ($event['url']) : ?>
            <a href="<?= $event['url'] ?>" class="undecoratedLink">
            <?php endif ?>
            <span style="font-weight: bold">
              <?= $event['summary'] ?>
            </span>
            <?php if ($event['url']) : ?>
              <div class="icon baseline">
                <?php include("assets/img/open-in-new-24px.svg"); ?>
              </div>
            </a>
          <?php endif ?><br />
          <span style="font-size: 0.9em">
            <?= $event['startTimeString'] ?> - <?= $event['endTimeString'] ?> Uhr
          </span>
        </div>
      </li>
    <?php endforeach ?>
  </ul>
<?php endif ?>