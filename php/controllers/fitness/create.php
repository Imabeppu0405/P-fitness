<?php
namespace controller\fitness\create;

use app\core\Message\Msg;
use db\FitnessQuery;
use app\core\FitnessModel;
use app\core\Session;
use Throwable;

function post() {
  $fitness = new FitnessModel;
  $fitness->name = get_param('name', null);
  $fitness->level = get_param('level', null);
  $fitness->category = get_param('category', null);

  try {

    $user = Session::get('_user');
    $is_success = FitnessQuery::insert($fitness, $user);

  } catch(Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, 'フィットネスの登録に成功しました。');
    redirect(GO_HOME);

  } else {
    # エラーの場合は入力値をセッションに保存
    $fitness->is_create = 1;
    Session::set('_fitness', $fitness);
    redirect(GO_REFERER);

  }
}