<?php

namespace WelcomeWerkstatt\Newsletter;

use Kirby\Http\Remote;
use Exception;


class Mailjet
{
  protected $config;

  public function __construct()
  {
    $this->config = [
      'apiBaseUrl' => option('welcome-werkstatt.newsletter.mailjet.apiBaseUrl'),
      'apiKey' => option('welcome-werkstatt.newsletter.mailjet.apiKey'),
      'secretKey' => option('welcome-werkstatt.newsletter.mailjet.secretKey'),
    ];
  }

  public function sendEmail($from, $fromName, $to, $subject, $htmlContent, $textContent)
  {
    $url = 'send';

    $message = $this->buildMessage($from, $fromName, $to, $subject, $htmlContent, $textContent);

    $response = Remote::post($this->config['apiBaseUrl'] . $url, [
      'headers' => [
        'accept' => 'application/json',
        'content-type' => 'application/json',
      ],
      'basicAuth' => $this->config['apiKey'] . ':' . $this->config['secretKey'],
      'data' => $message,
    ]);

    if ($response->code() !== 201 && $response->code() !== 200) {
      throw new Exception('Error sending email via Mailjet: ' . $response->content());
    }

    return $response->content();
  }

  private function buildMessage($from, $fromName, $to, $subject, $htmlContent, $textContent)
  {
    return json_encode([
      'Globals' => [
        'From' => [
          'Email' => $from,
          'Name' => $fromName
        ],
        'Subject' => $subject,
        'TextPart' => $textContent,
        'HTMLPart' => $htmlContent,
      ],

      'Messages' => array_map(function ($recipient) {
        return [
          'To' => [[
            'Email' => $recipient['email'],
            'Name' => $recipient['name']
          ]]
        ];
      }, $to),
      'htmlContent' => $htmlContent,
      'textContent' => $textContent,
    ]);
  }
}
