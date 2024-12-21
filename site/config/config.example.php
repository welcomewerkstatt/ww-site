<?php

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen. 
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */
return [
    'debug' => true,
    'panel' => [
        'language' => 'de',
    ],
    'sitemap.ignore' => ['internes', 'inventar'],
    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => function ($page) {
                $prefixes = ['kalender', 'home', 'internes'];
                foreach ($prefixes as $prefix) {
                    $startsWithPrefix = !boolval(strncmp($page, $prefix, strlen($prefix)));
                    if ($startsWithPrefix) {
                      return $startsWithPrefix;
                    }
                }
                return false;
            }
        ]
    ],
    'thumbs' => [
        'presets' => [
            'header' => ['width' => 600, 'quality' => 80]
        ]
    ],
    'bvdputte.fingerprint.parameter' => true,
    'welcome-werkstatt.werkstatt' => [
        'easyverein' => [
            'apiKey' => 'abc123',
            'apiBaseUrl' => 'https://easyverein.com/api/v1.6/',
            'activeMembersGroupId' => '12345678',
        ],
    ],
    'db' => [
        'type'     => 'sqlite',
        'database' => '/Users/someone/ww-site/inventory.db'
    ]
];
