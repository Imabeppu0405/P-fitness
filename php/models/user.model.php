<?php
namespace model;

use app\core\Message\Msg;

class UserModel {
  public string $user_id;
  public string $password;
  public string $nickname;
  public int $exp;
  public int $money;

  #TODO: 形式チェック
  public static function validateId($val)
  {
    $res = true;
    if(empty($val)) {
      Msg::push(Msg::ERROR, 'ユーザ-IDを入力してください');
      $res = false;
    } else if(strlen($val) > 10) {
      Msg::push(Msg::ERROR, 'ユーザーIDは10文字以下で入力してください');
      $res = false;
    }
    
    #TODO: 文字種制
    return $res;
  }

  public function isValidId() {
    return static::validateId($this->user_id);
  }

  public static function validatePwd($val)
  {
    $res = true;
    if(empty($val)) {
      Msg::push(Msg::ERROR, 'パスワードを入力してください');
      $res = false;
    } else if(strlen($val) > 12 or strlen($val) < 6) {
      Msg::push(Msg::ERROR, 'パスワードは6~12文字で入力してください');
      $res = false;
    }

    #TODO: 文字種制限

    return $res;
  }

  public function isValidPwd()
  {
    return static::validatePwd($this->password);
  }

  public static function validateNick($val)
  {
    $res = true;
    if(empty($val)) {
      Msg::push(Msg::ERROR, 'ニックネームを入力してください');
      $res = false;
    } else if(strlen($val) > 10) {
      Msg::push(Msg::ERROR, 'ニックネームは10文字以下で入力してください');
      $res = false;
    }

    #TODO: 文字種制限

    return $res;
  }

  public function isValidNick()
  {
    return static::validateNick($this->nickname);
  }

}