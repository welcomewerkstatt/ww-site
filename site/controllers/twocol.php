<?php

use Sabre\VObject;

/**
 * This controller gets a shared calendar from an external URL and parses the next events into a usable form.
 * It uses a small filesystem cache to limit the amount of requests to the external calendar source.
 * It picks summary, start and end time/date and the url from the calendar entries and hands them to
 * a Kirby template.
 */
return function ($page, $site, $kirby) {
  $calendarUrl = 'https://cloud.welcome-werkstatt.de/remote.php/dav/public-calendars/8t4DqWy9CHZDnBym?export';
  $cacheFile = 'site/cache/calendar.json';
  $eventsToDisplay = 4;

  setlocale(LC_ALL, 'de_DE');

  if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - 60 * 5))) {
    // Cache file is less than five minutes old.
    $eventArray = json_decode(file_get_contents($cacheFile), true);
  } else {
    // Curl Request
    $curlHandler = curl_init($calendarUrl);
    curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
    $calendar = curl_exec($curlHandler);

    // Parse Calendar
    $vcalendar = VObject\Reader::read($calendar);

    $now = new DateTime();
    $threeMonthsFromNow = (new DateTime())->add(new DateInterval('P3M'));

    // Expand recurring events to be looped over
    $expandedVCalendar = $vcalendar->expand($now, $threeMonthsFromNow);
    // echo "<pre>";
    // print_r($expandedVCalendar->serialize());
    // echo "</pre>";

    $eventArray = array();

    foreach ($expandedVCalendar->VEVENT as $event) {
      $localStartTime = $event->DTSTART->getDateTime()->setTimezone(new DateTimeZone('Europe/Berlin'));
      $localEndTime = $event->DTEND->getDateTime()->setTimezone(new DateTimeZone('Europe/Berlin'));

      array_push($eventArray, array(
        'summary' => (string) $event->SUMMARY,
        'startTs' => $localStartTime->getTimestamp(),
        'startDateString' => (string) strftime("%a, %e.%m.", $localStartTime->getTimestamp()),
        'startTimeString' => (string) $localStartTime->format('G:i'),
        'endTimeString' => (string) $localEndTime->format('G:i'),
        'url' => (string) $event->URL
      ));
    }


    // Sort by time
    uasort($eventArray, function ($a, $b) {
      return $a['startTs'] <=> $b['startTs'];
    });

    // Only use first entries
    $eventArray = array_slice($eventArray, 0, $eventsToDisplay);

    // var_dump($eventArray);  

    file_put_contents($cacheFile, json_encode($eventArray), LOCK_EX);
  }

  return [
    'calendar' => $eventArray
  ];
};
