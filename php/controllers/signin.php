<?php

namespace controller\signin;

use app\core\Auth;
use app\core\Message\Msg;
use model\UserModel;

function get() {
  \view\signin\index();
}

function post() {
  $user_id = get_param('user_id', '');
  $password = get_param('password', '');

  if(Auth::login($user_id, $password)) {
    $user = UserModel::getSession();
    Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ");
    redirect(GO_HOME);
  } else {
    redirect(GO_REFERER);
  }
}