<?php
namespace db;

use db\DataSource;
use model\UserModel;

class UserQuery {
  public static function fetchById($user_id) 
  {
    $db = new DataSource;
    $sql = 'select * from user where user_id = :user_id;';

    $result = $db->selectOne($sql, [
      ':user_id' => $user_id
    ], DataSource::CLS, UserModel::class);

    return $result;
  }

  public static function insert($user)
  {
    $db = new DataSource;
    $sql = 'insert into user(user_id, password, nickname) values (:user_id, :password, :nickname)';

    $user->password = password_hash($user->password, PASSWORD_DEFAULT);

    $result = $db->execute($sql, [
      ':user_id' => $user->user_id,
      ':password' => $user->password,
      ':nickname' => $user->nickname,
    ]);

    return $result;
  }

  public static function addMoney($user_id, $add)
  {
    $db = new DataSource;
    $sql = 'UPDATE user SET money = money + :add WHERE user_id = :user_id';

    $result = $db->execute($sql, [
      ':add'     => $add,
      ':user_id' => $user_id,
    ]);

    return $result;
  }

  public static function subtractMoney($user_id, $subtract)
  {
    $db = new DataSource;
    $sql = 'UPDATE user SET money = money - :subtract WHERE user_id = :user_id';

    $result = $db->execute($sql, [
      ':subtract' => $subtract,
      ':user_id'  => $user_id,
    ]);

    return $result;
  }

  public static function isUniqueId($user_id)
  {
    $db = new DataSource;
    $sql = 'SELECT COUNT(user_id) as count FROM user WHERE user_id = :user_id';

    $result = $db->select($sql, [':user_id' => $user_id ]);
    
    if ($result['count'] === 0) {
      return true;
    } else {
      return false;
    }
  }
}