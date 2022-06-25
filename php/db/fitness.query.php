<?php
namespace db;

use app\core\Message\Msg;
use model\FitnessModel;

class FitnessQuery
{
  public static function insert($fitness, $user) 
  {
    if (!($fitness->isValidName() * $fitness->isValidLevel())) {
      return false;
    }

    if (!self::isUniqueName($fitness->name, $user->user_id)) {
      Msg::push(Msg::ERROR, 'フィットネスはすでに登録済みです');
      return false;
    }

    $db = new DataSource;
    $sql = 'insert into fitness(name, description, level, category, user_id) values (:name, :description, :level, :category, :user_id)';

    return $db->execute($sql, [
      ':name'        => $fitness->name,
      ':description' => $fitness->description,
      ':level'       => $fitness->level,
      ':category'    => $fitness->category,
      ':user_id'     => $user->user_id,
    ]);
  }

  public static function update($fitness)
  {
    $db = new DataSource;
    $sql = 'update fitness set name = :name, description = :description, level = :level, category = :category where id = :id';

    return $db->execute($sql, [
      ':name'        => $fitness->name,
      ':description' => $fitness->description,
      ':level'       => $fitness->level,
      ':category'    => $fitness->category,
      ':id'          => $fitness->id,
    ]);
  }

  public static function delete($id)
  {
    $db = new DataSource;
    $sql = 'update fitness set delete_flag = 1 where id = :id';

    return $db->execute($sql, [
      ':id'          => $id,
    ]);
  }

  public static function fetchById($user_id)
  {
    $db = new DataSource;
    $sql = '
    select * from fitness where user_id = :user_id and delete_flag = 0';

    $result = $db->select($sql, [
      ':user_id' => $user_id
    ],
    DataSource::CLS, FitnessModel::class);

    return $result;
  }

  private function isUniqueName($name, $user_id)
  {
    $db = new DataSource;
    $sql = 'SELECT COUNT(id) as count FROM fitness WHERE name = :name and delete_flag = 0 and user_id = :user_id';

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