<?php

namespace Dandaj\ApiClient;

use Illuminate\Support\ServiceProvider;

class ApiClientServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bind('apiClient', function ($app) {
      return new ApiClient;
    });
  }

  public function boot()
  {
    // Default config 
    $this->mergeConfigFrom(
          __DIR__ . '/config/ssoApiClient.php', 'ssoApiClient'
      );

    $this->publishes([
       __DIR__ . '/config/ssoApiClient.php' => base_path('config/ssoApiClient.php'),
    ]);
  }
}