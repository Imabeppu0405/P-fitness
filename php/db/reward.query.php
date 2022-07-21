<?php
namespace db;

use app\core\Validation;
use app\core\RewardModel;

class RewardQuery
{
  public static function insert($reward, $user) 
  {
    if (!(Validation::validateRewardName($reward->name, $user->user_id) * Validation::validatePrice($reward->price))) {
      return false;
    }
    
    $db = DataSource::getInstance();
    $sql = 'insert into reward(name, price, user_id) values (:name, :price, :user_id)';

    return $db->execute($sql, [
      ':name'    => $reward->name,
      ':price'   => $reward->price,
      ':user_id' => $user->user_id,
    ]);
  }

  public static function update($reward, $user)
  {
    if (!(Validation::validateRewardName($reward->name, $user->user_id, $reward->id) * Validation::validatePrice($reward->price))) {
      return false;
    }

    $db = DataSource::getInstance();
    $sql = 'update reward set name = :name, price = :price where id = :id';

    return $db->execute($sql, [
      ':name'  => $reward->name,
      ':price' => $reward->price,
      ':id'    => $reward->id,
    ]);
  }

  public static function delete($id)
  {
    $db = DataSource::getInstance();
    $sql = 'update reward set delete_flag = 1 where id = :id';

    return $db->execute($sql, [
      ':id'          => $id,
    ]);
  }

  public static function fetchById($user_id)
  {
    $db = DataSource::getInstance();
    $sql = '
    select * from reward where user_id = :user_id and delete_flag = 0';

    $result = $db->select($sql, [
      ':user_id' => $user_id
    ],
    DataSource::CLS, RewardModel::class);

    return $result;
  }

  public static function isUniqueName($name, $user_id, $id)
  {
    $db = DataSource::getInstance();
    $sql = 'SELECT COUNT(id) as count FROM reward WHERE name = :name and delete_flag = 0 and user_id = :user_id and id != :id';

    $result = $db->select($sql, [
      ':name'    => $name,
      ':user_id' => $user_id,
      ':id'      => $id,
    ]);
    
    if ($result[0]['count'] === 0) {
      return true;
    } else {
      return false;
    }
  }
}