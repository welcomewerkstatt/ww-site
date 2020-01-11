<div class="content-row full-column grey"></div>
<div class="content-row main-column">
  <script>
    // Show JavaScript elements only when JS is enabled
    window.addEventListener('DOMContentLoaded', event => {
      document.querySelector('#hide-no-script').style.display = 'inline';
    });

    const validateAndUpdate = (evt) => {
      validateNumber(evt);
      const sponsorFee = document.querySelector("#sponsor-fee").value;
      console.log("New fee ", sponsorFee);
    }

    const validateNumber = (evt) => {
      const theEvent = evt || window.event;

      // Handle paste
      if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
      } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
      }
      var regex = /[0-9]|[\.,]/;
      if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
      }
    }

    const handleTierSelect = () => {
      togglePartnerNameInputDisplay();
      updateFee();
    }

    const handleMembershipTypeSelect = () => {
      const membership = document.querySelector('input[name="membership"]:checked').value;
      const sponsorFeeContainer = document.querySelector("#sponsor-fee-container");
      const tierSelectContainer = document.querySelector("#tier-select-container");

      if (membership === 'sponsor') {
        sponsorFeeContainer.style.display = 'block';
        tierSelectContainer.style.display = 'none';
      } else {
        sponsorFeeContainer.style.display = 'none';
        tierSelectContainer.style.display = 'block';
      }

    }

    const togglePartnerNameInputDisplay = () => {
      const tierSelectElement = document.querySelector('#tier-select');
      const selectedValue = tierSelectElement.options[tierSelectElement.selectedIndex].value;
      const partnerNameContainer = document.querySelector('#partner-name-container');

      if (selectedValue === 'partner') {
        partnerNameContainer.style.display = 'block';
      } else {
        partnerNameContainer.style.display = 'none';
      }

    }

    const updateFee = () => {
      const intervalFeeDisplayElement = document.querySelector('#fee-interval');
      const feeDisplayElement = document.querySelector('#fee');

      const tierSelectElement = document.querySelector('#tier-select');
      const intervalSelectElement = document.querySelector('#interval-select');

      const selectedInterval = intervalSelectElement.options[intervalSelectElement.selectedIndex].dataset.multiplicator;
      const selectedFee = tierSelectElement.options[tierSelectElement.selectedIndex].dataset.fee;

      intervalFeeDisplayElement.innerHTML = parseFloat(selectedFee) * parseInt(selectedInterval) + " Euro";
      feeDisplayElement.innerHTML = selectedFee + " Euro";

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
      <form id="member-form" method="post" action="<?= $page->url() ?>">

        <div class="honeypot">
          <label for="website">Website <abbr title="required">*</abbr></label>
          <input type="website" id="website" name="website" />
        </div>


        <div class="form-row">
          <div class="field">
            <label for="first-name">
              Vorname
            </label>
            <input type="text" id="first-name" name="first-name" value="<?= $data['first-name'] ?? '' ?>" required />
            <?= isset($alert['first-name']) ? '<span class="alert error">' . html($alert['first-name']) . '</span>' : '' ?>
          </div>
          <div class="field">
            <label for="last-name">
              Nachname
            </label>
            <input type="text" id="last-name" name="last-name" value="<?= $data['last-name'] ?? '' ?>" required />
            <?= isset($alert['last-name']) ? '<span class="alert error">' . html($alert['last-name']) . '</span>' : '' ?>
          </div>
        </div>
        <div class="form-row">
          <div class="field">
            <label for="street">
              Straße
            </label>
            <input type="text" id="street" name="street" value="<?= $data['street'] ?? '' ?>" required />
            <?= isset($alert['street']) ? '<span class="alert error">' . html($alert['street']) . '</span>' : '' ?>
          </div>
          <div class="field">
            <label for="house-number">
              Hausnummer
            </label>
            <input type="text" id="house-number" name="house-number" value="<?= $data['house-number'] ?? '' ?>" required />
            <?= isset($alert['house-number']) ? '<span class="alert error">' . html($alert['house-number']) . '</span>' : '' ?>
          </div>
        </div>
        <div class="form-row">
          <div class="field">
            <label for="plz">
              PLZ
            </label>
            <input type="text" id="plz" name="plz" value="<?= $data['plz'] ?? '' ?>" required />
            <?= isset($alert['plz']) ? '<span class="alert error">' . html($alert['plz']) . '</span>' : '' ?>
          </div>
          <div class="field">
            <label for="city">
              Ort
            </label>
            <input type="text" id="city" name="city" value="<?= $data['city'] ?? '' ?>" required />
            <?= isset($alert['city']) ? '<span class="alert error">' . html($alert['city']) . '</span>' : '' ?>
          </div>
        </div>
        <div class="form-row">
          <div class="field">
            <label for="email">
              E-Mail
            </label>
            <input type="email" id="email" name="email" value="<?= $data['email'] ?? '' ?>" required />
            <?= isset($alert['email']) ? '<span class="alert error">' . html($alert['email']) . '</span>' : '' ?>
          </div>
          <div class="field">
            <label for="phone">
              Telefon
            </label>
            <input type="text" id="phone" name="phone" value="<?= $data['phone'] ?? '' ?>" required />
            <?= isset($alert['phone']) ? '<span class="alert error">' . html($alert['phone']) . '</span>' : '' ?>
          </div>
        </div>
        <div class="form-row">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="agree1" value="true" /> Ich stimme zu, dass die oben genannten persönlichen Daten mit anderen Vereinsmitgliedern geteilt werden dürfen (optional).</label>
          </div>
        </div>

        <h4>Mitgliedschaft</h4>
        <p>Die einmalige Aufnahmegebühr beträgt zehn Euro. Der Mitgliedsbeitrag wird monatlich gemäß der <a href="beitragsordnung">Beitragsordnung zum Zeitpunkt dieses Antrags</a> berechnet.</p>
        <p>Ich wähle die folgende Mitgliedschaft:</p>
        <div class="form-row">

          <div class="radio">
            <input type="radio" id="regular" name="membership" value="regular" onclick="handleMembershipTypeSelect()" />
            <div class="radio-labels-container">
              <label for="regular">Ordentliche Mitgliedschaft</label>
              <label class="secondary-label" for="regular">Ordentliche Mitglieder zahlen den vollen Mitgliedsbeitrag und haben ein Stimmrecht auf allen Mitgliederversammlungen des Vereins. </label>
            </div>
          </div>

          <div class="radio">
            <input type="radio" id="extra" name="membership" value="sponsor" onclick="handleMembershipTypeSelect()" />
            <div class="radio-labels-container">
              <label for="extra">Fördermitgliedschaft</label>
              <label class="secondary-label" for="extra">Fördermitglieder unterstützen den Verein finanziell durch einen frei gewählten Monatsbeitrag. Sie haben kein Stimmrecht auf Mitgliederversammlungen. </label>
            </div>
          </div>
        </div>


        <div class="field" id="sponsor-fee-container" style="display: none;">
          <label for="sponsor-fee">
            Gewünschter Mitgliedsbeitrag:
          </label>
          <input type="number" step="0.01" min="5" id="sponsor-fee" name="sponsor-fee" onkeyup='validateAndUpdate(event)' value="<?= $data['sponsor-fee'] ?? '' ?>" />
          <label for="sponsor-fee">
            Euro.
          </label>
          <?= isset($alert['sponsor-fee']) ? '<span class="alert error">' . html($alert['sponsor-fee']) . '</span>' : '' ?>
        </div>



        <div class="field" id="tier-select-container">Ich wähle den Tarif für:
          <select name="tier" id="tier-select" onchange="handleTierSelect()">
            <option value="adult" data-fee="25">Erwachsene (ab 18)</option>
            <option value="partner" data-fee="7.50">Partner/Familie (im selben Haushalt)</option>
            <option value="youth" data-fee="15">Jugendliche (ab 14)</option>
            <option value="child" data-fee="7.50">Kinder (unter 14)</option>
            <option value="senior" data-fee="15">Senioren (ab 65)</option>
          </select>. <span id="hide-no-script" style="display:none;">Der monatliche Mitgliedsbeitrag beläuft sich demnach auf <span id="fee" style="font-weight: bold">25 Euro</span>.</span>
        </div>


        <div class="field" id="partner-name-container" style="display: none;">
          <label for="partner-name">
            Name des Partners:
          </label>
          <input type="text" id="partner-name" name="partner-name" value="<?= $data['partner-name'] ?? '' ?>" />
          <?= isset($alert['partner-name']) ? '<span class="alert error">' . html($alert['partner-name']) . '</span>' : '' ?>
        </div>


        <h4>Zahlungsweise</h4>
        <p>Ich möchte meinen Mitgliedsbeitrag
          <select name="interval" id="interval-select" onchange="updateFee()">
            <option value="monthly" data-multiplicator="1">monatlich</option>
            <option value="quarterly" data-multiplicator="3">quartalsweise</option>
            <option value="halfyear" data-multiplicator="6">halbjährlich</option>
            <option value="yearly" data-multiplicator="12">jährlich</option>
          </select> bezahlen. Für das gewählte Intervall beläuft sich der Mitgliedsbeitrag auf <span id="fee-interval" style="font-weight: bold">25 Euro</span>. Ich bezahle mittels:</p>
        <div class="form-row">

          <div class="radio">
            <input type="radio" id="bankTransfer" name="payment" value="bankTransfer" />
            <div class="radio-labels-container">
              <label for="bankTransfer">Banküberweisung/Dauerauftrag</label>
              <label class="secondary-label" for="bankTransfer">Ich überweise die Beiträge manuell beziehungsweise kümmere mich um die Einrichtung eines Dauerauftrags. </label>
              <div class="account-info">
                Bitte richte deine Überweisung an folgendes Konto:<br /><br />
                <div class="line">
                  <div>Inhaber:&nbsp;</div>
                  <div>Welcome Werkstatt e.V.</div>
                </div>
                <div class="line">
                  <div>IBAN:&nbsp;</div>
                  <div>DE31 2005 0550 1240 1316 70</div>
                </div>
                <div class="line">
                  <div>BIC:&nbsp;</div>
                  <div>HASPDEHHXXX</div>
                </div>
                <div class="line">
                  <div>Bank:&nbsp;</div>
                  <div>Hamburger Sparkasse</div>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="radio">
            <input type="radio" id="sepaRecurring" name="payment" value="sepaRecurring" />
            <div class="radio-labels-container">
              <label for="sepaRecurring">SEPA-Lastschriftmandat</label>
              <label class="secondary-label" for="sepaRecurring">Ich erstelle ein SEPA-Mandat und die Beiträge werden automatisch von meinem Konto abgebucht.</label>
              <div>
                <div class="field">
                  <label for="sepa-owner">
                    Kontoinhaber
                  </label>
                  <input type="text" id="sepa-owner" name="sepa-owner" value="<?= $data['sepa-owner'] ?? '' ?>" />
                  <?= isset($alert['sepa-owner']) ? '<span class="alert error">' . html($alert['sepa-owner']) . '</span>' : '' ?>
                </div>
                <div class="field">
                  <label for="sepa-bank">
                    Bank
                  </label>
                  <input type="text" id="sepa-bank" name="sepa-bank" value="<?= $data['sepa-bank'] ?? '' ?>" />
                  <?= isset($alert['sepa-bank']) ? '<span class="alert error">' . html($alert['sepa-bank']) . '</span>' : '' ?>
                </div>
                <div class="field">
                  <label for="sepa-iban">
                    IBAN
                  </label>
                  <input type="text" id="sepa-iban" name="sepa-iban" value="<?= $data['sepa-iban'] ?? '' ?>" />
                  <?= isset($alert['sepa-iban']) ? '<span class="alert error">' . html($alert['sepa-iban']) . '</span>' : '' ?>
                </div>
                <div class="field">
                  <label for="sepa-bic">
                    BIC
                  </label>
                  <input type="text" id="sepa-bic" name="sepa-bic" value="<?= $data['sepa-bic'] ?? '' ?>" />
                  <?= isset($alert['sepa-bic']) ? '<span class="alert error">' . html($alert['sepa-bic']) . '</span>' : '' ?>
                </div>
              </div>
            </div>

          </div> -->

        </div>
        <div><span style="font-weight: bold">Hinweis:</span> Momentan können wir leider nur die Zahlung via Überweisung anbieten. Wir arbeiten an der Einführung weiterer Zahlungsarten.</div>

        <input type="submit" name="submit" value="Absenden" class="button" />


      </form>
    <?php endif ?>
  </section>
</div>