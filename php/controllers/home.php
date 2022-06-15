<?php

namespace controller\home;

use app\core\Auth;

function get() {
  if (Auth::isLogin()) {
    \view\home\index();
  } else {
    redirect('signin');
  }
}