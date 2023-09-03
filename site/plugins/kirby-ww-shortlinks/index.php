<?php

use Kirby\Http\Url;

Kirby::plugin('preya/kirby-ww-shortlinks', [
  'routes' => function ($kirby) {
    return [
      [
        'pattern' => '(:alphanum)',
        'action' => function ($shortId) use ($kirby) {

          $urlOptions = $kirby->option('url');

          if (!is_array($urlOptions)) $this->next();

          $shortlinkUrl = $urlOptions[$kirby->option('preya.kirby-ww-shortlinks.shortlinkUrlArrayIdx')];

          $errorRedirectTarget = $urlOptions[$kirby->option('preya.kirby-ww-shortlinks.errorRedirectUrlArrayIdx')];

          $inventoryTemplate = $kirby->option('preya.kirby-ww-shortlinks.inventoryTemplate');

          $host = $kirby->environment()->host();

          if ($host == Url::domain($shortlinkUrl)) {

            $inventoryItem = $kirby->site()->pages()->template($inventoryTemplate)->first()->items()->toStructure()->findBy("invnum", $shortId);

            if ($inventoryItem !== null) {
              $targetPage = $inventoryItem->internalPage()->toPage();

              if ($targetPage == null) {
                go($errorRedirectTarget, 301);
              }
              return $targetPage;
            } else {


              go($errorRedirectTarget, 301);
            }
          } else {
            // Find next match
            $this->next();
          }
        }

      ]
    ];
  },
  'options' => [
    'shortlinkUrlArrayIdx' => 1,
    'errorRedirectUrlArrayIdx' => 0,
    'inventoryTemplate' => 'inventory'
  ]
]);
