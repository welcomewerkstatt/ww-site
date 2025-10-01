<?php

return function ($page, $site, $pages, $kirby) {
  $shared = $kirby->controller('internal', compact('page', 'pages', 'site', 'kirby'));
  return $shared;
};
