<div class="content-row full-column grey"></div>
<div class="content-row main-column">
  <section class="content">
    <h2><?= $page->title()->kt() ?></h2>
    <?php if ($success) : ?>
      <div class="alert success">
        <p><?= $success ?></p>
      </div>
    <?php else : ?>
      <?php if (isset($alert['error'])) : ?>
        <div><?= $alert['error'] ?></div>
      <?php endif ?>
      <p>Hiermit beantrage ich die Mitgliedschaft im Verein Welcome Werkstatt e.V</p>
      <h4>Mitgliedsdaten</h4>
      <form method="post" action="<?= $page->url() ?>">

        <div class="honeypot">
          <label for="website">Website <abbr title="required">*</abbr></label>
          <input type="website" id="website" name="website">
        </div>

        <div class="field">
          <label for="firstname">
            Vorname
          </label>
          <input type="text" id="firstname" name="firstname" value="<?= $data['firstname'] ?? '' ?>" required>
          <?= isset($alert['firstname']) ? '<span class="alert error">' . html($alert['firstname']) . '</span>' : '' ?>
        </div>
        <div class="field">
          <label for="lastname">
            Nachname
          </label>
          <input type="text" id="lastname" name="lastname" value="<?= $data['lastname'] ?? '' ?>" required>
          <?= isset($alert['lastname']) ? '<span class="alert error">' . html($alert['lastname']) . '</span>' : '' ?>
        </div>
        <div class="field">
          <label for="address">
            Anschrift
          </label>
          <input type="text" id="address" name="address" value="<?= $data['address'] ?? '' ?>" required>
          <?= isset($alert['address']) ? '<span class="alert error">' . html($alert['address']) . '</span>' : '' ?>
        </div>
        <div class="field">
          <label for="plz">
            PLZ
          </label>
          <input type="text" id="plz" name="plz" value="<?= $data['plz'] ?? '' ?>" required>
          <?= isset($alert['plz']) ? '<span class="alert error">' . html($alert['plz']) . '</span>' : '' ?>
        </div>
        <div class="field">
          <label for="city">
            Ort
          </label>
          <input type="text" id="city" name="city" value="<?= $data['city'] ?? '' ?>" required>
          <?= isset($alert['city']) ? '<span class="alert error">' . html($alert['city']) . '</span>' : '' ?>
        </div>
        <div class="field">
          <label for="email">
            E-Mail
          </label>
          <input type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" required>
          <?= isset($alert['email']) ? '<span class="alert error">' . html($alert['email']) . '</span>' : '' ?>
        </div>
        <div class="field">
          <label for="text">
            Bemerkungen
          </label>
          <textarea id="text" name="text" required>
                    <?= $data['text'] ?? '' ?>
                </textarea>
          <?= isset($alert['text']) ? '<span class="alert error">' . html($alert['text']) . '</span>' : '' ?>
        </div>
        <h4>Beiträge</h4>
        <div class="field">
          <label for="text">
            Bemerkungen
          </label>
          <textarea id="text" name="text" required>
                    <?= $data['text'] ?? '' ?>
                </textarea>
          <?= isset($alert['text']) ? '<span class="alert error">' . html($alert['text']) . '</span>' : '' ?>
        </div>
        <input type="submit" name="submit" value="Absenden" class="button">
      </form>
    <?php endif ?>
  </section>
</div>