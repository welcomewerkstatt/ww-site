<?php

// This is a plugin containing multiple, small additions and fixes for
// the Welcome Werkstatt website, that are not modular enough to be
// their own plugin.

Kirby::plugin(
  'welcome-werkstatt/werkstatt',
  [
    'blueprints' => [
      'blocks/embed' => __DIR__ . '/blueprints/blocks/embed.yml'
    ],
    'snippets' => [
      'blocks/embed' => __DIR__ . '/snippets/blocks/embed.php'
    ],
    'tags' => [
      'external' => [
        'html' => function ($tag) {
          return file_get_contents($tag->value);
        }
      ],
      'embed' => [
        'html' => function ($tag) {
          return '<div class="embed-container">' . $tag->value . '</div>';
        }
      ],
      'membercount' => [
        'attr' => ['fallback'],
        'html' => function ($tag) {
          $apiCache = kirby()->cache('welcome-werkstatt.werkstatt');
          $cachedData = $apiCache->get('membercount');

          if ($cachedData === null) {
            // 'query={}' means that we're not returning any actual member information,
            // only empty objects and the overall count
            $apiUrl = option('welcome-werkstatt.werkstatt.easyverein.apiBaseUrl') . 'member/?query={}&memberGroups=' . option('welcome-werkstatt.werkstatt.easyverein.activeMembersGroupId');

            $curl_session = curl_init();
            curl_setopt($curl_session, CURLOPT_URL, $apiUrl);
            curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl_session, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt(
              $curl_session,
              CURLOPT_HTTPHEADER,
              [
                'Authorization: Token ' . option('welcome-werkstatt.werkstatt.easyverein.apiKey')
              ]
            );
            $result = curl_exec($curl_session);
            $http_status = curl_getinfo($curl_session, CURLINFO_RESPONSE_CODE);
            curl_close($curl_session);

            if ($result && ($http_status == 200)) {
              $result = json_decode($result, true);
              if ($memberCount = $result['count']) {
                // 24 hours * 60 mins = 1440 mins
                $apiCache->set('membercount', $memberCount, 1440);
                return $memberCount;
              }
            }
            return $tag->fallback ?? '';
          } else {
            return $cachedData;
          }
        }
      ],
    ],
    'routes' => [
      // Redirects from old website
      [
        'pattern' => 'raeume',
        'action' => function () {
          go('/werkstatt/holzarbeiten', 301);
        }
      ],
    ],
    'options' => [
      'cache' => true
    ],
    'siteMethods' => [
      'invcount' => function () {
        $lastCount = $this->index()->findBy('intendedTemplate', 'items')->children()->sortBy("invnum", "desc")->first()->invnum()->toInt();

        return $lastCount + 1;
      }
    ],
  ]
);
