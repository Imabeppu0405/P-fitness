<?php
define('SOURCE_BASE', __DIR__ . '/php/');
define('CURRENT_URI', $_SERVER{'REQUEST_URI'});
define('DEBUG', true);
define('NOT_AUTHENTICATED_PAGES', array('/signin', '/signup'));