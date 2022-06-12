<?php

namespace app\core;

use db\UserQuery;
use model\UserModel;
use Throwable;

class Auth
{
  public static function login($user_id, $password)
  {
    try {
      # TODO: 形式チェック
      $is_success = false;
      
      $user = UserQuery::fetchById($user_id);
    
      if(!empty($user)) { 
        if (password_verify($password, $user->password)) {
          $is_success = true;
        } else {
          echo 'パスワードが一致しません';
        }
      } else {
        echo 'ユーザーが見つかりません';
      }

    } catch (Throwable $e) {
      echo $e;
    }

    return $is_success;
  }
}