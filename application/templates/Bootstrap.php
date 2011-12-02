<?php
use Doctrine\ORM\EntityManager,
	Doctrine\ORM\Configuration;
	
class Bootstrap extends \Zend\Application\Bootstrap
{		
	protected function _initDoctrine()
	{
        $config = new Configuration();
        //$cache = new \Doctrine\Common\Cache\ApcCache;
        //$config->setMetadataCacheImpl($cache);
        
        $driverImpl = $config->newDefaultAnnotationDriver(APPLICATION_PATH . '/models');
        $config->setMetadataDriverImpl($driverImpl);
        
        //$config->setQueryCacheImpl($cache);
        $config->setProxyDir(APPLICATION_PATH . '/models/Proxies');
        $config->setProxyNamespace('Proxies');
        
        $options = $this->getOption('doctrine');
        $config->setAutoGenerateProxyClasses($options['auto_generate_proxy_class']);
        $config->setAutoGenerateProxyClasses(true);
        
        $entityManager = EntityManager::create($options['db'], $config);
        \Zend\Registry::set('entitymanager',$entityManager);
        
        return $entityManager;
    }
    
    protected function _initLayout()
    {
        $layout = Zend\Layout\Layout::startMvc(
            array('layoutPath' => APPLICATION_PATH.'/views/layouts', 'layout' => 'default')
        );
    }
    
    protected function _initSesson()
    {
        $config = array(
            "save_path"             => ROOT."/data/sessions",
            "use_only_cookies"      => "on",
            "name"                  => "UNIQUE_NAME",
        	"remember_me_seconds"   => "864000"
        );
        $session = new Zend\Session\SessionManager($config);
        $session->start();
    }
    
    protected function _initConfig()
    {
        $options = $this->getOption('general');
        \Zend\Registry::set('config', $options);
    }
    
    protected function _initView()
    {
        $view = new Zend\View\View();
        $view->doctype('HTML5');
        $view->headTitle('Project')->setSeparator(' :: ');
        
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=iso-8859-1'); 
        //$view->headLink()->prependStylesheet(BASE_URL.'css/mainTags.css');
        //$view->headScript()->prependFile(BASE_URL.'/js/jquery-1.5.1.min.js');        
        $view->headMeta()->appendHttpEquiv('Content-Type',
                                   'text/html; charset=ISO-8859-1');
//                 ->appendHttpEquiv('Content-Language', 'pt-BR');
        return $view;
    }
    
    protected function _initHelpers()
    {
        
    }
    
    protected function _initRouters()
    {
        $fc = Zend\Controller\Front::getInstance();
        $router = $fc->getRouter();
        /*$login = new Zend\Controller\Router\Route\StaticRoute(
    		'login',
            array('controller' => 'index', 'action' => 'login')
        );
        $router->addRoute('login', $login);*/
    }
    
}