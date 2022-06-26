<?php

namespace model;

use app\core\Message\Msg;

class rewardModel extends AbstractModel
{
  public string $name;
  public int $price;
  public string $user_id;
  public int $is_create;
  protected static $SESSION_NAME = '_reward';

  public static function validateName($val)
  {
    $res = true;

    if (empty($val)) {

      Msg::push(Msg::ERROR, '名前を入力してください');
      $res = false;

    } else if (mb_strlen($val) > 10) {

      Msg::push(Msg::ERROR, '名前は10文字以下で入力してください');
      $res = false;

    }

    return $res;
  }

  public function isValidName() 
  {
    return static::validateName($this->name);
  }

  public static function validatePrice($val)
  {
    $res = true;

    if (empty($val)) {

      Msg::push(Msg::ERROR, 'レベルを入力してください');
      $res = false;

    } else if ($val < 100 and $val > 10000) {

      Msg::push(Msg::ERROR, 'レベルは100以上1000以下で入力してください');
      $res = false;

    }

    return $res;
  }

  public function isValidPrice() 
  {
    return static::validateprice($this->price);
  }
}