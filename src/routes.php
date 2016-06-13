<?php

use App\User;
use Illuminate\Http\Request;

Route::get('/sso/get/{str}', function (Request $request, $str) {
  $encryptionKey = env('SSO_KEY');
  $iv = env('SSO_IV');

  $decrypted = openssl_decrypt($str, config('app.cipher'), $encryptionKey, 0, $iv);
  $decrypted = json_decode($decrypted);

  if (isset($decrypted->email) && $decrypted->email) {
    $user = User::where('email', 'like', $decrypted->email)->first();
    
    if ($user)
    Auth::login($user);
    return response()->json(['status' => 'login']);
  }
  
  return response()->json(['status' => 'notLogin']);

})->where('str', '(.*)');

Route::get('/sso/logout', function (Request $request) {
  if (auth()->user())
    Auth::logout();
  
  return response()
      ->json(['status' => 'ok'])
      ->setCallback($request->input('callback'));
});