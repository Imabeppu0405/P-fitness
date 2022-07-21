<?php
require_once '../config.php';

// core
require_once SOURCE_BASE . 'core/Application.php';
require_once SOURCE_BASE . 'core/Request.php';
require_once SOURCE_BASE . 'core/Router.php';
require_once SOURCE_BASE . 'core/Helper.php';
require_once SOURCE_BASE . 'core/Auth.php';
require_once SOURCE_BASE . 'core/View.php';
require_once SOURCE_BASE . 'core/Session.php';
require_once SOURCE_BASE . 'core/Format.php';

// models
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/fitness.model.php';
require_once SOURCE_BASE . 'models/reward.model.php';

// message
require_once SOURCE_BASE . 'core/Message.php';

// sql
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';
require_once SOURCE_BASE . 'db/fitness.query.php';
require_once SOURCE_BASE . 'db/reward.query.php';

// partial
// require_once SOURCE_BASE . 'partials/header.php';
// require_once SOURCE_BASE . 'partials/footer.php';

use app\core\Application;

session_start();
ob_start();


$app = new Application();

$app->run();


?>