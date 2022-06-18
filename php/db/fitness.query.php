<?php
namespace db;

class FitnessQuery
{
  public static function insert($fitness, $user) {
    $db = new DataSource;
    $sql = 'insert into fitness(name, description, level) values (:name. :description, :level, :user_id)';

    return $db->execute($sql, [
      ':name'        => $fitness->name,
      ':description' => $fitness->description,
      ':level'       => $fitness->level,
      ':user_id'     => $user->user_id,
    ]);
  }
}