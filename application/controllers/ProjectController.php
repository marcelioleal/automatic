<?php

use Automatic\Model;
use Automatic\Project;
use Automatic\MapperFactoryGenerator;
use Automatic\EntityFactoryGenerator;
use Automatic\AutomaticRepositoryGenerator;
class ProjectController extends \Zend\Controller\Action{

    public function init(){
        $this->_helper->layout->disableLayout();
    }

    public function indexAction(){
    
    }
    
    public function listAction(){
        
        $projects = Project::loadProjects();
        $this->view->projects = $projects['projects'];
        /*
    	$projectsDir = APPLICATION_PATH.'/projects';
    	$list = scandir($projectsDir);
    	$this->view->dirList = array();
    	foreach ($list as $item) {
    		if(substr($item, 0,1)<>'.')
    			$this->view->dirList[] = $item;
    	}*/
    }
   
    public function actionsAction(){
    
    }
    
    public function newAction(){
    
    }
    
    public function createAction(){
    	$request = $this->getRequest()->getPost();
    	$project = new Project();
    	$project->create($request['name'], $request['dbname'], $request['user'], $request['password']);
    	$project->configure();
    	$project->generate();
    	
    	$model = new Model($project);
    	$model->generateEntities();
    	$model->generateEntityFactory();
    	$model->generateMappers();
    	$model->generateMapperFactory();
    	$model->generateBM();
    	
        /*
		$config = new Doctrine\ORM\Configuration();

		$cache = new \Doctrine\Common\Cache\ApcCache;
		$config->setMetadataCacheImpl($cache);
		$driverImpl = $config->newDefaultAnnotationDriver(APPLICATION_PATH . '/models');
		$config->setMetadataDriverImpl($driverImpl);

		$config->setQueryCacheImpl($cache);
		$config->setProxyDir(APPLICATION_PATH . '/proxies');
		$config->setProxyNamespace('Application\Proxies');
    	

    	$request = $this->getRequest()->getPost();
    	$options = array('dbname' => $request['dbname'],
    					 'user' => $request['user'],
    					 'password' => $request['password'],
    					 'host' => '127.0.0.1',
    					 'driver' => 'pdo_mysql');
    	$project = $request['name'];
    	$projectDir = APPLICATION_PATH.'/projects/'.$project;
    	if($em = Doctrine\ORM\EntityManager::create($options, $config)){
	    	$classes = $this->getClassesMetadata($em);
	    	$this->createProject($projectDir);
	    	$this->setConfig($projectDir, $options);
	    	$this->generateEntities($classes, $projectDir);
	    	$this->generateEntityFactory($classes, $projectDir);
	    	$this->generateMappers($classes, $projectDir);
	    	$this->generateMapperFactory($classes, $projectDir);
    	}
    	*/
    }
    
	public function createProject($projectDir){
		try{
			mkdir($projectDir, 0777, true);
			$filename = APPLICATION_PATH.'/../templates/project.zip';
			$zip = new \ZipArchive();
			if($zip->open($filename)===true){
				$zip->extractTo($projectDir);
				$zip->close();
			}
			$dir = scandir($projectDir);
			//chmod($projectDir, 0777);
			foreach ($dir as $file){
				if(substr($file, 0,1)<>'.')
					chmod($projectDir.'/'.$file, 0777);
			}
			chmod($projectDir.'/application/models', 0777);
			
		}catch (Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function setConfig($projectDir, $options){
		try{
			$fileContent = file_get_contents(APPLICATION_PATH.'/../templates/application.ini');
			$fileContent = str_replace('%DBNAME%', $options['dbname'], $fileContent);
			$fileContent = str_replace('%USERNAME%', $options['user'], $fileContent);
			$fileContent = str_replace('%PASSWORD%', $options['password'], $fileContent);
			file_put_contents($projectDir.'/application/configs/application.ini', $fileContent);
		}catch (Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function getClassesMetadata($em){
		$em->getConfiguration()->setMetadataDriverImpl(
		    new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
		        $em->getConnection()->getSchemaManager()
		    )
		);		
		$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($em);

		$classes = $cmf->getAllMetadata();
		foreach ($classes as $class){
			$class->customRepositoryClassName = 'Mapper\\'.$class->name;
			$class->name = 'Entities\\'.$class->name;
			$class->rootEntityName = $class->name;
		}
		
		return $classes;
	}
	
	public function generateEntities($classes, $projectDir){
				
		$generator = new \Doctrine\ORM\Tools\EntityGenerator(); 
		$generator->setGenerateAnnotations(true); 
		//Generates the get and set method
		//$generator->setGenerateStubMethods(true); 
		$generator->setRegenerateEntityIfExists(false); 
		$generator->setUpdateEntityIfExists(true);
		$generator->generate($classes, $projectDir.'/application/models');
	}
	
	public function generateEntityFactory($classes, $projectDir){
		$factory = new EntityFactoryGenerator($classes, $projectDir);
		$factory->generate();
	}
	
	public function generateMappers($classes, $projectDir){		
		$generator2 = new \Doctrine\ORM\Tools\EntityRepositoryGenerator(); 
		$generator2->writeEntityRepositoryClass('Mapper\\BaseMapper', $projectDir.'/application/models');
		
		$generator3 = new AutomaticRepositoryGenerator();
		foreach ($classes as $metadata) {
		 	$generator3->writeEntityRepositoryClass($metadata->customRepositoryClassName,$projectDir.'/application/models');
		}	
	}
	
	public function generateMapperFactory($classes, $projectDir){
		$factory = new MapperFactoryGenerator($classes, $projectDir);
		$factory->generate();
	}
}

