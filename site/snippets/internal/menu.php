<nav class="navigation height-transition flex-column">
  <div class="site-title padding no-margin flex justify-between">
    <div class="flex-1"><?= $site->title() ?></div>
    <button type="button" onClick="toggleSidebar()" id="sidebar-button" class="collapse-button" title="Seitenleiste ausblenden">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="100%" height="1rem">
        <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
      </svg>
    </button>
  </div>
  <?php
  $items = $pages->template('internal')->first()->children()->listed();
  if ($items->isNotEmpty()) :
  ?>
    <ul class="padding no-margin flex-1 overflow-auto">
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