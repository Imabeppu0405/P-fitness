<?php
namespace controller\fitness\update;

use app\core\Auth;
use app\core\Message\Msg;
use db\FitnessQuery;
use model\FitnessModel;
use Throwable;

function post() {
  Auth::requireLogin();

  $fitness = new FitnessModel;
  $fitness->id =  get_param('id', null);
  $fitness->name = get_param('name', null);
  $fitness->description = get_param('description', null);
  $fitness->level = get_param('level', null);
  $fitness->category = get_param('category', null);

  try {
    $is_success = FitnessQuery::update($fitness);

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