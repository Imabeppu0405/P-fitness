<?php

namespace controller\home;

use app\core\Session;
use db\FitnessRepository;
use app\core\View;

function get()
{
    $user = Session::get('_user');

    # セッションからエラー時の入力値を取得
    $fitness_errors = Session::get('_fitness');
    Session::remove('_fitness');

    $fitnesses = FitnessRepository::fetchById($user->user_id);

    $categories = [
      ['腕', 'arm'], 
      ['腹', 'abdmen'],
      ['脚', 'leg'], 
      ['その他', 'others']
    ];

    $fitnes_sort_array = [
      '新しい順' => 'fitness_created-1',
      '古い順' => 'fitness_created-0',
      '名前昇順' => 'fitness_name-0', 
      '名前降順' => 'fitness_name-1',
      'ポイントが高い順' => 'fitness_level-1',
      'ポイントが低い順' => 'fitness_level-0',
      'カテゴリごと' => 'fitness_category-0'
    ];

    return View::render('home', array(
      'fitnesses'         => $fitnesses,
      'user'              => $user,
      'fitness_errors'    => $fitness_errors,
      'categories'        => $categories,
      'fitnes_sort_array' => $fitnes_sort_array
    ), true);
}