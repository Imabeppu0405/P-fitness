
<?php
require_once '../config.php';

// core
require_once SOURCE_BASE . 'core/Application.php';
require_once SOURCE_BASE . 'core/Request.php';
require_once SOURCE_BASE . 'core/Router.php';
require_once SOURCE_BASE . 'core/Helper.php';

// partial
require_once SOURCE_BASE . 'partials/header.php';
require_once SOURCE_BASE . 'partials/footer.php';

// views
require_once SOURCE_BASE . 'views/home.php';
require_once SOURCE_BASE . 'views/signin.php';

use app\core\Application;

\partials\header();
$app = new Application();

$app->run();

\partials\footer();

?>