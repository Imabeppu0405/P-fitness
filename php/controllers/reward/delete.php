<?php
namespace controller\reward\delete;

use app\core\Message\Msg;
use db\RewardQuery;
use Throwable;

function post() {
  $id =  get_param('id', null);

  try {
    
    $is_success = RewardQuery::delete($id);

  } catch(Throwable $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, '削除しました。');
    redirect(GO_REFERER);

  } else {

    Msg::push(Msg::ERROR, '削除できませんでした。');
    redirect(GO_REFERER);

  }
}