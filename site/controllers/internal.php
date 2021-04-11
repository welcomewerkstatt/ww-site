<?php

// Make sure that basic auth header is present and has valid credentials
return function ($kirby) {

  $error = false;
  $debug = json_encode($kirby->request()->headers());

  if ($kirby->request()->is('GET')) {
    // Try looking for params first
    $user = urldecode(param('user'));
    $password = urldecode(param('pass'));

    // If no params are found, try auth header
    if (is_null($user) || is_null($password)) {
      if ($auth = $kirby->request()->auth()) {
        $user = $auth()->username();
        $password = $auth()->password();
      } else {
        // No params and no auth header
        $error = true;
      }
    } else {
      try {
        $kirby->auth()->login($user, $password);
      } catch (Exception $e) {
        $error = true;
      }
    }
  }

  return [
    'error' => $error,
    'debug' => $debug
  ];
};
