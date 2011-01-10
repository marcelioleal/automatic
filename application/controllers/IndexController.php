<?php

//include_once "facebook.php";

class IndexController extends \Zend\Controller\Action{

    public function init(){
        /* Initialize action controller here */
    }

    public function indexAction(){	
		
    }
    
    public function configAction(){	
        $configModel = new Automatic\Configuration();

        $request = $this->getRequest(); 
        if($request->getParam("driver")){
            $configModel->setParam("doctrine.db.driver",$request->getParam("driver"));
            $configModel->setParam("doctrine.db.host",$request->getParam("host"));
            $configModel->setParam("doctrine.db.user",$request->getParam("user"));
            $configModel->setParam("doctrine.db.password",$request->getParam("password"));
            $configModel->write();
        }
        
        $this->view->driver   = $configModel->getParam("doctrine.db.driver");
        $this->view->host     = $configModel->getParam("doctrine.db.host");
        $this->view->user     = $configModel->getParam("doctrine.db.user");
        $this->view->pass     = $configModel->getParam("doctrine.db.password");
    }
    
    public function homeAction(){
    
    }
    
    public function howtoAction(){
    
    }
    
    public function projectsAction(){
    
    }
    
}

