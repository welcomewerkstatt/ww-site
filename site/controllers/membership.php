<?php
return function ($kirby, $pages, $page) {

  $alert = null;

  if ($kirby->request()->is('POST') && get('submit')) {

    // check the honeypot
    if (empty(get('website')) === false) {
      go($page->url());
      exit;
    }

    var_dump(get());

    $data = [
      'firstName'  => get('first-name'),
      'lastName'  => get('last-name'),
      'street'  => get('street'),
      'houseNumber'  => get('house-number'),
      'plz'  => get('plz'),
      'city'  => get('city'),
      'email' => get('email'),
      'phone'  => get('phone'),
      'agree1'  => get('agree1'),
      'partner'  => get('partner'),
      'sepaOwner'  => get('sepa-owner'),
      'sepaBank'  => get('sepa-bank'),
      'sepaIban'  => get('sepa-iban'),
      'sepaBic'  => get('sepa-bic'),
    ];

    $rules = [
      'firstName'  => ['required', 'min' => 2],
      'lastName'  => ['required', 'min' => 2],
      'street'  => ['required', 'min' => 2],
      'houseNumber'  => ['required', 'alphanum'],
      'plz'  => ['required', 'num', 'size' => 5],
      'city'  => ['required', 'min' => 2],
      'email' => ['required', 'email'],
      'phone'  => ['required', 'min' => 4],
      'agree1'  => ['accepted'],
      'partner'  => ['accepted'],
      'sepaOwner'  => ['min' => 2],
      'sepaBank'  => ['min' => 2],
      'sepaIban'  => ['min' => 2],
      'sepaBic'  => ['min' => 2]
    ];

    $messages = [
      'firstName'  => 'Bitte gib einen gültigen Vornamen ein.',
      'lastName'  => 'Bitte gib einen gültigen Nachnamen ein.',
      'street'  => 'Bitte gib eine gültige Straße ein.',
      'houseNumber'  => 'Bitte gib eine gültige Hausnummer ein.',
      'plz'  => 'Bitte gib eine gültige Postleitzahl ein.',
      'city'  => 'Bitte gib eine gültige Stadt ein.',
      'email' => 'Bitte gib eine gültige Mailadresse ein.',
      'phone'  => 'Bitte gib eine gültige Telefonnummer ein.',
      'agree1'  => 'Bitte akzeptiere die Datenweitergabe.',
      'sepaOwner'  => 'Bitte gib einen gültigen Kontoinhaber ein.',
      'sepaBank'  => 'Bitte gib eine gültige Bank ein.',
      'sepaIban'  => 'Bitte gib eine gültige IBAN ein.',
      'sepaBic'  => 'Bitte gib eine gültige BIC ein.'
    ];

    // some of the data is invalid
    if ($invalid = invalid($data, $rules, $messages)) {
      $alert = $invalid;

      // the data is fine, let's send the email
    } else {
      try {
        $kirby->email([
          'template' => 'email',
          'from'     => 'info@welcome-werkstatt.de',
          'replyTo'  => $data['email'],
          'to'       => 'moritz.stueckler@gmail.com',
          'subject'  => esc($data['name']) . ' sent you a message from your contact form',
          'data'     => [
            'text'   => esc($data['text']),
            'sender' => esc($data['name'])
          ]
        ]);
      } catch (Exception $error) {
        $alert['error'] = "The form could not be sent";
      }

      // no exception occured, let's send a success message
      if (empty($alert) === true) {
        $success = 'Your message has been sent, thank you. We will get back to you soon!';
        $data = [];
      }
    }
  }

  return [
    'alert'   => $alert,
    'data'    => $data ?? false,
    'success' => $success ?? false
  ];
};
