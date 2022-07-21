<?php
namespace app\core;

use app\core\Message\Msg;
use db\FitnessQuery;
use db\RewardQuery;
use db\UserQuery;

class Validation {
  // user
  public static function validateId($user_id, $is_signup = false)
  {
    $res = true;
    if (empty($user_id)) {

      Msg::push(Msg::ERROR, 'ユーザ-IDを入力してください');
      $res = false;

    } else if (!preg_match('/^[a-zA-Z0-9]{1,10}$/', $user_id)) {

      Msg::push(Msg::ERROR, 'ユーザーIDは10文字以下の英数字で入力してください');
      $res = false;

    } else if ($is_signup && !UserQuery::isUniqueId($user_id)) {

      Msg::push(Msg::ERROR, 'すでに登録済のユーザーです');
      $res = false;

    }

    return $res;
  }

  public static function validatePwd($password)
  {
    $res = true;
    if (empty($password)) {

      Msg::push(Msg::ERROR, 'パスワードを入力してください');
      $res = false;

    } else if (!preg_match('/^(?=.*[a-z])(?=.*[[A-Z])(?=.*[0-9])[a-zA-Z0-9]{10,20}$/', $password)) {

      Msg::push(Msg::ERROR, 'パスワードは、英大文字、小文字と数字を含んだ10~20文字の英数字で入力してください');
      $res = false;

    }

    return $res;
  }

  public static function validateNickname($nickname)
  {
    $res = true;
    if (empty($nickname)) {

      Msg::push(Msg::ERROR, 'ニックネームを入力してください');
      $res = false;

    } else if ((mb_strlen($nickname) > 10)) {

      Msg::push(Msg::ERROR, 'ニックネームは10文字以下で入力してください');
      $res = false;

    }

    return $res;
  }

  public static function validateFitnessName($name, $user_id, $id = 0)
  {
    $res = true;

    if (empty($name)) {

      Msg::push(Msg::ERROR, '名前を入力してください');
      $res = false;

    } else if (mb_strlen($name) > 10) {

      Msg::push(Msg::ERROR, '名前は10文字以下で入力してください');
      $res = false;

    } else if (!FitnessQuery::isUniqueName($name, $user_id, $id)) {

      Msg::push(Msg::ERROR, 'フィットネスはすでに登録済みです');
      return false;

    }

    return $res;
  }

  // fitness
  public static function validateLevel($level)
  {
    $res = true;

    if (empty($level)) {

      Msg::push(Msg::ERROR, 'レベルを入力してください');
      $res = false;

    } else if ($level > 100) {

      Msg::push(Msg::ERROR, 'レベルは100以下で入力してください');
      $res = false;

    }

    return $res;
  }

  // reward
  public static function validateRewardName($name, $user_id, $id = 0)
  {
    $res = true;

    if (empty($name)) {

      Msg::push(Msg::ERROR, '名前を入力してください');
      $res = false;

    } else if (mb_strlen($name) > 10) {

      Msg::push(Msg::ERROR, '名前は10文字以下で入力してください');
      $res = false;

    } else if (!RewardQuery::isUniqueName($name, $user_id, $id)) {

      Msg::push(Msg::ERROR, '報酬はすでに登録済みです');
      return false;

    }
    

    return $res;
  }

  public static function validatePrice($level)
  {
    $res = true;

    if (empty($level)) {

      Msg::push(Msg::ERROR, 'レベルを入力してください');
      $res = false;

    } else if ($level < 100 and $level > 10000) {

      Msg::push(Msg::ERROR, 'レベルは100以上1000以下で入力してください');
      $res = false;

    }

    return $res;
  }
}