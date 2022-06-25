<?php
namespace db;

use app\core\Message\Msg;
use model\RewardModel;

class RewardQuery
{
  public static function insert($reward, $user) 
  {
    if (!($reward->isValidName() * $reward->isValidPrice())) {
      return false;
    }

    if (!self::isUniqueName($reward->name, $user->user_id)) {
      Msg::push(Msg::ERROR, '報酬はすでに登録済みです');
      return false;
    }
    $db = new DataSource;
    $sql = 'insert into reward(name, price, user_id) values (:name, :price, :user_id)';

    return $db->execute($sql, [
      ':name'    => $reward->name,
      ':price'   => $reward->price,
      ':user_id' => $user->user_id,
    ]);
  }

  public static function update($reward)
  {
    $db = new DataSource;
    $sql = 'update reward set name = :name, price = :price where id = :id';

    return $db->execute($sql, [
      ':name'  => $reward->name,
      ':price' => $reward->price,
      ':id'    => $reward->id,
    ]);
  }

  public static function delete($id)
  {
    $db = new DataSource;
    $sql = 'update reward set delete_flag = 1 where id = :id';

    return $db->execute($sql, [
      ':id'          => $id,
    ]);
  }

  public static function fetchById($user_id)
  {
    $db = new DataSource;
    $sql = '
    select * from reward where user_id = :user_id and delete_flag = 0';

    $result = $db->select($sql, [
      ':user_id' => $user_id
    ],
    DataSource::CLS, RewardModel::class);

    return $result;
  }

  private function isUniqueName($name, $user_id)
  {
    $db = new DataSource;
    $sql = 'SELECT COUNT(id) as count FROM reward WHERE name = :name and delete_flag = 0 and user_id = :user_id';

    $result = $db->select($sql, [
      ':name'    => $name,
      ':user_id' => $user_id,
    ]);
    
    if ($result[0]['count'] === 0) {
      return true;
    } else {
      return false;
    }
  }
}