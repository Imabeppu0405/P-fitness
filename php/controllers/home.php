<?php

namespace controller\home;

use app\core\Session;
use db\FitnessQuery;
use app\core\View;

function get()
{
    $user = Session::get('_user');

    # セッションからエラー時の入力値を取得
    $fitness_errors = Session::get('_fitness');
    Session::remove('_fitness');

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