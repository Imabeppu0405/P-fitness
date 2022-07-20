<?php

namespace controller\home;

use db\FitnessQuery;
use model\FitnessModel;
use model\UserModel;
use app\core\View;

function get()
{
    $user = UserModel::getSession();

    # セッションからエラー時の入力値を取得
    $fitness_errors = FitnessModel::getSession();
    FitnessModel::clearSession();

    $fitnesses = FitnessQuery::fetchById($user->user_id);

    $categories = [
      ['腕', 'arm'], 
      ['腹', 'abdmen'],
      ['脚', 'leg'], 
      ['その他', 'others']
    ];

    return View::render('home', array(
      'fitnesses'      => $fitnesses,
      'user'           => $user,
      'fitness_errors' => $fitness_errors,
      'categories'     => $categories
    ), true);
}