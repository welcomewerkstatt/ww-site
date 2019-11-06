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
      <p>Hiermit beantrage ich die Mitgliedschaft im Verein Welcome Werkstatt e.V.</p>
      <h4>Mitgliedsdaten</h4>
      <form id="memberForm" method="post" action="<?= $page->url() ?>">

        <div class="honeypot">
          <label for="website">Website <abbr title="required">*</abbr></label>
          <input type="website" id="website" name="website">
        </div>

        <div class="formRow">
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
        </div>
        <div class="formRow">
          <div class="field">
            <label for="street">
              Straße
            </label>
            <input type="text" id="street" name="street" value="<?= $data['street'] ?? '' ?>" required>
            <?= isset($alert['street']) ? '<span class="alert error">' . html($alert['street']) . '</span>' : '' ?>
          </div>
          <div class="field">
            <label for="houseNumber">
              Hausnummer
            </label>
            <input type="text" id="houseNumber" name="houseNumber" value="<?= $data['houseNumber'] ?? '' ?>" required>
            <?= isset($alert['houseNumber']) ? '<span class="alert error">' . html($alert['houseNumber']) . '</span>' : '' ?>
          </div>
        </div>
        <div class="formRow">
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
        </div>
        <div class="formRow">
          <div class="field">
            <label for="email">
              E-Mail
            </label>
            <input type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" required>
            <?= isset($alert['email']) ? '<span class="alert error">' . html($alert['email']) . '</span>' : '' ?>
          </div>
          <div class="field">
            <label for="phone">
              Telefon
            </label>
            <input type="text" id="phone" name="phone" value="<?= $data['email'] ?? '' ?>" required>
            <?= isset($alert['phone']) ? '<span class="alert error">' . html($alert['phone']) . '</span>' : '' ?>
          </div>
        </div>
        <div class="formRow">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="agree1" value="true" /> Ich stimme zu, dass meine persönlichen Daten mit anderen Vereinsmitgliedern geteilt werden dürfen.</label>
          </div>
        </div>
        <div class="formRow">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="agree2" value="true" /> Meine Daten dürfen an andere Vereinsmitglieder weitergegeben werden (optional).</label>
          </div>
        </div>




        <h4>Beiträge</h4>
        <p>Die einmalige Aufnahmegebühr beträgt zehn Euro. Der Mitgliedsbeitrag wird monatlich berechnet gemäß Beitragstabelle.</p>
        <p>Ich wähle die folgende Mitgliedschaft:</p>
        <div class="formRow">

          <div class="radio">
            <input type="radio" id="regular" name="membership" value="regular">
            <label for="regular">Ordentliche Mitgliedschaft</label>
            <label class="secondaryLabel" for="regular">Ordentliche Mitglieder zahlen den vollen Mitgliedsbeitrag und haben ein Stimmrecht auf allen Mitgliederversammlungen des Vereins. </label>
          </div>

          <div class="radio">
            <input type="radio" id="extra" name="membership" value="extra">
            <label for="extra">Fördermitgliedschaft</label>
            <label class="secondaryLabel" for="extra">Fördermitglieder unterstützen den Verein finanziell durch einen frei gewählten Monatsbeitrag. Sie haben kein Stimmrecht auf Mitgliederversammlungen. </label>
          </div>

        </div>
        <?= isset($alert['text']) ? '<span class="alert error">' . html($alert['text']) . '</span>' : '' ?>
        <input type="submit" name="submit" value="Absenden" class="button">
      </form>
    <?php endif ?>
  </section>
</div>