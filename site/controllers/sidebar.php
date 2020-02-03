<?php

use Sabre\VObject;

/**
 * This controller gets a shared calendar from an external URL and parses the next events into a usable form.
 * It uses the builtin Kirby cache to limit the amount of requests to the external calendar source.
 * It picks summary, start and end time/date and the url from the calendar entries and hands them to
 * a Kirby template.
 */
return function ($page, $kirby) {
  setlocale(LC_ALL, 'de_DE');
  $eventArray = array();
  $hasCalendar = false;
  $eventsToDisplay = $kirby->option('welcome-werkstatt.werkstatt.eventsToDisplay');
  // $hasCalendar = $page->mybuilder()->toBuilderBlocks()->keys();

  foreach ($page->mybuilder()->toBuilderBlocks() as $block) {
    if ($block->_key() == 'calendar') {
      $hasCalendar = true;
      $eventsToDisplay = $block->entries()->toInt();
      break;
    }
  }

  if ($hasCalendar) {
    $cache = $kirby->cache('welcome-werkstatt.werkstatt');
    $cachedContent = $cache->get('calendar');
    
    if (!$cachedContent) {
      // Cache miss
      
      // Curl Request
      $curlHandler = curl_init($kirby->option('welcome-werkstatt.werkstatt.calendarUrl'));
      curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
      $calendar = curl_exec($curlHandler);

      try {
        // Parse Calendar
        $vcalendar = VObject\Reader::read($calendar);
        $now = new DateTime();
        $threeMonthsFromNow = (new DateTime())->add(new DateInterval('P3M'));
        // Expand recurring events to be looped over
        $expandedVCalendar = $vcalendar->expand($now, $threeMonthsFromNow);
      } catch (Exception $e) {
        $expandedVCalendar = array();
      }

      if ($expandedVCalendar) {
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
      }

      $cache->set('calendar', $eventArray, 10);
    } else {
      // Cache hit
      $eventArray = $cachedContent;
    }

    return [
      'calendar' => $eventArray
    ];
  }
};
