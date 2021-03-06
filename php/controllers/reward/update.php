<?php
namespace controller\reward\update;

use libs\Msg;
use db\RewardRepository;
use libs\RewardClass;
use app\core\Session;
use RuntimeException;

function post() {
  $reward = new RewardClass;
  $reward->id =  get_param('id', null);
  $reward->name = get_param('name', null);
  $reward->price = get_param('price', null);
  $user = Session::get('_user');
  try {

    $is_success = RewardRepository::update($reward, $user);

  } catch(RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, '報酬の更新に成功しました。');

  } else {

    # エラーの場合は入力値をセッションに保存
    $reward->is_create = 0;
    Session::set('_reward', $reward);

  }

  redirect('referer');
}