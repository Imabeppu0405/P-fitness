<?php

namespace controller\reward\show;

use app\core\Auth;
use app\core\Message\Msg;
use db\RewardQuery;
use db\UserQuery;
use model\UserModel;
use Throwable;

function get() {
  $user = UserModel::getSession();
  $rewards = RewardQuery::fetchById($user->user_id);
  \view\reward\show\index($rewards, $user);
}

function post()
{
  Auth::requireLogin();

  $price = (int)get_param('price', null);
  
  try {

    $user = UserModel::getSession();
    $is_success = UserQuery::subtractMoney($user->user_id, $price);
    $user = UserQuery::fetchById($user->user_id);
    UserModel::setSession($user);


  } catch (Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;
    
  }

  if($is_success) {

    Msg::push(Msg::INFO, '報酬を獲得しました。');

  } else {

    Msg::push(Msg::ERROR, 'moneyの更新に失敗しました。');

  }
  redirect(GO_REFERER);
}