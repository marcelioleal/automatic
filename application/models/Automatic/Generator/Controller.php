<?php

namespace Automatic\Generator;

use \Zend\CodeGenerator\Php\PhpClass;
use \Zend\CodeGenerator\Php\PhpMethod;
use \Zend\CodeGenerator\Php\PhpParameter;
use \Zend\CodeGenerator\Php\PhpProperty;
use \Zend\CodeGenerator\Php\PhpFile;
use \Zend\Reflection\ReflectionClass;

use \Util\GeneratorUtil;


class Controller implements Generator{
    
    public $project;
    
    public function __construct($project){
        $this->project = $project;
        $this->templatesDir = "controller/";
        $this->viewPath = $this->project->path.'/application/controllers/';
    }
    
    public function getBodyinit($metadata){
        $methodTemplate = File::copyContent($this->templatesDir."initMethod");
        return $methodTemplate;
    }
    
    public function getBodyPostDispatch($metadata){
        $methodTemplate = File::copyContent($this->templatesDir."postDispatchMethod");
        return $methodTemplate;
    }
    
    public function getBodyAdd($metadata){
        return $metadata->name;
    }
    
    public function getBodyEdit($metadata){
        return $metadata->name;
    }
    
    public function getBodyDel($metadata){
        return $metadata->name;
    }
    
    public function getBodyView($metadata){
        return $metadata->name;
    }
    
    public function getBodyList($metadata){
        return $metadata->name;
    }
    
    public function genEachClass(){
        foreach ($this->project->metadata as $metadata){
            $class = GeneratorUtil::createClass($metadata->name."Controller","\Controller\Controller");
            
            $methodNames = array("init", "postDispatch", "add","edit","del","view","list");
            foreach ($methodNames as $name) {
                $method = new PhpMethod();
                $method->setName($name."Action");
                eval('$body = $this->getBody'.ucfirst($name).'($metadata);'); 
                $method->setBody($body);
                $class->setMethod($method);
            }
            
            GeneratorUtil::savePHPClass($class,$this->project->path.'/application/controllers/'.$class->getName().'.php');
        }
    }
    
    public function genController(){
        $class = GeneratorUtil::createClass("Controller","\Zend\Controller\Action");
        
        GeneratorUtil::savePHPClass($class,$this->project->path.'/application/controllers/'.$class->getName().'.php');
    }
    
    
    public function generate(){
        $this->genController();
        $this->genEachClass();
    }
    
    
    
}