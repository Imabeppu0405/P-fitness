<?php

namespace controller\money\subtract;

use libs\Msg;
use app\core\Session;
use db\UserRepository;
use RuntimeException;

function post()
{
  $price = (int)get_param('price', null);
  
  try {

    $user = Session::get('_user');
    $is_success = UserRepository::subtractMoney($user, $price);
    $user = UserRepository::fetchById($user->user_id);
    Session::set('_user', $user);

  } catch (RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;
    
  }

  if ($is_success) {

    Msg::push(Msg::INFO, '報酬を獲得しました。');

  } else {

    Msg::push(Msg::ERROR, '金額の更新に失敗しました。');

  }

  redirect('referer');
}