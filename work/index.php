
<?php
define('HOSTNAME', 'db');
define('PORT', '3306');
define('DATABASE', 'fitnessdb');
define('USERNAME', 'd.imabeppu');
define('PASSWORD', 'fitness');
require_once __DIR__ . '/php/core/Router.php';
require_once __DIR__ . '/php/core/Request.php';
require_once __DIR__ . '/php/core/Application.php';
require_once __DIR__ . '/php/partials/header.php';
require_once __DIR__ . '/php/partials/footer.php';

use app\core\Application;

$app = new Application();

\partials\header();

$app->router->get('/', function() {
  return 'ホームページです。';
});

$app->router->get('/signin', function() {
  return 'サインインページです。';
});

$app->run();

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
<?php
\partials\footer();
?>