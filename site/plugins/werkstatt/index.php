<?php

// Usage: (button: link/target caption: My button)

Kirby::plugin('welcome-werkstatt/werkstatt', [
  'tags' => [
    'button' => [
      'attr' => [
        'caption',
        'icon'
      ],
      'html' => function ($tag) {
        $target = Url::to($tag->value);
        $icon = empty($tag->icon) ? '' : '<img style="display: inline-block; width: auto" width="16px" height="16px" src="/assets/img/download.svg" /> ';

        return '<a class="button" href="' . $target . '"/>' . $icon .'<span style="display: inline-block;">'. $tag->caption . '</span></a>';
      }
    ],
    'external' => [
      'html' => function ($tag) {
        $external = file_get_contents($tag->value);
        return $external;
      }
    ],
    'embed' => [
      'html' => function ($tag) {
        return '<div class="embed-container">' . $tag->value . '</div>';
      }
    ]
  ]
]);
