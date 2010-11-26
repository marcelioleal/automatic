<?php
use Doctrine\ORM\EntityManager,
	Doctrine\ORM\Configuration;
	
class Bootstrap extends \Zend\Application\Bootstrap {	
	
	protected function _initDoctrine() {

		$config = new Configuration();

		$cache = new \Doctrine\Common\Cache\ApcCache;
		$config->setMetadataCacheImpl($cache);

		$driverImpl = $config->newDefaultAnnotationDriver(APPLICATION_PATH . '/models');
		$config->setMetadataDriverImpl($driverImpl);

		$config->setQueryCacheImpl($cache);
		$config->setProxyDir(APPLICATION_PATH . '/proxies');
		$config->setProxyNamespace('Application\Proxies');

		$options = $this->getOption('doctrine');

		$config->setAutoGenerateProxyClasses($options['auto_generate_proxy_class']);
		
		$em = EntityManager::create($options['db'], $config);
    	
		\Zend\Registry::set('entitymanager',$em);
		
		return $em;
	}
	
}