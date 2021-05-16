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
      <?php if ($site->instagram()->isNotEmpty()) : ?>
        <div class="social-media-icon">
          <a href="<?= $site->instagram()->html() ?>">
            <?= svg("assets/img/instagram_icon.svg") ?>
          </a>
        </div>
      <?php endif ?>
      <?php if ($site->facebook()->isNotEmpty()) : ?>
        <div class="social-media-icon">
          <a href="<?= $site->facebook()->html() ?>">
            <?= svg("assets/img/facebook_icon.svg") ?>
          </a>
        </div>
      <?php endif ?>
      <?php if ($site->twitter()->isNotEmpty()) : ?>
        <div class="social-media-icon">
          <a href="<?= $site->twitter()->html() ?>">
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