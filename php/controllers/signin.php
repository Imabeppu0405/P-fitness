<?php

namespace controller\signin;

use app\core\Auth;
use app\core\Message\Msg;
use app\core\View;
use model\UserModel;

function get() {
    # セッションからエラー時の入力値を取得
    $user = UserModel::getSession();
    UserModel::clearSession();
    return View::render('signin', array(
      'user_id'  => $user->user_id,
      'password' => $user->password
    ), true);
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