<?php

namespace controller\signin;

use app\core\Auth;
use libs\Msg;
use app\core\Session;
use app\core\View;
use db\UserRepository;

function get() {
    # セッションからエラー時の入力値を取得
    $user = Session::get('_user');
    Session::remove('_user');
    return View::render('signin', array(
      'user_id'  => $user->user_id,
      'password' => $user->password
    ), true);
}

function post() {
  $user = new UserRepository;
  $user->user_id = get_param('user_id', '');
  $user->password = get_param('password', '');

  if (Auth::login($user->user_id, $user->password)) {

    $user = Session::get('_user');
    Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ");
    redirect('home');

  } else {

    Session::set('_user', $user);
    redirect('referer');

  }
}