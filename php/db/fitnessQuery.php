<?php
namespace db;

use app\core\Validation;
use app\core\FitnessModel;

class FitnessQuery extends DbQuery
{
  public static function insert($fitness, $user) 
  {
    if (!(Validation::validateFitnessName($fitness->name, $user->user_id) * Validation::validateLevel($fitness->level))) {
      return false;
    }
    $sql = 'insert into fitness(name, level, category, user_id) values (:name, :level, :category, :user_id)';

    return self::execute($sql, [
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

    $sql = 'update fitness set name = :name, level = :level, category = :category where id = :id';

    return self::execute($sql, [
      ':name'        => $fitness->name,
      ':level'       => $fitness->level,
      ':category'    => $fitness->category,
      ':id'          => $fitness->id,
    ]);
  }

  public static function delete($id)
  {
    $sql = 'update fitness set delete_flag = 1 where id = :id';

    return self::execute($sql, [
      ':id'          => $id,
    ]);
  }

  public static function fetchById($user_id)
  {
    $sql = '
    select * from fitness where user_id = :user_id and delete_flag = 0';

    $result = self::select($sql, [
      ':user_id' => $user_id
    ],
    self::CLS, FitnessModel::class);

    return $result;
  }

  public static function isUniqueName($name, $user_id, $id)
  {
    $sql = 'SELECT COUNT(id) as count FROM fitness WHERE name = :name and delete_flag = 0 and user_id = :user_id and id != :id';

    $result = self::select($sql, [
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