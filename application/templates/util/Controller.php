<?php

namespace Util;

use Mapper\MapperFactory;

class Controller extends \Zend\Controller\Action
{
    
    protected $config;
    protected $flashMessenger;
	
	public function init()
	{
	    $this->setConfig();
	    $this->startFlash();
	}
	
	public function postDispatch()
	{
	    $this->setFlash();
	}
		
	/* 
	 * Config Method
	 * 
	 */
    protected function setConfig()
    {
		$registry     = \Zend\Registry::getInstance();
		$this->config = $registry->config;
	}
	
	/*
	 * Views Methods
	 * 
	 * 
	 */
	protected function addPaginator($query)
	{
		$paginator = new \Zend\Paginator\Paginator(new \Util\AdapterQuery($query));
		$paginator->setItemCountPerPage(10);
		$paginator->setCurrentPageNumber($this->getRequest()->getParam("page"));
		return $paginator;
	}
	
	/*
	 * Messenger Methods
	 * 
	 */
	protected function startFlash()
	{
        $this->flashMessenger  = $this->_helper->getHelper('FlashMessenger');
	}
	
	protected function setFlash()
	{
	    //$this->view->messages = $this->flashMessenger->getMessages();
	}
	
}


