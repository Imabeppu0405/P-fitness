<?php
namespace controller\fitness\create;

use app\core\Auth;
use app\core\Message\Msg;
use db\FitnessQuery;
use model\FitnessModel;
use model\UserModel;
use Throwable;

function post() {
  Auth::requireLogin();

  $fitness = new FitnessModel;
  $fitness->name = get_param('name', null);
  $fitness->level = get_param('level', null);
  $fitness->category = get_param('category', null);

  try {

    $user = UserModel::getSession();
    $is_success = FitnessQuery::insert($fitness, $user);

  } catch(Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if($is_success) {
    Msg::push(Msg::INFO, 'フィットネスの登録に成功しました。');
    redirect(GO_HOME);

  } else {
    $fitness->is_add = 1;
    FitnessModel::setSession($fitness);
    Msg::push(Msg::ERROR, 'フィットネスの登録に失敗しました。');
    redirect(GO_REFERER);

  }
}