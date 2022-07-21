<?php
namespace app\core;

class UserModel {
  public string $user_id;
  public string $password;
  public string $nickname;
  public int $money;
}

class FitnessModel
{
  public int $id;
  public string $name;
  public int $level;
  public int $category;
  public string $user_id;
  public int $delete_flag;
  public int $is_create;
}

class rewardModel {
  public string $name;
  public int $price;
  public string $user_id;
  public int $is_create;
}