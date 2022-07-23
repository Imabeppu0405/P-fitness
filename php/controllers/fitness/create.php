<?php
namespace controller\fitness\create;

use libs\Msg;
use db\FitnessRepository;
use libs\FitnessClass;
use app\core\Session;
use RuntimeException;

function post() {
  $fitness = new FitnessClass;
  $fitness->name = get_param('name', null);
  $fitness->level = get_param('level', null);
  $fitness->category = get_param('category', null);

  try {

    $user = Session::get('_user');
    $is_success = FitnessRepository::insert($fitness, $user);

  } catch(RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, 'フィットネスの登録に成功しました。');
    redirect('home');

  } else {
    # エラーの場合は入力値をセッションに保存
    $fitness->is_create = 1;
    Session::set('_fitness', $fitness);
    redirect('referer');

  }
}