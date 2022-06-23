<?php
namespace db;

use model\FitnessModel;

class FitnessQuery
{
  public static function insert($fitness, $user) 
  {
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
}