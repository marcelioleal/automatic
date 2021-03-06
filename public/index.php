<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Define path to application directory
defined('BASE_URL')
    || define('BASE_URL', '/automatic/public/');

    
#TODO: Adicionar a pasta do Symfony dinamicamente a partir do include_path do doctrine    
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/../../library'),
    realpath(APPLICATION_PATH . '/../../library/Doctrine'),
    realpath(APPLICATION_PATH . '/../application/models'),
    get_include_path(),
)));


/** Zend_Application */
require_once 'Zend/Application/Application.php';
try{
    // Create application, bootstrap, and run
    $application = new Zend\Application\Application (
        APPLICATION_ENV,
        APPLICATION_PATH . '/configs/application.ini'
    );
    $application->bootstrap()
                ->run();
}catch(Exception $e){
    print $e->getMessage();
}

