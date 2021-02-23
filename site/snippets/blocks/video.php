<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  Block snippets control the HTML for individual blocks
  in the blocks field. This video snippet overwrites
  Kirby's default video block to add custom classes
  and style attributes.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<?php if ($block->url()->isNotEmpty()) : ?>
  <figure>
    <div class="embed-container">
      <?= video($block->url(), ['vimeo' => ['dnt' => 1, 'title' => 0, 'byline' => 0, 'portrait' => 0]]) ?>
    </div>
    <?php if ($block->caption()->isNotEmpty()) : ?>
      <figcaption class="video-caption"><?= $block->caption() ?></figcaption>
    <?php endif ?>
  </figure>
<?php endif ?>