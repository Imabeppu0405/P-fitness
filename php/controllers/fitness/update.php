<?php
namespace controller\fitness\update;

use app\core\Auth;
use app\core\Message\Msg;
use db\FitnessQuery;
use model\FitnessModel;
use model\UserModel;
use Throwable;

function post() {
  $fitness = new FitnessModel;
  $fitness->id =  get_param('id', null);
  $fitness->name = get_param('name', null);
  $fitness->level = get_param('level', null);
  $fitness->category = get_param('category', null);
  $user = UserModel::getSession();

  try {

    $is_success = FitnessQuery::update($fitness, $user);

  } catch(Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, 'フィットネスの更新に成功しました。');
    redirect(GO_HOME);

  } else {

    # エラーの場合は入力値をセッションに保存
    $fitness->is_create = 0;
    FitnessModel::setSession($fitness);
    redirect(GO_REFERER);

  }
}