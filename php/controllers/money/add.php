<?php

namespace controller\money\add;

use libs\Msg;
use app\core\Session;
use db\UserRepository;
use RuntimeException;

function post()
{
  $level = get_param('level', null);

  try {

    $user = Session::get('_user');
    $is_success = UserRepository::addMoney($user->user_id, $level);
    $user = UserRepository::fetchById($user->user_id);
    Session::set('_user', $user);


  } catch (RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;
    
  }

  if ($is_success) {

    Msg::push(Msg::INFO, 'この調子！');

  } else {

    Msg::push(Msg::ERROR, 'moneyの更新に失敗しました。');

  }
  redirect('referer');
}