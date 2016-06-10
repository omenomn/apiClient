<?php 

namespace Dandaj\ApiClient;

class SsoApiConnect
{
  protected $result;

  public function __construct()
  {      
    $conf = 'ssoApiClient';
    $dataLogin = [
        'login' => config($conf . '.login'),
        'password' => config($conf . '.password'),
        'client_id' => config($conf . '.client_id'),
        'client_secret' => config($conf . '.client_secret'),
    ];

    $dataLogin = json_encode($dataLogin);

    $ch = curl_init(config($conf . '.sso.url') . '/' . config($conf . '.sso.prefix_auth'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataLogin);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($dataLogin)
      ]
    );

    $result = curl_exec($ch);
    $result = json_decode($result);
    
    if ($result && $result->status_code == 200) {
      session()->put('ssoApiToken', $result->token);
    }
  }
}