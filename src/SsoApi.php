<?php

namespace Dandaj\ApiClient;

class GDataApi
{
  public function __construct()
  {
    $this->sessionName = 'ssoApiToken';
    
    if (!session($this->sessionName))
      new SsoApiConnect();
    
    $this->conf = 'ssoApiClient';
  }

  protected function ssoApiReconnect($result) 
  {
    if ($result->status_code == 403)
      new SsoApiConnect();
  }

  public function registerUser($data)
  {
    $dataJson = json_encode($data);
    $conf = $this->conf;
    $url = config($conf . '.sso.url') . '/' . config($conf . '.sso.prefix') . '/users';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($dataJson),
        'auth-token:' . session($this->sessionName),
      ]
    );

    $result = curl_exec($ch);
    $result = json_decode($result);  
    $this->ssoApiReconnect($result);

    return $result;
  }

  public function updateUser($externalId, $data)
  {
    $dataJson = json_encode($data);
    $conf = $this->conf;
    $url = config($conf . '.sso.url') . '/' . config($conf . '.sso.prefix') . '/users/' . $externalId;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($dataJson),
        'auth-token:' . session($this->sessionName),
      ]
    );

    $result = curl_exec($ch);
    $result = json_decode($result);  
    $this->ssoApiReconnect($result);
     
    return $result;  
  }

  public function showUser($externalId)
  {
    $dataJson = json_encode($data);
    $conf = $this->conf;
    $url = config($conf . '.sso.url') . '/' . config($conf . '.sso.prefix') . '/users/' . $externalId;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: 0',
        'auth-token:' . session($this->sessionName),
      ]
    );

    $result = curl_exec($ch);
    $result = json_decode($result);  
    $this->ssoApiReconnect($result);
     
    return $result;     
  }
}