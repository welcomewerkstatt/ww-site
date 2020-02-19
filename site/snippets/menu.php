<div class="menu-row full-column green"></div>
<nav class="menu-row main-column">
  <input id="hamburger-checkbox" type="checkbox">
  <label for="hamburger-checkbox" class="hamburger-icon"></label>
  <ul>
    <?php
    $menuItems = $site->children()->listed();

    if ($page->isUnlisted()) :

    ?>
      <li class="active"><a href="#"><?= $page->title()->html() ?></a></li>
    <?php endif ?>
    <?php
    foreach ($menuItems as $menuItem) :
      $subMenuItems = $menuItem->children()->listed();
      $isCategory = ($menuItem->template() == 'category');
      $isActiveClass = $menuItem->isActive() ? 'active ' : '';
      $isOpenClass = $menuItem->isOpen() ? 'open' : '';
      $classes = $isActiveClass . $isOpenClass;
    ?>

      <li <?php e($classes, ' class="' . $classes . '"') ?>>

        <?php if (!$isCategory) : ?>
          <a href="<?= $menuItem->url() ?>">
          <?php else : ?>
            <a href="#">
            <?php endif ?>
            <?= $menuItem->title()->html() ?>
            <?php e($subMenuItems->isNotEmpty(), ' <i class="arr-down"></i>') ?>
            </a>

            <?php
            if ($subMenuItems->isNotEmpty()) : ?>
              <ul>
                <?php foreach ($subMenuItems as $subMenuItem) : ?>
                  <li <?php e($subMenuItem->isActive(), ' class="active"') ?>><a href="<?= $subMenuItem->url() ?>"><?= $subMenuItem->title()->html() ?></a></li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>
      </li>
    <?php endforeach ?>

  </ul>
</nav>