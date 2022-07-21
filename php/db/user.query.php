<?php
namespace db;

use app\core\Message\Msg;
use db\DataSource;
use app\core\UserModel;

class UserQuery {
  public static function fetchById($user_id) 
  {
    $db = DataSource::getInstance();
    $sql = 'select * from user where user_id = :user_id;';

    $result = $db->selectOne($sql, [
      ':user_id' => $user_id
    ], DataSource::CLS, UserModel::class);

    return $result;
  }

  public static function insert($user)
  {
    $db = DataSource::getInstance();
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
    $db = DataSource::getInstance();
    $sql = 'UPDATE user SET money = money + :add WHERE user_id = :user_id';

    $result = $db->execute($sql, [
      ':add'     => $add,
      ':user_id' => $user_id,
    ]);

    return $result;
  }

  public static function subtractMoney($user, $subtract)
  {
    if ($user->money < $subtract) {
      Msg::push(Msg::ERROR, '残高不足のため購入できません');
      return false;
    }
    $db = DataSource::getInstance();
    $sql = 'UPDATE user SET money = money - :subtract WHERE user_id = :user_id';

    $result = $db->execute($sql, [
      ':subtract' => $subtract,
      ':user_id'  => $user->user_id,
    ]);

    return $result;
  }

  public static function isUniqueId($user_id)
  {
    $db = DataSource::getInstance();
    $sql = 'SELECT COUNT(user_id) as count FROM user WHERE user_id = :user_id';

    $result = $db->select($sql, [':user_id' => $user_id ]);
    
    if ($result[0]['count'] === 0) {
      return true;
    } else {
      return false;
    }
  }
}