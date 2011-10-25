<?php

namespace Util;

use Mapper\MapperFactory;

class Controller extends \Zend\Controller\Action{
    
    protected $config;
    protected $userL;
    protected $flashMessenger;
	
	public function init(){
	    $this->setConfig();
	    $this->startFlash();
	    $this->user();
	}
	
	
	public function postDispatch(){
	    $this->setFlash();
	}
		
	/* 
	 * Config Method
	 * 
	 */
    protected function setConfig(){
		$registry     = \Zend\Registry::getInstance();
		$this->config = $registry->config;
	}
	
	/*
	 * Views Methods
	 * 
	 * 
	 */
	protected function addPaginator($query){
		$paginator = new \Zend\Paginator\Paginator(new \Util\AdapterQuery($query));
		$paginator->setItemCountPerPage(10);
		$paginator->setCurrentPageNumber($this->getRequest()->getParam("page"));
		return $paginator;
	}
	
	/*
	 * Messenger Methods
	 * 
	 */
	protected function startFlash(){
        $this->flashMessenger  = $this->_helper->getHelper('FlashMessenger');
	}
	
	protected function setFlash(){
	    //$this->view->messages = $this->flashMessenger->getMessages();
	}

	protected function user(){
	    $this->setUser();
		//$this->verifyPermission($this->userLog->groupUser);
	}
	
	protected function setUser($view = false){
        $auth 					= new \Zend\Authentication\AuthenticationService();
        $this->userL 			= $auth->getIdentity();
        /*if($this->view)
            $this->view->userL 	= $this->userL;*/
	}
	
	
	public function verifyPermission($groupUser) {
//		#TODO: Refactoring
//	    $params		= $this->getRequest()->getParams();
//		$acl 		= AclModel::getInstance();
//		$resource	= "manager:".$params["controller"];
//		$result		= $acl->has($resource) && !$acl->isAllowed($groupUser, $resource, $params["action"]);
//		if($result) {
//			throw new SecurityException();
//		}
	}
	
	
}
