<?php

namespace controller\signin;

use app\core\Auth;
use app\core\Message\Msg;

function get() {
  \view\signin\index();
}

function post() {
  $user_id = get_param('user_id', '');
  $password = get_param('password', '');

  if(Auth::login($user_id, $password)) {
    Msg::push(Msg::INFO, 'ログイン成功');
  } else {
    Msg::push(Msg::ERROR, 'ログイン失敗');
  }
}