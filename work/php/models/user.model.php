<?php
namespace model;

class UserModel {
  public string $user_id;
  public string $password;
  public string $nickname;
  public int $exp;
  public int $money;

  #TODO: 形式チェック
}