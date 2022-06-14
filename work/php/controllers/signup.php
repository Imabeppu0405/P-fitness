<?php
namespace controller\signup;

use model\UserModel;
use app\core\Auth;
use app\core\Message\Msg;

function get() {
  \view\signup\index();
}

function post() {
  $user= new UserModel;
  $user->user_id = get_param('user_id', '');
  $user->password = get_param('password', '');
  $user->nickname = get_param('nickname', '');

  if (Auth::regist($user)) {
    Msg::push(Msg::INFO, '新規登録成功');
    redirect(GO_HOME);
  } else {
    Msg::push(Msg::DEBUG, '新規登録失敗');
    redirect(GO_REFERER);
  }
}