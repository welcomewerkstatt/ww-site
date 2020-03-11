<?php

Kirby::plugin('welcome-werkstatt/mapbox-embed', [
  'tags' => [
    'mapbox' => [
      'html' => function ($tag) {
        return '<div id="map"></div>' . css('media/plugins/welcome-werkstatt/mapbox-embed/css/map.css') . js('/media/plugins/welcome-werkstatt/mapbox-embed/js/mapbox-gl.js') . js('/media/plugins/welcome-werkstatt/mapbox-embed/js/map.js');
      }
    ]
  ]
]);
