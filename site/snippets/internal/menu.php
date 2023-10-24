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
          <div class="flex justify-between items-center">
            <a class="<?php e($item->isActive(), 'active ') ?>" href="<?= $item->url() ?>"><span><?= $item->title()->html() ?></span></a>
            <?php if ($item->hasChildren()) : ?>
              <svg class="collapsible shrink-0 <?php e($item->collapsedByDefault()->toBool(), 'rotate-90') ?>" aria-hidden="true" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M14.83 11.29L10.59 7.05001C10.497 6.95628 10.3864 6.88189 10.2646 6.83112C10.1427 6.78035 10.012 6.75421 9.88 6.75421C9.74799 6.75421 9.61729 6.78035 9.49543 6.83112C9.37357 6.88189 9.26297 6.95628 9.17 7.05001C8.98375 7.23737 8.87921 7.49082 8.87921 7.75501C8.87921 8.0192 8.98375 8.27265 9.17 8.46001L12.71 12L9.17 15.54C8.98375 15.7274 8.87921 15.9808 8.87921 16.245C8.87921 16.5092 8.98375 16.7626 9.17 16.95C9.26344 17.0427 9.37426 17.116 9.4961 17.1658C9.61794 17.2155 9.7484 17.2408 9.88 17.24C10.0116 17.2408 10.1421 17.2155 10.2639 17.1658C10.3857 17.116 10.4966 17.0427 10.59 16.95L14.83 12.71C14.9237 12.617 14.9981 12.5064 15.0489 12.3846C15.0997 12.2627 15.1258 12.132 15.1258 12C15.1258 11.868 15.0997 11.7373 15.0489 11.6154C14.9981 11.4936 14.9237 11.383 14.83 11.29Z"></path>
              </svg>
            <?php endif ?>
          </div>
          <?php
          $subitems = $item->children()->listed();
          if ($subitems->isNotEmpty()) :
          ?>
            <ul class="nested-list <?php e($item->collapsedByDefault()->toBool(), 'hidden') ?>">
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