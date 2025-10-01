<?php

namespace WelcomeWerkstatt\Newsletter;

use Kirby\Http\Remote;
use Exception;


class EasyVerein
{
  protected $config;

  public function __construct()
  {
    $this->config = [
      'apiBaseUrl' => option('welcome-werkstatt.werkstatt.easyverein.apiBaseUrl'),
      'apiKey' => option('welcome-werkstatt.werkstatt.easyverein.apiKey'),
      'activeMembersGroupId' => option('welcome-werkstatt.werkstatt.easyverein.activeMembersGroupId'),
    ];
  }

  private function getFromEasyVerein($url)
  {
    $response = Remote::get($this->config['apiBaseUrl'] . $url, [
      'headers' => [
        'Authorization: Token ' . $this->config['apiKey']
      ]
    ]);

    if ($response->code() !== 200) {
      throw new Exception('EasyVerein API request failed with status ' . $response->code());
    }

    return $response->json();
  }

  public function getAllGroups()
  {
    $apiUrl = 'member-group/?query={id,name}&limit=100';

    $groups = $this->getFromEasyVerein($apiUrl)['results'];

    $groups = array_map(function ($group) {
      return [
        'id' => $group['id'],
        'name' => $group['name']
      ];
    }, $groups);

    return array_filter($groups);
  }

  public function getReceiversFromGroupId($groupId)
  {
    $apiUrl = 'member/?query={id,emailOrUserName,contactDetails{firstName,familyName,primaryEmail}}&memberGroups=' . $groupId . '&limit=100';

    $members = $this->getFromEasyVerein($apiUrl)['results'];

    $members = array_map(function ($member) use ($whitelist) {
      if (in_array($member['id'], $whitelist)) {
        return [
          'id' => $member['id'],
          'firstName' => $member['contactDetails']['firstName'],
          'familyName' => $member['contactDetails']['familyName'],
          'email' => $member['contactDetails']['primaryEmail']
        ];
      }
    }, $members);

    return array_values(array_filter($members));
  }
}
