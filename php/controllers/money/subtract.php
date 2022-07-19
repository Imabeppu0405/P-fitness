<?php

namespace controller\money\subtract;

use app\core\Message\Msg;
use db\UserQuery;
use model\UserModel;
use Throwable;

function post()
{
  $price = (int)get_param('price', null);
  
  try {

    $user = UserModel::getSession();
    $is_success = UserQuery::subtractMoney($user, $price);
    $user = UserQuery::fetchById($user->user_id);
    UserModel::setSession($user);

  } catch (Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;
    
  }

  if ($is_success) {

    Msg::push(Msg::INFO, '報酬を獲得しました。');

  } else {

    Msg::push(Msg::ERROR, '金額の更新に失敗しました。');

  }

  redirect(GO_REFERER);
}