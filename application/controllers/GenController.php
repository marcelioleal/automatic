<?php
require_once 'Doctrine/Common/ClassLoader.php';

class GenController extends Zend\Controller\Action
{

    public function init(){
        Zend\Controller\Front::getInstance()->setParam('noViewRenderer', true);
    	$this->_helper->layout->disableLayout();
    }
	
	public function doctrineAction()
    {		
		$em = \Zend\Registry::get('entitymanager');
		
		$em->getConfiguration()->setMetadataDriverImpl(
		    new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
		        $em->getConnection()->getSchemaManager()
		    )
		);		
		$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($em);

		$classes = $cmf->getAllMetadata();
		
		//$classes = $em->getClassMetadataFactory()->getAllMetadata();
		
		
		$generator = new \Doctrine\ORM\Tools\EntityGenerator(); 
		$generator->setGenerateAnnotations(true); 
		//Generates the get and set method
		//$generator->setGenerateStubMethods(true); 
		$generator->setRegenerateEntityIfExists(false); 
		$generator->setUpdateEntityIfExists(true);
		
		
		$generator->generate($classes, APPLICATION_PATH.'/models');
		
		
		$generator2 = new \Doctrine\ORM\Tools\EntityRepositoryGenerator(); 
		
		foreach ($classes as $metadata) {
			$metadata->name = str_replace("Entities", "Repositories", $metadata->name);
		 	$generator2->writeEntityRepositoryClass($metadata->name,APPLICATION_PATH.'/models');
		 	//Generate Selects
		 	//Generate Business Models
		 		//Generate Inserts
		 		//Generate Selects
		 	//Generate Controllers
		 	//Generate Interfaces
		}
		
		
		// I think I must extend the Doctrine classes
		
		// In a Controller Layer I have make a new class that join both frameworks
		
		
		//Now, i must add the magic methods
		// I really must use magic methods ?
			// Confirm with Rafa
			// Does It work ?
		// EntityRepoditories 
			// What is the rule to generate Entities Repositories ?
				// I think that tables where the percentage of FK is greater than 70% dont generate
				// When one class is FK of only one class dont generate
				// 
			// What's the methods we must generate ?
				// ?
		// Others classes in DAO ?

		// Is Model the same problem than Entity Repositories ? I think no.
		
		// Does Controller have the same problem than Entity Repositories ?
			// I think the Controller must generate all tables one by one
			// Views to
			  
		
		//Ohhh yes
		//Uuuuuhhhhuuuuu!!!
    }
	
    public function loadInfoAction(){
    	$em = \Zend\Registry::get('entitymanager');
    	$request = $this->getRequest()->getPost();
    	$this->autoloadDir($request['source']);
    	$source = array($request['source']);
    	
    	try {
	    	switch ($request['type']) {
	    		case 'annotations':
	    			$driver = $em->getConfiguration()->newDefaultAnnotationDriver($source);
	    			//$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($source);
	    		break;
	    		case 'yml':
	    			$driver = new \Doctrine\ORM\Mapping\Driver\YamlDriver($source);
	    		break;
	    		case 'xml':
	    			$driver = new \Doctrine\ORM\Mapping\Driver\XmlDriver($source);
	    		break;
	    		case 'php':
	    			$driver = new \Doctrine\ORM\Mapping\Driver\PHPDriver($source);
	    		break;
	    	}
	    	$em->getConfiguration()->setMetadataDriverImpl($driver);
	    	$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($em);
	    	//$cmf->getAllMetadata();
			$this->view->classes = $cmf->getAllMetadata();
	    	$this->render("load-info");
    	}catch (Exception $e){
    		
    		foreach ($e->getTrace() as $trace)
    			echo 'File: '.$trace['file'].'	Line: '.$trace['line'].'	Class:'.$trace['class']."\n";
    	
    	}
    }
    
    public function autoloadDir($dir){
    	$dirList = scandir($dir);
    	foreach ($dirList as $dirName){
    		if(substr($dirName, 0,1)<>'.'){   			
				$classLoader = new \Doctrine\Common\ClassLoader($dirName, $dir);
				$classLoader->register();
    		}
    	}
    }
    
}