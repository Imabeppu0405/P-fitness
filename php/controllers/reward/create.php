<?php
namespace controller\reward\create;

use libs\Msg;
use db\RewardRepository;
use libs\RewardClass;
use app\core\Session;
use RuntimeException;

function post() {
  $reward = new RewardClass;
  $reward->name = get_param('name', null);
  $reward->price = get_param('price', null);

  try {

    $user = Session::get('_user');
    $is_success = RewardRepository::insert($reward, $user);

  } catch(RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, '報酬の登録に成功しました。');

  } else {

    # エラーの場合は入力値をセッションに保存
    $reward->is_create = 1;
    Session::set('_reward', $reward);

  }

  redirect('referer');
} 