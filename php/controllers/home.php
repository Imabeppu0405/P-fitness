<?php

namespace controller\home;

use db\FitnessQuery;
use model\FitnessModel;
use model\UserModel;

function get()
{
    $user = UserModel::getSession();

    # セッションからエラー時の入力値を取得
    $fitness_errors = FitnessModel::getSession();
    FitnessModel::clearSession();

    $fitness = FitnessQuery::fetchById($user->user_id);
    \view\home\index($fitness, $user, $fitness_errors);
}