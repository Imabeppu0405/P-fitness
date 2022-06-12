<?php
namespace controller\signup;

use model\UserModel;
use app\core\Auth;

function get() {
  \view\signup\index();
}

function post() {
  $user= new UserModel;
  $user->user_id = get_param('user_id', '');
  $user->password = get_param('password', '');
  $user->nickname = get_param('nickname', '');

  if (Auth::regist($user)) {
    echo '登録完了';
  } else {
    echo '登録失敗';
  }
}