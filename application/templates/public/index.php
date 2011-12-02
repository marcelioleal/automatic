<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));
    
// Define path to application directory
defined('ROOT')
    || define('ROOT', realpath(__DIR__ . '/../'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));    
    
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/../../library'),
//    realpath(APPLICATION_PATH . '/../../library/zf22/library'),
    realpath(APPLICATION_PATH . '/../tests'),
    realpath(APPLICATION_PATH . '/../application/models'),
    get_include_path(),
)));

// Define path to application directory
defined('BASE_URL')
    || define('BASE_URL', '/<<project>>/public/');

/** Zend_Application */
require_once 'Zend/Application/Application.php';


// Create application, bootstrap, and run
$application = new Zend\Application\Application (
    APPLICATION_ENV,
    APPLICATION_PATH . '/conf/application.ini'
);
$application->bootstrap()
            ->run();
