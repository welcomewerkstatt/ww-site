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

          $inventoryPageTemplate = $kirby->option('preya.kirby-ww-shortlinks.inventoryPageTemplate', 'items');

          $host = $kirby->environment()->host();

          if ($host == Url::domain($shortlinkUrl)) {

            $inventoryItemPage = $kirby->site()->index()->findBy('intendedTemplate', "items")->find($shortId);

            $linkedItemPage = $inventoryItemPage->internalPage()->toPage();

            if ($linkedItemPage !== null) {
              return $linkedItemPage;
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
    'inventoryPageTemplate' => 'items'
  ]
]);
