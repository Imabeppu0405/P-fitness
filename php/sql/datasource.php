<?php
namespace db;

use PDO;

class DataSource {

  private $conn;
  private $result;
  public const CLS = 'cls';
  
  public function __construct($host = 'db', $port = '3306', $dbName = 'fitnessdb', $username = 'd.imabeppu', $password = 'fitness')
  {
    $dsn = "mysql:host={$host};port={$port};dbname={$dbName};";
    $this->conn = new PDO($dsn, $username, $password);
    // 結果を連想配列でとる
    $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // エラーを詳細に表示
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // 静的プレースホルダにする(SQLインジェクション対策)
    $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }

  private function executeSql($sql, $params)
  {
    $stmt = $this->conn->prepare($sql);
    $this->result = $stmt->execute($params);
    return $stmt;
  }

  public function select($sql = "", $params = [], $type = '', $cls = '')
  {
    $stmt = $this->executeSql($sql, $params);

    // クラスの形式で取るかどうか
    if ($type === static::CLS) {
      return $stmt->fetchAll(PDO::FETCH_CLASS, $cls);
    } else {
      return $stmt->fetchAll();
    }
  }

  public function execute($sql = "", $params = [])
  {
    $this->executeSql($sql, $params);
    return $this->result;
  }

  public function selectOne($sql = "", $params = [], $type = '', $cls = '')
  {
    $result = $this->select($sql, $params, $type, $cls);
    return count($result)> 0 ? $result[0] : false;
  }
}