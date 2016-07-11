<?php

return [
  //auth credentials
  'login' => env('SSO_CLIENT_LOGIN', 'test'),
  'password' => env('SSO_CLIENT_PASSWORD', 'test'),
  'client_id' => env('SSO_CLIENT_ID', 'AIAZrzA6EUJweg11Zg7X'),
  'client_secret' => env('SSO_CLIENT_CLIENT_SECRET', 'qSGn1J5HxheJp7Wp3i4P7NCex92fFRCzRHiS2BpkMyJXRaxsYQxTYHt7KH8t'),
  'sso' => [
    // sso server adress
    'url' => env('SSO_URL'),

    // sso api url prefix
    'prefix' => 'api',

    // Prefix for routing api authentication and test
    'prefix_auth' => 'oauth/token',
  ],
];