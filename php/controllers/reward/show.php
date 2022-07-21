<?php

namespace controller\reward\show;

use app\core\Session;
use app\core\View;
use db\RewardQuery;

function get() {
  $user = Session::get('_user');
  
  # セッションからエラー時の入力値を取得
  $rewards = RewardQuery::fetchById($user->user_id);
  $reward_errors = Session::get('_reward');

  Session::remove('_reward');
  
  return View::render('reward/show', array(
    'rewards'       => $rewards,
    'user'          => $user,
    'reward_errors' => $reward_errors
  ), true);
}

