<?php
namespace controller\signup;

use app\core\UserModel;
use app\core\Auth;
use app\core\Message\Msg;
use app\core\Session;
use app\core\View;

function get() {
    # セッションからエラー時の入力値を取得
    $user = Session::get('_user');
    Session::remove('_user');
    return View::render('signup', array(
      'user_id'  => $user->user_id,
      'password' => $user->password,
      'nickname' => $user->nickname
    ), true);
}

function post() {
  $user= new UserModel;
  $user->user_id = get_param('user_id', '');
  $user->password = get_param('password', '');
  $user->nickname = get_param('nickname', '');

  if (Auth::regist($user)) {

    Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ");
    redirect('home');

  } else {

    Session::set('_user', $user);
    redirect('referer');
    
  }
}