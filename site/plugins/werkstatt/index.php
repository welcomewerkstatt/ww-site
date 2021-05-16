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
          $ignores = kirby()->option('sitemap.ignore', ['error']);
          // Allow ignore option to include children via 'page/*' syntax
          $ignoresExpanded = [];
          foreach ($ignores as $ignore) {
            if (str_ends_with($ignore, '/*')) {
              $ignore = substr($ignore, 0, -2);
              foreach ($pages as $page) {
                if (str_starts_with($page, $ignore)) {
                  array_push($ignoresExpanded, $page);
                }
              };
            }
          }
          $ignore = array_merge($ignores, $ignoresExpanded);
          $content = snippet('sitemap', compact('pages', 'ignore'), true);

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
