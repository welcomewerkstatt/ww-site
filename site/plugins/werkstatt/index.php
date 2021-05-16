<?php

// Usage: (button: link/target caption: My button)

Kirby::plugin(
  'welcome-werkstatt/werkstatt',
  [
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

    ],
    'routes' => [
      // Redirects from old website
      [
        'pattern' => 'raeume',
        'action' => function () {
          go('/werkstatt/holzarbeiten', 301);
        }
      ],
      // Sitemap for Google 
      [
        'pattern' => 'sitemap.xml',
        'action'  => function () {
          $pages = site()->pages()->index();

          // fetch the pages to ignore from the config settings,
          // if nothing is set, we ignore the error page
          $ignore = kirby()->option('sitemap.ignore', ['error']);
          $internal = page('internes')->children()->pluck('id', ',');
          $ignore = array_merge($ignore, $internal);

          $content = snippet('sitemap', compact('pages', 'ignore'), true);

          // return response with correct header type
          return new Kirby\Cms\Response($content, 'application/xml');
        }
      ],
      [
        'pattern' => 'sitemap',
        'action'  => function () {
          return go('sitemap.xml', 301);
        }
      ]
    ],
  ]
);
