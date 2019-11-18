<?php
return function ($kirby, $pages, $page) {

  $alert = null;

  if ($kirby->request()->is('POST') && get('submit')) {

    // check the honeypot
    if (empty(get('website')) === false) {
      go($page->url());
      exit;
    }

    $data = [
      'firstName'  => get('firstName'),
      'lastName'  => get('lastName'),
      'street'  => get('street'),
      'houseNumber'  => get('houseNumber'),
      'plz'  => get('plz'),
      'city'  => get('city'),
      'email' => get('email'),
      'phone'  => get('phone')
    ];


    var_dump($data);

    $rules = [
      'name'  => ['required', 'min' => 3],
      'email' => ['required', 'email'],
      'text'  => ['required', 'min' => 3, 'max' => 3000],
    ];

    $messages = [
      'name'  => 'Please enter a valid name',
      'email' => 'Please enter a valid email address',
      'text'  => 'Please enter a text between 3 and 3000 characters'
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
