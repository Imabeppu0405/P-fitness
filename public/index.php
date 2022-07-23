<?php
require_once '../config.php';

// core
require_once SOURCE_BASE . 'core/Application.php';
require_once SOURCE_BASE . 'core/Request.php';
require_once SOURCE_BASE . 'core/Router.php';
require_once SOURCE_BASE . 'core/Auth.php';
require_once SOURCE_BASE . 'core/View.php';
require_once SOURCE_BASE . 'core/Session.php';


// libs
require_once SOURCE_BASE . 'libs/Message.php';
require_once SOURCE_BASE . 'libs/Validation.php';
require_once SOURCE_BASE . 'libs/Helper.php';
require_once SOURCE_BASE . 'libs/userClass.php';
require_once SOURCE_BASE . 'libs/fitnessClass.php';
require_once SOURCE_BASE . 'libs/rewardClass.php';

// db
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/dbRepository.php';
require_once SOURCE_BASE . 'db/userRepository.php';
require_once SOURCE_BASE . 'db/fitnessRepository.php';
require_once SOURCE_BASE . 'db/rewardRepository.php';

use app\core\Application;

session_start();
ob_start();


$app = new Application();

$app->run();


?>