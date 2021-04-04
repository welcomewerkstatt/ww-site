<?php

// Make sure that basic auth header is present and has valid credentials
return function ($kirby) {

  $error = false;

  if ($kirby->request()->is('GET')) {
    try {
      $auth = $kirby->request()->auth();
      if ($auth) {
        $user = $auth()->username();
        $password = $auth()->password();
        $kirby->auth()->login($user, $password);
      }
    } catch (Exception $e) {
      $error = true;
    }
  }

  return [
    'error' => $error,
  ];
};
