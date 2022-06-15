<?php
namespace model;

use app\core\Message\Msg;

class UserModel extends AbstractModel {
  public string $user_id;
  public string $password;
  public string $nickname;
  public int $exp;
  public int $money;

  protected static $SESSION_NAME = '_user';

  #TODO: 形式チェック
  public static function validateId($val)
  {
    $res = true;
    if(empty($val)) {
      Msg::push(Msg::ERROR, 'ユーザ-IDを入力してください');
      $res = false;
    } else if(!preg_match('/^[a-zA-Z0-9]{1,10}$/', $val)) {
      Msg::push(Msg::ERROR, 'ユーザーIDは10文字以下の英数字で入力してください');
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
    } else if(!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{6,12}$/', $val)) {
      Msg::push(Msg::ERROR, 'パスワードは、英数両方を含んだ6~12文字の英数字で入力してください');
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
    } else if(!preg_match('/^[ぁ-んァ-ヶ-一-龠々]{1,10}$/u', $val)) {
      Msg::push(Msg::ERROR, 'ニックネームは10文字以下の日本語で入力してください');
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