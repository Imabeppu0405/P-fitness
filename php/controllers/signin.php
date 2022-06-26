<?php

namespace controller\signin;

use app\core\Auth;
use app\core\Message\Msg;
use model\UserModel;

function get() {
  if (!Auth::isLogin()) {
    # セッションからエラー時の入力値を取得
    $user = UserModel::getSession();
    UserModel::clearSession();
    \view\signin\index($user->user_id, $user->password);

  } else {

    redirect('/');

  }
}

function post() {
  $user = new UserModel;
  $user->user_id = get_param('user_id', '');
  $user->password = get_param('password', '');

  if (Auth::login($user->user_id, $user->password)) {

    $user = UserModel::getSession();
    Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ");
    redirect(GO_HOME);

  } else {

    UserModel::setSession($user);
    redirect(GO_REFERER);

  }
}