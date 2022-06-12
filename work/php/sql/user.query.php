<?php
namespace db;

use db\DataSource;
use model\UserModel;

class UserQuery {
  public static function fetchById($user_id) {

    $db = new DataSource;
    $sql = 'select * from user where user_id = :user_id;';

    $result = $db->selectOne($sql, [
      ':user_id' => $user_id
    ], DataSource::CLS, UserModel::class);

    return $result;
  }
}