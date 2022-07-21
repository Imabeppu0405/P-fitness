<?php
namespace controller\fitness\delete;

use app\core\Message\Msg;
use db\FitnessQuery;
use Throwable;

function post() {
  $id =  get_param('id', null);

  try {

    $is_success = FitnessQuery::delete($id);

  } catch(Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, '削除しました。');
    redirect(GO_HOME);

  } else {

    Msg::push(Msg::ERROR, '削除できませんでした。');
    redirect(GO_REFERER);

  }
}