<?php

namespace controller\reward\show;

use app\core\Session;
use app\core\View;
use db\RewardRepository;

function get() {
  $user = Session::get('_user');
  
  # セッションからエラー時の入力値を取得
  $rewards = RewardRepository::fetchById($user->user_id);
  $reward_errors = Session::get('_reward');

  $reward_sort_array = [
    '登録が古い順'  => 'reward_created-0',
    '登録が新しい順' => 'reward_created-1',
    '名前昇順'      => 'reward_name-0', 
    '名前降順'      => 'reward_name-1',
    '価格が高い順'   => 'reward_price-1',
    '価格が低い順'   => 'reward_price-0',
  ];

  Session::remove('_reward');
  
  return View::render('reward/show', array(
    'rewards'           => $rewards,
    'user'              => $user,
    'reward_errors'     => $reward_errors,
    'reward_sort_array' => $reward_sort_array
  ), true);
}

