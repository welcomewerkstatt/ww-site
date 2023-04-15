<div class="footer-row full-column blue"></div>
<footer class="footer-row main-column">
  <nav>
    <ul>
      <?php foreach ($site->find('impressum', 'kontakt') as $subpage) : ?>
        <li>
          <a href="<?= $subpage->url() ?>">
            <?= html($subpage->title()) ?>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
    <div class="social-media-icons">
      <?php if ($site->mastodon()->isNotEmpty()) : ?>
        <div class="social-media-icon">
          <a href="<?= $site->mastodon()->html() ?>" rel="me" title="Mastodon" target="_blank">
            <?= svg("assets/img/mastodon_icon.svg") ?>
          </a>
        </div>
      <?php endif ?>
      <?php if ($site->instagram()->isNotEmpty()) : ?>
        <div class="social-media-icon">
          <a href="<?= $site->instagram()->html() ?>" title="Instagram" target="_blank">
            <?= svg("assets/img/instagram_icon.svg") ?>
          </a>
        </div>
      <?php endif ?>
      <?php if ($site->facebook()->isNotEmpty()) : ?>
        <div class="social-media-icon">
          <a href="<?= $site->facebook()->html() ?>" title="Facebook" target="_blank">
            <?= svg("assets/img/facebook_icon.svg") ?>
          </a>
        </div>
      <?php endif ?>
      <?php if ($site->twitter()->isNotEmpty()) : ?>
        <div class="social-media-icon">
          <a href="<?= $site->twitter()->html() ?>" title="Twitter" target="_blank">
            <?= svg("assets/img/twitter_icon.svg") ?>
          </a>
        </div>
      <?php endif ?>
    </div>
  </nav>

</footer>
</main>
</body>

</html>