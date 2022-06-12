<?php

namespace controller\signin;

use app\core\Auth;

function get() {
  \view\signin\index();
}

function post() {
  $user_id = get_param('user_id', '');
  $password = get_param('password', '');

  if(Auth::login($user_id, $password)) {
    echo 'ログイン成功';
  } else {
    echo 'ログイン失敗';
  }
}