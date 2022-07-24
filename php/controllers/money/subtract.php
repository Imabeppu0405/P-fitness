<?php

namespace controller\money\subtract;

use libs\Msg;
use app\core\Session;
use db\UserRepository;
use RuntimeException;

function post()
{
  $money = (int)get_param('money', null);
  
  try {

    $user = Session::get('_user');
    $is_success = UserRepository::subtractMoney($user, $money);
    $user = UserRepository::fetchById($user->user_id);
    Session::set('_user', $user);

  } catch (RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;
    
  }

  if ($is_success) {

    echo json_encode($user->money);

  }
}