<?php

namespace controller\reward\show;

use app\core\View;
use db\RewardQuery;
use model\RewardModel;
use model\UserModel;

function get() {
  $user = UserModel::getSession();
  
  # セッションからエラー時の入力値を取得
  $rewards = RewardQuery::fetchById($user->user_id);
  $reward_errors = RewardModel::getSession();

  RewardModel::clearSession();
  
  return View::render('reward/show', array(
    'rewards'       => $rewards,
    'user'          => $user,
    'reward_errors' => $reward_errors
  ), true);
}

