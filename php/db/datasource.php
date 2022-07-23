<?php
namespace db;

use Exception;
use PDO;

class DataSource {

  public $conn;
  
  private function __construct($host = 'db', $port = '3306', $dbName = 'fitnessdb', $username = 'd.imabeppu', $password = 'fitness')
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

  public static function getInstance()
  {
    static $instance;
    return $instance ?? $instance = new self;
  }

  public final function __clone()
  {
    throw new Exception("singletonのため複製できません");
  }
}