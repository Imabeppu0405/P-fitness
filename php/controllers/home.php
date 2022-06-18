<?php

namespace controller\home;

use app\core\Auth;
use db\FitnessQuery;
use model\UserModel;

function get() {
  if (Auth::isLogin()) {
    $user = UserModel::getSession();
    $fitness = FitnessQuery::fetchById($user->user_id);
    \view\home\index($fitness);
  } else {
    redirect('signin');
  }
}