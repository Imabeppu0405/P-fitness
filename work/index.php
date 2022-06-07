<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>P-fitness</title>
</head>
<body>
<?php
define('HOSTNAME', 'db');
define('PORT', '3306');
define('DATABASE', 'fitnessdb');
define('USERNAME', 'd.imabeppu');
define('PASSWORD', 'fitness');

try {
  $db  = new PDO('mysql:host=' . HOSTNAME .';port=' . PORT . ';dbname=' . DATABASE, USERNAME, PASSWORD);
  $msg = "MySQL への接続確認が取れました。";
} catch (PDOException $e) {
  $isConnect = false;
  $msg       = "MySQL への接続に失敗しました。<br>(" . $e->getMessage() . ")";
}
?>
  <h1>MySQL接続確認</h1>
  <p><?php echo $msg; ?></p>
</body>
</html>