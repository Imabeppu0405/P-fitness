<?php
namespace controller\fitness\update;

use app\core\Auth;
use app\core\Message\Msg;
use db\FitnessQuery;
use model\FitnessModel;
use model\UserModel;
use Throwable;

function post() {
  Auth::requireLogin();

  $fitness = FitnessModel::getSession();
  $fitness->name = get_param('name', $fitness->name);
  $fitness->description = get_param('description', $fitness->description);
  $fitness->level = get_param('level', $fitness->level);
  
  try {

    $user = UserModel::getSession();
    $is_success = FitnessQuery::update($fitness, $user);

  } catch(Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if($is_success) {

    Msg::push(Msg::INFO, 'フィットネスの更新に成功しました。');
    redirect(GO_HOME);

  } else {

    Msg::push(Msg::ERROR, 'フィットネスの更新に失敗しました。');
    redirect(GO_REFERER);

  }

  
} 