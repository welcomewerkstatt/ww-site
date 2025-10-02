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

  public function getAllMemberGroups()
  {
    $apiUrl = 'member-group/?query={id,name,linkedItems}&limit=100';

    $groups = $this->getFromEasyVerein($apiUrl)['results'];

    $groups = array_map(function ($group) {
      return [
        'id' => $group['id'],
        'name' => $group['name'],
        'count' => $group['linkedItems'],
        'type' => 'Mitglieder'
      ];
    }, $groups);

    return array_filter($groups, function ($group) {
      return $group['count'] > 0;
    });
  }

  public function getAllAddressGroups()
  {
    $apiUrl = 'contact-details-group/?query={id,name,linkedItems}&limit=100';

    $groups = $this->getFromEasyVerein($apiUrl)['results'];

    $groups = array_map(function ($group) {
      return [
        'id' => $group['id'],
        'name' => $group['name'],
        'count' => $group['linkedItems'],
        'type' => 'Addressen'
      ];
    }, $groups);

    return array_filter($groups, function ($group) {
      return $group['count'] > 0;
    });
  }

  public function getReceiversFromMemberGroupId($memberGroupId)
  {
    $apiUrl = 'member/?query={id,emailOrUserName,contactDetails{firstName,familyName,primaryEmail}}&memberGroups=' . $memberGroupId . '&limit=100';

    $members = $this->getFromEasyVerein($apiUrl)['results'];

    $members = array_map(function ($member) {
      return [
        'id' => $member['id'],
        'firstName' => $member['contactDetails']['firstName'],
        'familyName' => $member['contactDetails']['familyName'],
        'email' => $member['contactDetails']['primaryEmail']
      ];
    }, $members);

    return array_values(array_filter($members));
  }

  public function getReceiversFromAddressGroupId($addressGroupId)
  {
    $apiUrl = 'contact-details/?query={id,firstName,familyName,primaryEmail}&contactDetailsGroups=' . $addressGroupId . '&limit=100';

    $people = $this->getFromEasyVerein($apiUrl)['results'];

    $people = array_map(function ($person) {
      return [
        'id' => $person['id'],
        'firstName' => $person['firstName'],
        'familyName' => $person['familyName'],
        'email' => $person['primaryEmail']
      ];
    }, $people);

    return array_values(array_filter($people));
  }
}
