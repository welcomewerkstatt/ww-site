<?php

namespace WelcomeWerkstatt\Newsletter;

use Kirby\Http\Remote;
use Exception;


class Brevo
{
  protected $config;

  public function __construct()
  {
    $this->config = [
      'apiBaseUrl' => option('welcome-werkstatt.newsletter.brevo.apiBaseUrl'),
      'apiKey' => option('welcome-werkstatt.newsletter.brevo.apiKey'),
    ];
  }

  public function sendEmail($from, $fromName, $to, $subject, $htmlContent, $textContent)
  {
    $url = 'smtp/email';

    $message = $this->buildMessage($from, $fromName, $to, $subject, $htmlContent, $textContent);

    file_put_contents(__DIR__ . '/brevo_debug.json', $message);

    // $response = Remote::post($this->config['apiBaseUrl'] . $url, [
    //   'headers' => [
    //     'accept' => 'application/json',
    //     'api-key' => $this->config['apiKey'],
    //     'content-type' => 'application/json',
    //   ],
    //   'data' => $message,
    // ]);

    // if ($response->code() !== 201 && $response->code() !== 200) {
    //   throw new Exception('Error sending email via Brevo: ' . $response->content());
    // }

    // return $response->content();
  }

  private function buildMessage($from, $fromName, $to, $subject, $htmlContent, $textContent)
  {
    return json_encode([
      'sender' => [
        'name' => $fromName,
        'email' => $from
      ],
      'subject' => $subject,
      'messageVersions' => array_map(function ($recipient) {
        return [
          'to' => [
            [
              'email' => $recipient['email'],
              'name' => $recipient['name']
            ]
          ]
        ];
      }, $to),
      'htmlContent' => $htmlContent,
      'textContent' => $textContent,
    ]);
  }
}
