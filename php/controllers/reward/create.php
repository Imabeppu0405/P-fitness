<?php
namespace controller\reward\create;

use app\core\Auth;
use app\core\Message\Msg;
use db\RewardQuery;
use model\RewardModel;
use model\UserModel;
use Throwable;

function post() {
  Auth::requireLogin();

  $reward = new RewardModel;
  $reward->name = get_param('name', null);
  $reward->price = get_param('price', null);

  try {

    $user = UserModel::getSession();
    $is_success = RewardQuery::insert($reward, $user);

  } catch(Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if($is_success) {

    Msg::push(Msg::INFO, 'フィットネスの登録に成功しました。');

  } else {

    Msg::push(Msg::ERROR, 'フィットネスの登録に失敗しました。');

  }
  redirect(GO_REFERER);
  
} 