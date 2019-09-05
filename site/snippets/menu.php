<div class="menu-row full-column green"></div>
<nav class="menu-row main-column">
  <input id="hamburger-checkbox" type="checkbox">
  <label for="hamburger-checkbox" class="hamburger-icon"></label>
  <ul>
    <?php
    // In the menu, we only fetch listed pages, i.e. the pages that have a prepended number in their foldername
    // We do not want to display links to unlisted `error`, `home`, or `sandbox` pages
    // More about page status: https://getkirby.com/docs/reference/panel/blueprints/page#statuses
    foreach ($site->children()->listed() as $menuitem) : ?>
      <li><a <?php e($menuitem->isOpen(), ' class="active"') ?> href="<?= $menuitem->url() ?>"><?= $menuitem->title()->html() ?></a></li>
    <?php endforeach ?>
    <li><a href="https://forum.welcome-werkstatt.de/">Forum</a></li>

    <!-- <li class="active"><a href="#"></a>Startseite</a></li>
    <li>
      <a href="#">Werkstatt <i class="arr-down"></i></a>
      <ul>
        <li><a href="#">Sub 1</a></li>
        <li><a href="#">Submenu 2</a></li>
        <li><a href="#">Submenu Long Title 3</a></li>
      </ul>
    </li>
    <li><a href="#">Verein</a></li>
    <li><a href="#">Veranstaltungen</a></li>
    <li><a href="#">Verein fördern</a></li>
    <li><a href="#">Forum</a></li> -->
  </ul>
</nav>