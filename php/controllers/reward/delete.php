<?php
namespace controller\reward\delete;

use libs\Msg;
use db\RewardRepository;
use RuntimeException;

function post() {
  $id =  get_param('id', null);

  try {
    
    $is_success = RewardRepository::delete($id);

  } catch(RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, '削除しました。');
    redirect('referer');

  } else {

    Msg::push(Msg::ERROR, '削除できませんでした。');
    redirect('referer');

  }
}