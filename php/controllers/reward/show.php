<?php

namespace controller\reward\show;

use db\RewardQuery;
use model\UserModel;

function get() {
  $user = UserModel::getSession();
  $rewards = RewardQuery::fetchById($user->user_id);
  \view\reward\show\index($rewards);
}