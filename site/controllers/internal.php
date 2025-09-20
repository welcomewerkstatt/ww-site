<?php

use Kirby\Http\Url;

/**
 * This controller handles authorization for internal pages, which are only supposed
 * to be accessible to logged-in users or via valid referer (i.e. from within Nextcloud).
 */
return function ($kirby) {

  $error = false;
  $session = $kirby->session();
  $user = false;
  $refererIsValid = false;
  $hasMenu = true;

  $host = $kirby->environment()->host();
  $urlOptions = $kirby->option('url');

  if (!is_array($urlOptions) || count($urlOptions) < 2) {
    return [
      'error' => false,
      'hasMenu' => true
    ];
  }

  $shortlinkUrl = $urlOptions[$kirby->option('preya.kirby-ww-shortlinks.shortlinkUrlArrayIdx')];
  $refererHeader = $kirby->request()->header('Referer');

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
    if (!$user && !empty($refererHeader)) {
      $refererIsValid = (bool) strpos($kirby->request()->header('Referer'), "welcome-werkstatt.de");

      $error = !$refererIsValid;
    }


    if ($host == Url::domain($shortlinkUrl)) {
      $hasMenu = false;
      $error = false;
    }
  }

  $retVal = [
    'error' => $error,
    // 'debug' => json_encode(["Headers" => $kirby->request()->headers(), "RefererIsValid" => $refererIsValid, "RefererHeader" => print_r($kirby->request()->header('Referer'), true), "User" => print_r($user, true)])
    'hasMenu' => $hasMenu
  ];

  return $retVal;
};
