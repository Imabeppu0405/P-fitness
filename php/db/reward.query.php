<?php
namespace db;

use model\RewardModel;

class RewardQuery
{
  public static function insert($reward, $user) 
  {
    $db = new DataSource;
    $sql = 'insert into reward(name, price, user_id) values (:name, :price, :user_id)';

    return $db->execute($sql, [
      ':name'        => $reward->name,
      ':price' => $reward->price,
      ':user_id'     => $user->user_id,
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
}