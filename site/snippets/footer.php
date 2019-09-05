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
        </nav>
      </footer>
    </main>
  </body>

</html>