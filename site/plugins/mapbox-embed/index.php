<?php

Kirby::plugin('welcome-werkstatt/mapbox-embed', [
  'snippets' => [
    'includes' => __DIR__ . '/snippets/includes.php'
  ],
  'tags' => [
    'mapbox' => [
      'html' => function ($tag) {
        return '<div id="map"></div>' . css('media/plugins/welcome-werkstatt/mapbox-embed/css/map.css') . js('/media/plugins/welcome-werkstatt/mapbox-embed/js/mapbox-gl.js', ['defer' => true]) . js('/media/plugins/welcome-werkstatt/mapbox-embed/js/map.js', ['defer' => true]);
      }
    ]
  ]
]);
