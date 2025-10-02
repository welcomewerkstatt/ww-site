<?php

use WelcomeWerkstatt\Newsletter\EasyVerein;
use WelcomeWerkstatt\Newsletter\Brevo;
use WelcomeWerkstatt\Newsletter\Mailjet;

load(['WelcomeWerkstatt\Newsletter\EasyVerein' => __DIR__ . '/classes/EasyVerein.php']);
load(['WelcomeWerkstatt\Newsletter\Brevo' => __DIR__ . '/classes/Brevo.php']);
load(['WelcomeWerkstatt\Newsletter\Mailjet' => __DIR__ . '/classes/Mailjet.php']);


Kirby::plugin(
  'welcome-werkstatt/newsletter',
  [
    'areas' => [
      'site' => function () {
        return [
          'buttons' => [
            'sendNewsletter' => function ($page) {
              return [
                'icon'   => 'email',
                'text'   => 'Als E-Mail',
                'title'  => 'Als E-Mail versenden (nur für Admins)',
                'theme'  => 'pink',
                'dialog' => 'newsletter/?page=' . $page->uuid()->toString(),
              ];
            },
          ],
          'dialogs' => [
            'newsletter' => [
              'load' => function () {
                $page = page(get('page'));
                $easyVerein = new EasyVerein();

                $memberGroups = $easyVerein->getAllMemberGroups();
                $addressGroups = $easyVerein->getAllAddressGroups();

                $combinedGroups = array_merge($memberGroups, $addressGroups);

                $options = array_map(function ($group) {
                  return [
                    'value' => $group['type'] . ': ' . $group['id'],
                    'text'  => $group['type'] . ': ' . $group['name'].' ('.$group['count'].')',
                  ];
                }, $combinedGroups);

                return [
                  'component' => 'k-form-dialog',
                  'props' => [
                    'size' => 'medium',
                    'fields' => [
                      'instructions' => [
                        'label' => 'Newsletter versenden',
                        'type' => 'info',
                        'theme' => 'notice',
                        'text' => 'Achtung: Hier kann eine E-Mail an mehrere hundert Empfänger auf einmal gesendet werden. Bitte nur verwenden, wenn der Inhalt final ist und die Seite korrekt dargestellt wird. Am besten vorher eine Test-E-Mail an sich selbst senden.',
                      ],
                      'testReceiver' => [
                        'label' => 'Test-Empfänger',
                        'type' => 'email',
                        'required' => false,
                        'help' => 'An diese Adresse wird eine Test-E-Mail gesendet. Leer lassen, damit die untenliegende Gruppenauswahl funktioniert.'
                      ],
                      'receiverGroup' => [
                        'label' => 'EasyVerein-Empfängergruppe',
                        'type' => 'select',
                        'options' => $options,
                        'required' => false,
                        'help' => 'An welche EasyVerein-Gruppe soll die E-Mail gesendet werden?'
                      ],
                      'pageId' => [
                        'label' => 'Seite',
                        'type' => 'hidden',
                        'default' => $page->id()
                      ],
                    ],
                    'submitButton' => [
                      'icon'  => 'email',
                      'text'  => 'Versenden',
                      'theme' => 'pink'
                    ],
                    'value' => [
                      'receiverGroup' => option('welcome-werkstatt.werkstatt.easyverein.activeMembersGroupId'),
                      'pageId' => $page->id()
                    ]
                  ],

                ];
              },
              'submit' => function () {
                $receiverParameter = get('receiverGroup');
                $receiverGroup = explode(" ", $receiverParameter);
                $testReceiver = get('testReceiver');

                $kirby = kirby();
                
                if (!$kirby->user()->isAdmin()) {
                  throw new Exception('Nur Admins können Newsletter versenden.');
                }
                if (empty($receiverGroup) && empty($testReceiver)) {
                  throw new Exception('Bitte entweder eine Empfängergruppe oder eine Test-Empfänger angeben.');
                }
                $pageId = get('pageId');
                $page = page($pageId);
                $easyVerein = new EasyVerein();
                if (!empty($testReceiver)) {
                  $receivers = [[
                    'email' => $testReceiver,
                    'firstName' => 'Test',
                    'familyName' => 'Empfänger'
                  ]];
                } else {
                  $receiverGroupId = $receiverGroup[1];
                  
                  $memberReceivers = [];
                  $addressReceivers = [];
                  if ($receiverGroup[0] === 'Mitglieder') {
                    $memberReceivers = $easyVerein->getReceiversFromMemberGroupId($receiverGroupId);
                  } elseif ($receiverGroup[0] === 'Addressen') {
                    $addressReceivers = $easyVerein->getReceiversFromAddressGroupId($receiverGroupId);
                  } 
                  $receivers = array_merge($memberReceivers, $addressReceivers);
                }

                $mailer = new Brevo();

                $mailer->sendEmail(
                  option('welcome-werkstatt.newsletter.senderEmail'),
                  option('welcome-werkstatt.newsletter.senderName'),
                  array_map(function ($receiver) {
                    return [
                      'email' => $receiver['email'],
                      'name' => $receiver['firstName'] . ' ' . $receiver['familyName']
                    ];
                  }, $receivers),
                  $page->subject()->isEmpty() ? $page->title()->value() : $page->subject()->value(),
                  $page->render([], 'email'),
                  $page->render([], 'plaintext')
                );

                $page->update([
                  'publishDate' => date('Y-m-d H:i:s')
                ]);


                return ['message' => !empty($testReceiver) ? 'Versand an Test-Empfänger wurde gestartet.' : 'Versand an Empfängergruppe wurde gestartet.'];
              },
            ],
          ],
        ];
      },
    ],
  ]
);
