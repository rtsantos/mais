<?php

// Define path to application directory
define('APPLICATION_PATH', realpath('.') . '/application');

// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path('.' . PATH_SEPARATOR . 'library');

/** Zend_Application */
require_once 'Zend/Application.php';
require 'core.php';
// Create application, bootstrap, and run
$application = new Zend_Application(
        APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
        ->run();
