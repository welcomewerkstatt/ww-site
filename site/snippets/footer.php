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
      <div class="social-media-icon">
        <a href="<?= $site->instagram()->html() ?>">
          <?= svg("assets/img/instagram_icon.svg") ?>
        </a>
      </div>
      <div class="social-media-icon">
        <a href="<?= $site->facebook()->html() ?>">
          <?= svg("assets/img/facebook_icon.svg") ?>
        </a>
      </div>
      <div class="social-media-icon">
        <a href="<?= $site->twitter()->html() ?>">
          <?= svg("assets/img/twitter_icon.svg") ?>
        </a>
      </div>
    </div>
  </nav>

</footer>
</main>
</body>
<?php echo snippet('matomo') ?>
</html>