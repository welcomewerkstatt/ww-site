<nav class="navigation flex-column">
  <div class="site-title padding no-margin"><?= $site->title() ?></div>
  <?php
  $items = $pages->template('internal')->first()->children();
  if ($items->isNotEmpty()) :
  ?>
    <ul class="padding no-margin">
      <?php foreach ($items as $item) : ?>
        <li>
          <a<?php e($item->isActive(), ' class="active"') ?> href="<?= $item->url() ?>"><span><?= $item->title()->html() ?></span></a>
            <?php
            $subitems = $item->children()->listed();
            if ($subitems->isNotEmpty()) :
            ?>
              <ul class="nested-list">
                <?php foreach ($subitems as $subitem) : ?>
                  <li>
                    <a<?php e($subitem->isActive(), ' class="active"') ?> href="<?= $subitem->url() ?>"><?= $subitem->title()->html() ?></a>
                  </li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>
        </li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>
</nav>