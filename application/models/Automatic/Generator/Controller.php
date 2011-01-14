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
    }
    
    public function generate(){
        
        $class = GeneratorUtil::createClass("Controller","\Zend\Controller\Action");
        GeneratorUtil::savePHPClass($class,$this->project->path.'/application/controllers/'.$class->getName().'.php');
        
        foreach ($this->project->metadata as $metadata){
            $class = GeneratorUtil::createClass($metadata->name."Controller","Controller");
            
            $methodNames = array("init", "add","edit","del","view","list");
            foreach ($methodNames as $name) {
                $method = new PhpMethod();
                $method->setName($name."Action");
                //$method->setBody($body);
                $class->setMethod($method);
            }
            
            GeneratorUtil::savePHPClass($class,$this->project->path.'/application/controllers/'.$class->getName().'.php');
        }
    }
    
    
    
}