<?php
require_once '../config.php';

// core
require_once SOURCE_BASE . 'core/Application.php';
require_once SOURCE_BASE . 'core/Request.php';
require_once SOURCE_BASE . 'core/Router.php';
require_once SOURCE_BASE . 'core/Helper.php';
require_once SOURCE_BASE . 'core/Auth.php';

// models
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/fitness.model.php';

// message
require_once SOURCE_BASE . 'core/Message.php';

// sql
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';
require_once SOURCE_BASE . 'db/fitness.query.php';

// partial
require_once SOURCE_BASE . 'partials/header.php';
require_once SOURCE_BASE . 'partials/footer.php';

// views
require_once SOURCE_BASE . 'views/home.php';
require_once SOURCE_BASE . 'views/signin.php';
require_once SOURCE_BASE . 'views/signup.php';

use app\core\Application;

session_start();
ob_start();


\partials\header();
$app = new Application();

$app->run();

\partials\footer();

?>