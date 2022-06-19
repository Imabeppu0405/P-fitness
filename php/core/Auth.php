<?php

namespace app\core;

use app\core\Message\Msg;
use db\UserQuery;
use model\UserModel;
use Throwable;

class Auth
{
  public static function login($user_id, $password)
  {
    try {
      # TODO: 形式チェック
      if(!(UserModel::validateId($user_id) * UserModel::validatePwd($password))) {
        return false;
      }
      $is_success = false;
      
      $user = UserQuery::fetchById($user_id);
    
      if(!empty($user)) { 
        if (password_verify($password, $user->password)) {
          $is_success = true;
          $user = UserQuery::fetchById($user->user_id);
          UserModel::setSession($user);
        } else {
          Msg::push(Msg::ERROR, 'パスワードが一致しません');
        }
      } else {
        Msg::push(Msg::ERROR, 'ユーザーが見つかりません');
      }

    } catch (Throwable $e) {
      $is_success = false;
      Msg::push(Msg::DEBUG, $e->getMessage());
      Msg::push(Msg::ERROR, 'ログイン処理でエラーが発生しました。');
    }

    return $is_success;
  }

  public static function regist($user)
  {
    try {
      # TODO: 形式チェック
      if (!($user->isValidId()
          * $user->isValidPwd()
          * $user->isValidNick())) {
          return false;
      }

      $is_success = false;

      # TODO: 存在チェック

      $is_success = UserQuery::insert($user);

      if($is_success) {
        $user = UserQuery::fetchById($user->user_id);
        UserModel::setSession($user);
      }

    } catch (Throwable $e) {

      $is_success = false;
      Msg::push(Msg::DEBUG, $e->getMessage());
      Msg::push(Msg::ERROR, 'ユーザー登録でエラーが発生しました');
    }

    return $is_success;
  }

  public static function logout() {
    try {

      UserModel::clearSession();

    } catch (Throwable $e) {

      Msg::push(Msg::DEBUG, $e->getMessage());
      return false;

    }

    return true;
  }

  public static function isLogin() {
    try {

      $user = UserModel::getSession();

    } catch(Throwable $e) {

      Msg::push(Msg::DEBUG, $e->getMessage());
      return false;

    }

    if(isset($user)) {
      return true;
    } else {
      return false;
    }
  }

  public static function requireLogin() {
    if (!static::isLogin()) {
      Msg::push(Msg::ERROR, 'ログインしてください');
      redirect('signin');
    }
  }
}