<?php

namespace model;

use app\core\Message\Msg;

class FitnessModel extends AbstractModel
{
  public int $id;
  public string $name;
  public int $level;
  public int $category;
  public string $user_id;
  public int $delete_flag;
  public int $is_create;
  protected static $SESSION_NAME = '_fitness';

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

  public function isValidName() {
    return static::validateName($this->name);
  }

  public static function validateLevel($val)
  {
    $res = true;

    if (empty($val)) {
      Msg::push(Msg::ERROR, 'レベルを入力してください');
      $res = false;
    } else if ($val > 100) {
      Msg::push(Msg::ERROR, 'レベルは100以下で入力してください');
      $res = false;
    }

    return $res;
  }

  public function isValidLevel() {
    return static::validateLevel($this->level);
  }
}