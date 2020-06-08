<?php
use \Firebase\JWT\JWT;
require 'config.php';

class Auth{
  public static function encode_jwt($token_data){
    $user_token = [
      'iat' => time(),
      'exp' => strtotime('+10 hours'),
      'data' => $token_data
    ];

    $jwt = JWT::encode($user_token, Config::JWT_SECRET);

    return $jwt;
  }

  public static function decode_jwt($data){

      $jwt = explode("Bearer ", $data['Authorization'])[1];

      $user_data = (array) JWT::decode($jwt, Config::JWT_SECRET, ['HS256']);

      $user_data['data'] = (array) $user_data['data'];

      return $user_data;

  }
}

 ?>
