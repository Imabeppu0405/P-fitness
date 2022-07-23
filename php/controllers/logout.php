<?php
namespace controller\logout;

use app\core\Auth;
use libs\Msg;

function get() {

  if (Auth::logout()) {
    
    Msg::push(Msg::INFO, 'ログアウトに成功しました。');

  } else {

    Msg::push(Msg::ERROR, 'ログアウトに失敗しました。');

  }

  redirect('home');
}