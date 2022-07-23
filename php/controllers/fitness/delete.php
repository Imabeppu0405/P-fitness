<?php
namespace controller\fitness\delete;

use libs\Msg;
use db\FitnessRepository;
use RuntimeException;

function post() {
  $id =  get_param('id', null);

  try {

    $is_success = FitnessRepository::delete($id);

  } catch(RuntimeException $e) {

    Msg::push(Msg::DEBUG, $e->getMessage());
    $is_success = false;

  }

  if ($is_success) {

    Msg::push(Msg::INFO, '削除しました。');
    redirect('home');

  } else {

    Msg::push(Msg::ERROR, '削除できませんでした。');
    redirect('referer');

  }
}