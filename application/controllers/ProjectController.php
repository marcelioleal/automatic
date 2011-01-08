<?php

use Automatic\Generator\Model;
use Automatic\Generator\Project;
use Automatic\MapperFactoryGenerator;
use Automatic\EntityFactoryGenerator;
use Automatic\AutomaticRepositoryGenerator;
use Zend\CodeGenerator\Php;

class ProjectController extends \Zend\Controller\Action{

    public function init(){
        $this->_helper->layout->disableLayout();
    }

    public function indexAction(){
        
    }
    
    public function newAction(){
        $configModel = new Automatic\Configuration();
        $this->view->driver   = $configModel->getParam("doctrine.db.driver");
        $this->view->host     = $configModel->getParam("doctrine.db.host");
        $this->view->user     = $configModel->getParam("doctrine.db.user");
        $this->view->pass     = $configModel->getParam("doctrine.db.password");
    }
    
    public function listAction(){
        $projects = Project::loadProjects();
        $this->view->projects = $projects['projects'];
    }
   
    public function saveAction(){
        $inputs = $this->getRequest()->getParams();
        if($inputs["name"]){ 
            $project = new Project();
            $project->create($inputs["name"],$inputs["dbname"],$inputs["user"],$inputs["password"]);
        }
        Zend\Controller\Front::getInstance()->setParam('noViewRenderer', true);
        #TODO: Valide Project
        #TODO: Update list of projects
        $this->_redirector = $this->_helper->getHelper('Redirector');
        $this->_redirector->gotoSimple('info',
                                       'project',
                                       null,
                                       array('project' => $project->name)
                                       );
    }
    
    public function infoAction(){
        $inputs = $this->getRequest()->getParams();
    	$project = Project::load($inputs['project']);
        $model = new Model($project);
        $this->view->classes = $model->metadata;
        $project->metadata =  $model->metadata;
        $this->view->project = $project;
        
    }
    
    public function generateAction(){
        $inputs = $this->getRequest()->getPost();
    	$project = new Project();
    	$project = Project::load($inputs['project']);
    	$project->configure();
    	$project->generate();
    	
        $model = new Model($project);
        $model->generateEntities();
    	$model->generateEntityFactory();
    	$model->generateMappers();
    	$model->generateMapperFactory();
    	$model->generateBM();
    	Zend\Controller\Front::getInstance()->setParam('noViewRenderer', true);
    	print "Success!";
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
    					 #TODO: Global Parameter
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
	    	
	    	$this->generateControllers($classes, $projectDir);
	    	//$this->generateInterfaces($classes, $projectDir);
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
		try{
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
		}catch (Exception $e){
		    print $e->getMessage();
		}
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
	
	public function generateControllers($classes,$projectDir){
	    foreach ($classes as $metadata) {
	        // Configuring after instantiation
            $method = new Php\PhpMethod();
            $method->setName('addAction')
                   ->setBody('echo \'Hello world!\';');
             
            $class = new Php\PhpClass();
            $class->setName(substr($class->name))
                  ->setMethod($method);
             
            $file = new Php\PhpFile();
            $file->setClass($class);
            
            $outputDir = $projectDir.'/application/controllers'; 
            $fullClassName = "TesteController";
            
            $path = $outputDir.DIRECTORY_SEPARATOR.str_replace('\\', \DIRECTORY_SEPARATOR, $fullClassName) . '.php';
            // or write it to a file:
            $dir = dirname($path);
    
            if ( ! is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
    
            if ( ! file_exists($path)) {
               file_put_contents($path, $file->generate());
            }
	    }
	}
}

