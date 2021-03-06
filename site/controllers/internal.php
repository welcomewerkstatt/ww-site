<?php

// Check for valid "referer" value to show page or not
return function ($kirby) {

  $error = false;
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

    // Check referer for auth only if session did not yield user
    if (!$user) {
      $refererIsValid = (bool) strpos($kirby->request()->header('Referer'), "welcome-werkstatt.de");

      $error = !$refererIsValid;
    }
  }

  return [
    'error' => $error,
    // 'debug' => json_encode(["Headers" => $kirby->request()->headers(), "RefererIsValid" => $refererIsValid, "RefererHeader" => print_r($kirby->request()->header('Referer'), true), "User" => print_r($user, true)])
  ];
};
