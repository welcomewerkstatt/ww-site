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
    'thumbs' => [
        'presets' => [
            'header' => ['width' => 600, 'quality' => 80]
        ]
    ],
    'pedroborges.meta-tags.default' => function ($page, $site) {
        return [
            'title' => $page->title() . ' | ' . $site->title(),
            'meta' => [
                'description' => $site->description()
            ],
            'link' => [
                'canonical' => $page->url()
            ],
            'og' => [
                'title' => $page->title(),
                'type' => 'website',
                'site_name' => $site->title(),
                'url' => $page->url(),
                'image' => $page->hasImages() ? $page->images()->first()->thumb('header') : $site->images()->first()->thumb('header'),
                'description' => $site->description()
            ],
            'twitter' => [
                'site' => '@WelcomeWerk'
            ]

        ];
    }
];
