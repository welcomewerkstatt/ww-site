<?php

// Check for valid "referer" value to show page or not
return function ($kirby) {

  $error = true;
  $debug = $kirby->request()->headers();

  if ($kirby->request()->is('GET')) {
    $refererIsValid = strpos($kirby->request()->header('Referer'), "welcome-werkstatt.de");
    if ($refererIsValid) {
      $error = false;
    }
  }

  return [
    'error' => $error,
    'debug' => json_encode(["Headers" => $debug, "RefererIsValid" => $refererIsValid, "User" => $kirby->user()])
  ];
};
