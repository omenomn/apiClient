<?php

namespace Dandaj\ApiClient;

class SsoApi
{
  protected $ssoApiConnect;

  public function __construct()
  {
    $this->sessionName = 'ssoApiToken';
    
    $this->ssoApiConnect = new SsoApiConnect();
    
    $this->conf = 'ssoApiClient';
  }

  public function registerUser($data = [])
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
     
    return $result;  
  }

  public function showUser($externalId)
  {
    $conf = $this->conf;
    $url = config($conf . '.sso.url') . '/' . config($conf . '.sso.prefix') . '/users/' . $externalId;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'auth-token:' . session($this->sessionName),
      ]
    );
    
    $result = curl_exec($ch);
    $result = json_decode($result);  
     
    return $result;     
  }

  public function indexUsers()
  {
    $conf = $this->conf;
    $url = config($conf . '.sso.url') . '/' . config($conf . '.sso.prefix') . '/users';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'auth-token:' . session($this->sessionName),
      ]
    );

    $result = curl_exec($ch);
    $result = json_decode($result);  
     
    return $result;     
  }
}