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
        'language' => 'de'
    ],
    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => ['kalender']
        ]
    ],
    'thumbs' => [
        'presets' => [
            'header' => ['width' => 600, 'quality' => 80]
        ]
    ],
    'pedroborges.meta-tags.default' => function ($page, $site) {
        return [
            'title' => $page->title() . ' | ' . $site->title(),
            'meta' => [
                'description' => $page->text()->short(300)
            ],
            'link' => [
                'canonical' => $page->url()
            ],
            'og' => [
                'title' => $page->title(),
                'type' => 'website',
                'site_name' => $site->title(),
                'url' => $page->url(),
                'image' => $page->hasImages() ? $page->images()->sortBy('sort')->first()->thumb('header')->url() : $site->images()->sortBy('sort')->first()->thumb('header')->url(),
                'description' => $page->text()->short(300),
                'locale' => 'de_DE'
            ],
            'twitter' => [
                'site' => '@WelcomeWerk'
            ]

        ];
    },
    'sylvainjule.matomo.url'        => 'xxx',
    'sylvainjule.matomo.id'         => 'xxx',
    'sylvainjule.matomo.token'      => 'xxx',
];
