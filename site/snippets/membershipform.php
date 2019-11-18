<div class="content-row full-column grey"></div>
<div class="content-row main-column">
  <script>
    // Show JavaScript elements only when JS is enabled
    window.addEventListener('DOMContentLoaded', event => {
      document.querySelector('#hideNoScript').style.display='inline'
    });

    const tierSelectHandler = element => {
      const selectedFee = element.options[element.selectedIndex].dataset.fee;
      const selectedValue = element.options[element.selectedIndex].value;
      const feeDisplayElement = document.querySelector('#fee');
      const partnerNameContainer = document.querySelector('#partnerNameContainer');

      if (selectedValue === 'partner') {
        partnerNameContainer.style.display = 'block';
      } else {
        partnerNameContainer.style.display = 'none';
      }
      feeDisplayElement.innerHTML = selectedFee;
    }
  </script>
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
      <p>Durch das Übersenden des folgenden Formulars beantrage ich die Mitgliedschaft im Verein Welcome Werkstatt e.V.:</p>
      <h4>Persönliche Daten</h4>
      <form id="memberForm" method="post" action="<?= $page->url() ?>">

        <div class="honeypot">
          <label for="website">Website <abbr title="required">*</abbr></label>
          <input type="website" id="website" name="website">
        </div>

        <div class="formRow">
          <div class="field">
            <label for="firstName">
              Vorname
            </label>
            <input type="text" id="firstName" name="firstName" value="<?= $data['firstName'] ?? '' ?>" required>
            <?= isset($alert['firstName']) ? '<span class="alert error">' . html($alert['firstName']) . '</span>' : '' ?>
          </div>
          <div class="field">
            <label for="lastName">
              Nachname
            </label>
            <input type="text" id="lastName" name="lastName" value="<?= $data['lastName'] ?? '' ?>" required>
            <?= isset($alert['lastName']) ? '<span class="alert error">' . html($alert['lastName']) . '</span>' : '' ?>
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
            <input type="text" id="phone" name="phone" value="<?= $data['phone'] ?? '' ?>" required>
            <?= isset($alert['phone']) ? '<span class="alert error">' . html($alert['phone']) . '</span>' : '' ?>
          </div>
        </div>
        <div class="formRow">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="agree1" value="true" /> Ich stimme zu, dass die oben genannten persönlichen Daten mit anderen Vereinsmitgliedern geteilt werden dürfen (optional).</label>
          </div>
        </div>

        <h4>Mitgliedschaft</h4>
        <p>Die einmalige Aufnahmegebühr beträgt zehn Euro. Der Mitgliedsbeitrag wird monatlich gemäß der <a href="beitragsordnung">Beitragsordnung zum Zeitpunkt dieses Antrags</a> berechnet.</p>
        <p>Ich wähle die folgende Mitgliedschaft:</p>
        <div class="formRow">

          <div class="radio">
            <input type="radio" id="regular" name="membership" value="regular">
            <div class="radioLabelsContainer">
              <label for="regular">Ordentliche Mitgliedschaft</label>
              <label class="secondaryLabel" for="regular">Ordentliche Mitglieder zahlen den vollen Mitgliedsbeitrag und haben ein Stimmrecht auf allen Mitgliederversammlungen des Vereins. </label>
            </div>
          </div>

          <div class="radio">
            <input type="radio" id="extra" name="membership" value="extra">
            <div class="radioLabelsContainer">
              <label for="extra">Fördermitgliedschaft</label>
              <label class="secondaryLabel" for="extra">Fördermitglieder unterstützen den Verein finanziell durch einen frei gewählten Monatsbeitrag. Sie haben kein Stimmrecht auf Mitgliederversammlungen. </label>
            </div>
          </div>

        </div>
        <p>Ich wähle den Tarif für:
          <select name="tier" id="tier-select" onchange="tierSelectHandler(this)">
            <option value="adult" data-fee="25 Euro">Erwachsene (ab 18)</option>
            <option value="partner" data-fee="7,50 Euro">Partner/Familie (im selben Haushalt)</option>
            <option value="youth" data-fee="15 Euro">Jugendliche (ab 14)</option>
            <option value="child" data-fee="7,50 Euro">Kinder (unter 14)</option>
            <option value="senior" data-fee="15 Euro">Senioren (ab 65)</option>
          </select>. <span id="hideNoScript" style="display:none;">Der monatliche Mitgliedsbeitrag beläuft sich demnach auf <span id="fee" style="font-weight: bold">25 Euro</span>.</span>
        </p>


        <div class="field" id="partnerNameContainer" style="display: none;">
          <label for="partnerName">
            Name des Partners:
          </label>
          <input type="text" id="partnerName" name="partnerName" value="<?= $data['partnerName'] ?? '' ?>">
          <?= isset($alert['partnerName']) ? '<span class="alert error">' . html($alert['partnerName']) . '</span>' : '' ?>
        </div>


        <h4>Zahlungsweise</h4>
        <p>Ich möchte meinen Mitgliedsbeitrag
          <select name="interval" id="interval-select">
            <option value="monthly">monatlich</option>
            <option value="quarterly">quartalsweise</option>
            <option value="halfyear">halbjährlich</option>
            <option value="yearly">jährlich</option>
          </select> bezahlen, und zwar via:</p>
        <div class="formRow">

          <div class="radio">
            <input type="radio" id="bankTransfer" name="payment" value="bankTransfer">
            <div class="radioLabelsContainer">
              <label for="bankTransfer">Banküberweisung/Dauerauftrag</label>
              <label class="secondaryLabel" for="bankTransfer">Ich überweise die Beiträge manuell beziehungsweise kümmere mich um die Einrichtung eines Dauerauftrags. </label>
              <div>
                <p>Bitte richte deine Überweisung an folgendes Konto:<br /><br />
                  <strong>Inhaber:</strong> Welcome Werkstatt e.V.<br />
                  <strong>IBAN:</strong> DE31 2005 0550 1240 1316 70<br />
                  <strong>BIC:</strong> HASPDEHHXXX<br />
                  <strong>Bank:</strong> Hamburger Sparkasse
                </p>
              </div>
            </div>
          </div>

          <div class="radio">
            <input type="radio" id="sepaRecurring" name="payment" value="sepaRecurring">
            <div class="radioLabelsContainer">
              <label for="sepaRecurring">SEPA-Lastschriftmandat</label>
              <label class="secondaryLabel" for="sepaRecurring">Ich erstelle ein SEPA-Mandat und die Beiträge werden automatisch von meinem Konto abgebucht.</label>
              <div>
                <div class="field">
                  <label for="sepaOwner">
                    Kontoinhaber
                  </label>
                  <input type="text" id="sepaOwner" name="sepaOwner" value="<?= $data['sepaOwner'] ?? '' ?>">
                  <?= isset($alert['sepaOwner']) ? '<span class="alert error">' . html($alert['sepaOwner']) . '</span>' : '' ?>
                </div>
                <div class="field">
                  <label for="sepaBank">
                    Bank
                  </label>
                  <input type="text" id="sepaBank" name="sepaBank" value="<?= $data['sepaBank'] ?? '' ?>">
                  <?= isset($alert['sepaBank']) ? '<span class="alert error">' . html($alert['sepaBank']) . '</span>' : '' ?>
                </div>
                <div class="field">
                  <label for="sepaIban">
                    IBAN
                  </label>
                  <input type="text" id="sepaIban" name="sepaIban" value="<?= $data['sepaIban'] ?? '' ?>">
                  <?= isset($alert['sepaIban']) ? '<span class="alert error">' . html($alert['sepaIban']) . '</span>' : '' ?>
                </div>
                <div class="field">
                  <label for="sepaBic">
                    BIC
                  </label>
                  <input type="text" id="sepaBic" name="sepaBic" value="<?= $data['sepaBic'] ?? '' ?>">
                  <?= isset($alert['sepaBic']) ? '<span class="alert error">' . html($alert['sepaBic']) . '</span>' : '' ?>
                </div>
              </div>
            </div>

          </div>
        </div>

        <input type="submit" name="submit" value="Absenden" class="button">


      </form>
    <?php endif ?>
  </section>
</div>