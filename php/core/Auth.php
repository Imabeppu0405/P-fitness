<?php

namespace app\core;

use app\core\Message\Msg;
use db\UserQuery;
use RuntimeException;

class Auth
{
  public static function login($user_id, $password)
  {
    try {
      if (!(Validation::validateId($user_id) * Validation::validatePwd($password))) {
        return false;
      }

      $is_success = false;
      $user = UserQuery::fetchById($user_id);
    
      if (!empty($user)) { 
        if (password_verify($password, $user->password)) {

          $is_success = true;
          $user = UserQuery::fetchById($user->user_id);
          Session::set('_user', $user);
          Session::setAuthentication();

        } else {

          Msg::push(Msg::ERROR, 'パスワードが一致しません');

        }
      } else {

        Msg::push(Msg::ERROR, 'ユーザーが見つかりません');

      }
    } catch (RuntimeException $e) {

      $is_success = false;
      Msg::push(Msg::DEBUG, $e->getMessage());
      Msg::push(Msg::ERROR, 'ログイン処理でエラーが発生しました。');

    }

    return $is_success;
  }

  public static function regist($user)
  {
    try {
      if (!(Validation::validateId($user->user_id, true)
          * Validation::validatePwd($user->password)
          * Validation::validateNickname($user->nickname))) {
          return false;
      }

      $is_success = false;
      $is_success = UserQuery::insert($user);

      if ($is_success) {

        $user = UserQuery::fetchById($user->user_id);
        Session::set('_user', $user);
        Session::setAuthentication();
      }

    } catch (RuntimeException $e) {

      $is_success = false;
      Msg::push(Msg::DEBUG, $e->getMessage());
      Msg::push(Msg::ERROR, 'ユーザー登録でエラーが発生しました');

    }

    return $is_success;
  }

  public static function logout() {
    try {

      Session::remove('_user');
      Session::clearAuthentication();

    } catch (RuntimeException $e) {

      Msg::push(Msg::DEBUG, $e->getMessage());
      return false;

    }

    return true;
  }

  public static function isLogin() {

    return Session::isAuthenticated();
  }
}