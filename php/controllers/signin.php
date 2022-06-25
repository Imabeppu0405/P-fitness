<?php

namespace controller\signin;

use app\core\Auth;
use app\core\Message\Msg;
use model\UserModel;

function get() {
  $user_id = get_param('user_id', '', false);
  $password = get_param('password', '', false);
  \view\signin\index($user_id, $password);
}

function post() {
  $user_id = get_param('user_id', '');
  $password = get_param('password', '');

  if(Auth::login($user_id, $password)) {
    $user = UserModel::getSession();
    Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ");
    redirect(GO_HOME);
  } else {
    redirect(GO_REFERER, [
      'user_id' => $user_id, 
      'password' => $password
    ]);
  }
}