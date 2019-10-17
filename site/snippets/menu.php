<div class="menu-row full-column green"></div>
<nav class="menu-row main-column">
  <input id="hamburger-checkbox" type="checkbox">
  <label for="hamburger-checkbox" class="hamburger-icon"></label>
  <ul>
    <?php
    $menuItems = $site->children()->listed();

    foreach ($menuItems as $menuItem) :
      $subMenuItems = $menuItem->children()->listed(); ?>

      <li <?php e($menuItem->isActive(), ' class="active"') ?>><a href="<?= $menuItem->url() ?>"><?= $menuItem->title()->html() ?><?php e($subMenuItems->isNotEmpty(), ' <i class="arr-down"></i>') ?></a>
        <?php
          if ($subMenuItems->isNotEmpty()) : ?>
          <ul>
            <?php foreach ($subMenuItems as $subMenuItem) : ?>
              <li><a href="<?= $subMenuItem->url() ?>"><?= $subMenuItem->title()->html() ?></a></li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </li>
    <?php endforeach ?>

    <li><a href="https://forum.welcome-werkstatt.de/">Forum</a></li>

  </ul>
</nav>