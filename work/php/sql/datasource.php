<?php 
function create_table() {
  $host = "localhost";
  $port = "8080";
  $db_database = "fitnessdb";
  $db_user = "d.imabeppu";
  $db_password = "fitness";

  try {
    $conn = new PDO("mysql:host=${host};port={$port};dbname={$db_database}, $db_user, $db_password");

    $sql = 'CREATE TABLE test (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(255),
      age INT
    )';

    $res = $conn->query($sql);

  } catch(PDOException $e) {

    die();
  }
  
  $conn = null;

};
?>