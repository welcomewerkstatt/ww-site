<?php

Kirby::plugin('werkstatt/button', [
  'tags' => [
    'button' => [
      'attr' => [
        'caption'
      ],
      'html' => function($tag) {

        return '<a class="button" href="' . $tag->value . '"/>'.$tag->caption.'</a>';

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