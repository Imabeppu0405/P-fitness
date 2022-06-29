<?php
namespace model;

use app\core\Message\Msg;
use db\UserQuery;

class UserModel extends AbstractModel {
  public string $user_id;
  public string $password;
  public string $nickname;
  public int $money;

  protected static $SESSION_NAME = '_user';

  public static function setAuthentication() 
  {
    $_SESSION['_isAutenticated'] = true;
  }

  public static function clearAuthentication() 
  {
    $_SESSION['_isAutenticated'] = false;
  }

  public static function isAuthenticated() 
  {
    return $_SESSION['_isAutenticated'];
  }

  public static function validateId($val)
  {
    $res = true;
    if (empty($val)) {

      Msg::push(Msg::ERROR, 'ユーザ-IDを入力してください');
      $res = false;

    } else if (!preg_match('/^[a-zA-Z0-9]{1,10}$/', $val)) {

      Msg::push(Msg::ERROR, 'ユーザーIDは10文字以下の英数字で入力してください');
      $res = false;

    }

    return $res;
  }

  public function isValidId() 
  {
    return static::validateId($this->user_id);
  }

  public function isUniqueId() 
  {
    return UserQuery::isUniqueId($this->user_id);
  }

  public static function validatePwd($val)
  {
    $res = true;
    if (empty($val)) {

      Msg::push(Msg::ERROR, 'パスワードを入力してください');
      $res = false;

    } else if (!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{6,12}$/', $val)) {

      Msg::push(Msg::ERROR, 'パスワードは、英数両方を含んだ6~12文字の英数字で入力してください');
      $res = false;

    }

    return $res;
  }

  public function isValidPwd()
  {
    return static::validatePwd($this->password);
  }

  public static function validateNick($val)
  {
    $res = true;
    if (empty($val)) {

      Msg::push(Msg::ERROR, 'ニックネームを入力してください');
      $res = false;

    } else if (!preg_match('/^[ぁ-んァ-ヶｦ-ﾝ一-龠々ー]{1,10}$/u', $val)) {

      Msg::push(Msg::ERROR, 'ニックネームは10文字以下の日本語で入力してください');
      $res = false;

    }

    return $res;
  }

  public function isValidNick()
  {
    return static::validateNick($this->nickname);
  }
}