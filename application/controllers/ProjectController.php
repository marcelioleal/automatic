<?php

use Automatic\Generator;
use Automatic\Generator\Project;
use Automatic\Generator\Model;
use Automatic\Generator\View;
use Automatic\Generator\Controller;

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
    	$project = Generator\Project::load($inputs['project']);
        $model = new Generator\Model($project);
        $this->view->classes = $project->metadata;
        $this->view->project = $project;
        
    }
    
    public function generateAction(){
        $inputs = $this->getRequest()->getPost();
    	$project = new Generator\Project();
    	$project = Project::load($inputs['project']);
    	$project->generate();
    	$project->configure();
    	
        $model = new Model($project);
        $model->generate();    
    	
    	$controller = new Controller($project);
    	$controller->generate();
    	
    	$view = new View($project);
    	$view->generate();
    	
//    	$js = new JS($project);
//    	$js->generate();
//    	
//    	$test = new Test($project);
//    	$test->generate();
    	
    	Zend\Controller\Front::getInstance()->setParam('noViewRenderer', true);
    	print "Success!";
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

