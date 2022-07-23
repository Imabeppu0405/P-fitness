<?php
namespace controller\fitness\update;

use libs\Msg;
use app\core\Session;
use db\FitnessRepository;
use libs\FitnessClass;
use RuntimeException;

function post() {
  $fitness = new FitnessClass;
  $fitness->id =  get_param('id', null);
  $fitness->name = get_param('name', null);
  $fitness->level = get_param('level', null);
  $fitness->category = get_param('category', null);
  $user = Session::get('_user');

  try {

    $is_success = FitnessRepository::update($fitness, $user);

  } catch(RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, 'フィットネスの更新に成功しました。');
    redirect('home');

  } else {

    # エラーの場合は入力値をセッションに保存
    $fitness->is_create = 0;
    Session::set('_fitness', $fitness);
    redirect('referer');

  }
}