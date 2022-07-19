<?php

namespace controller\money\add;

use app\core\Message\Msg;
use db\UserQuery;
use model\UserModel;
use Throwable;

function post()
{
  $level = get_param('level', null);

  try {

    $user = UserModel::getSession();
    $is_success = UserQuery::addMoney($user->user_id, $level);
    $user = UserQuery::fetchById($user->user_id);
    UserModel::setSession($user);


  } catch (Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;
    
  }

  if ($is_success) {

    Msg::push(Msg::INFO, 'この調子！');

  } else {

    Msg::push(Msg::ERROR, 'moneyの更新に失敗しました。');

  }
  redirect(GO_REFERER);
}