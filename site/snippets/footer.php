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
              <a href="https://www.instagram.com/welcome.werkstatt/">
                <?= svg("assets/img/instagram_icon.svg") ?>
              </a>
            </div>
            <div class="social-media-icon">
              <a href="https://www.facebook.com/welcome.werkstatt/">
                <?= svg("assets/img/facebook_icon.svg") ?>
              </a>
            </div>
            <div class="social-media-icon">
              <a href="https://twitter.com/WelcomeWerk">
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