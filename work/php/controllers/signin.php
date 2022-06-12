<?php

namespace controller\signin;

function get() {
  \view\signin\index();
}

function post() {
  $user_id = get_param('user_id', '');
  $password = get_param('password', '');

  var_dump($user_id);
  var_dump($password);
}