<?php

// Usage: (button: link/target caption: My button)

Kirby::plugin('werkstatt/button', [
  'tags' => [
    'button' => [
      'attr' => [
        'caption'
      ],
      'html' => function($tag) {
        $target = Url::to($tag->value);

        return '<a class="button" href="' . $target . '"/>'.$tag->caption.'</a>';

      }
    ],
    'external' => [
      'html' => function($tag) {
        $external = file_get_contents($tag->value);
        return $external;
      }
    ],
    'embed' => [
      'html' => function($tag) {
  	    return '<div class="embed">'.$tag->value.'</div>';
      }
    ]
  ]
]);