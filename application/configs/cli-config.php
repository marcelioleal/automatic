<?php

require_once 'Doctrine/Common/ClassLoader.php';

$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\ORM', null);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\DBAL', null);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', null);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Symfony', null);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Entities', __DIR__.'/../models');
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader('Proxies', __DIR__.'/../Proxies');
$classLoader->register();


$config = new \Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
//$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__."/../Models"));
$driverImpl = new \Doctrine\ORM\Mapping\Driver\YamlDriver(array(__DIR__."/yml"));
$config->setMetadataDriverImpl($driverImpl);


// Proxy configuration
$config->setProxyDir(__DIR__ . '/../Proxies');
$config->setProxyNamespace('Proxies');

// Database connection information
$connectionOptions = array(
    'driver' => 'pdo_mysql',
    'host' 	 => 'localhost',
	'dbname' => 'eventomatica',
	'user'	 => 'root'
);	

// Create EntityManager
$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

