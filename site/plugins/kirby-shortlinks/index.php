<?php

Kirby::plugin('preya/kirby-shortlinks', [
  'routes' => function ($kirby) {
    return [
      [
        'pattern' => '(:alphanum)',
        'action' => function ($shortId) use ($kirby) {
          if ($kirby->environment()->host() == "wwrk.test") {
            
            return '<html><body>'.print_r($kirby->site()->pages()->template("inventory")->first()->items()->toStructure()->findBy("invnum", $shortId)->shortlinkTarget()).'</body></html>';

          }
          // Find next match
          $this->next();
        }
      ]
    ];
  }
]);
