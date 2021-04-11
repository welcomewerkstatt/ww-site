<?php

// Check for valid "referer" value to show page or not
return function ($kirby) {

  $error = false;
  $debug = $kirby->request()->headers();
  $session = $kirby->session();
  $user = false;
  $refererIsValid = false;


  if ($kirby->request()->is('GET')) {
    // Check session first for auth info
    if ($session) {
      try {
        $user = $kirby->auth()->user($session);
      } catch (Exception $e) {
        $error = true;
      }
    }

    // Check referer
    if (!$user) {
      $refererIsValid = strpos($kirby->request()->header('Referer'), "welcome-werkstatt.de");

      if (!$refererIsValid) {
        $error = true;
      }
    }
  }

  return [
    'error' => $error,
    'debug' => json_encode(["Headers" => $debug, "RefererIsValid" => $refererIsValid, "User" => print_r($user, true)])
  ];
};
