<?php
namespace db;

use PDO;

abstract class DbQuery
{
  protected const CLS = 'cls';
  public static $result = null;

  public function executeSql($sql, $params)
  {
    $db = DataSource::getInstance();
    $stmt = $db->conn->prepare($sql);
    $result = $stmt->execute($params);
    return [
      'stmt'   => $stmt, 
      'result' => $result
    ];
  }

  public function select($sql = "", $params = [], $type = '', $cls = '')
  {
    $stmt = self::executeSql($sql, $params)['stmt'];

    // クラスの形式で取るかどうか
    if ($type === static::CLS) {
      return $stmt->fetchAll(PDO::FETCH_CLASS, $cls);
    } else {
      return $stmt->fetchAll();
    }
  }

  public function execute($sql = "", $params = [])
  {
    return self::executeSql($sql, $params)['result'];
  }

  public function selectOne($sql = "", $params = [], $type = '', $cls = '')
  {
    $result = self::select($sql, $params, $type, $cls);
    return count($result)> 0 ? $result[0] : false;
  }
}