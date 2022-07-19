<?php

namespace controller\reward\show;

use app\core\Auth;
use app\core\Message\Msg;
use db\RewardQuery;
use db\UserQuery;
use model\RewardModel;
use model\UserModel;
use Throwable;

function get() {
  $user = UserModel::getSession();
  
  # セッションからエラー時の入力値を取得
  $rewards = RewardQuery::fetchById($user->user_id);
  $reward_errors = RewardModel::getSession();

  RewardModel::clearSession();
  \view\reward\show\index($rewards, $user, $reward_errors);
}

