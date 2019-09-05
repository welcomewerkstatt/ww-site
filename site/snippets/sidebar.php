<?php if ($page->sidebar()->isNotEmpty())  : ?>
  <aside class="sidebar">
    <?= $page->sidebar()->kt() ?>
  </aside>
<?php endif ?>