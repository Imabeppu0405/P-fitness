<?php
namespace db;

use app\core\Validation;
use app\core\FitnessModel;

class FitnessQuery
{
  public static function insert($fitness, $user) 
  {
    if (!(Validation::validateFitnessName($fitness->name, $user->user_id) * Validation::validateLevel($fitness->level))) {
      return false;
    }

    $db = DataSource::getInstance();
    $sql = 'insert into fitness(name, level, category, user_id) values (:name, :level, :category, :user_id)';

    return $db->execute($sql, [
      ':name'        => $fitness->name,
      ':level'       => $fitness->level,
      ':category'    => $fitness->category,
      ':user_id'     => $user->user_id,
    ]);
  }

  public static function update($fitness, $user)
  {
    if (!(Validation::validateFitnessName($fitness->name, $user->user_id, $fitness->id) * Validation::validateLevel($fitness->level))) {
      return false;
    }

    $db = DataSource::getInstance();
    $sql = 'update fitness set name = :name, level = :level, category = :category where id = :id';

    return $db->execute($sql, [
      ':name'        => $fitness->name,
      ':level'       => $fitness->level,
      ':category'    => $fitness->category,
      ':id'          => $fitness->id,
    ]);
  }

  public static function delete($id)
  {
    $db = DataSource::getInstance();
    $sql = 'update fitness set delete_flag = 1 where id = :id';

    return $db->execute($sql, [
      ':id'          => $id,
    ]);
  }

  public static function fetchById($user_id)
  {
    $db = DataSource::getInstance();
    $sql = '
    select * from fitness where user_id = :user_id and delete_flag = 0';

    $result = $db->select($sql, [
      ':user_id' => $user_id
    ],
    DataSource::CLS, FitnessModel::class);

    return $result;
  }

  public static function isUniqueName($name, $user_id, $id)
  {
    $db = DataSource::getInstance();
    $sql = 'SELECT COUNT(id) as count FROM fitness WHERE name = :name and delete_flag = 0 and user_id = :user_id and id != :id';

    $result = $db->select($sql, [
      ':name'    => $name,
      ':user_id' => $user_id,
      ':id'      => $id
    ]);
    
    if ($result[0]['count'] === 0) {
      return true;
    } else {
      return false;
    }
  }
}