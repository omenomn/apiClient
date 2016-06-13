<?php

use Illuminate\Http\Request;

Route::get('/sso/logout', function (Request $request) {
  if (auth()->user())
    Auth::logout();
  
  return response()
      ->json(['status' => 'ok'])
      ->setCallback($request->input('callback'));
});