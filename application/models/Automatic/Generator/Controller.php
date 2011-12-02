<?php

namespace Automatic\Generator;

use Automatic\Util\Mapper;
use \Zend\CodeGenerator\Php\PhpClass;
use \Zend\CodeGenerator\Php\PhpMethod;
use \Zend\CodeGenerator\Php\PhpParameter;
use \Zend\CodeGenerator\Php\PhpProperty;
use \Zend\CodeGenerator\Php\PhpFile;
use \Zend\Reflection\ReflectionClass;

use \Util\GeneratorUtil;
use \Util\File;


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
        $methodTemplate = File::copyContent($this->templatesDir."postDispacthMethod");
        return $methodTemplate;
    }
    
    public function getBodyAdd($metadata){
        $bodyTemplate = File::copyContent($this->templatesDir."addMethod");
        $bodyTemplate = GeneratorUtil::replaceAll(array("<<entity>>" => lcfirst($metadata->name),"<<Entity>>" => ucfirst($metadata->name)),$bodyTemplate);
        
        $fields = "";
        foreach ($metadata->fieldNames as $field){
            if(!Mapper::isPKSequence($metadata,$field)){
                $fields[] = '$inputs[\''.$field.'\']';
            }
        }
        $bodyTemplate = GeneratorUtil::replace("<<params>>",implode($fields,","),$bodyTemplate);
        
        return $bodyTemplate;
    }
    
    public function getBodyEdit($metadata){
        $bodyTemplate = File::copyContent($this->templatesDir."editMethod");
        $bodyTemplate = GeneratorUtil::replaceAll(array("<<entity>>" => lcfirst($metadata->name),"<<Entity>>" => ucfirst($metadata->name)),$bodyTemplate);
        
        $fields = "";
        foreach ($metadata->fieldNames as $field){
            if(!Mapper::isPKSequence($metadata,$field)){
                $fields[] = '$inputs[\''.$field.'\']';
            }
        }
        $bodyTemplate = GeneratorUtil::replace("<<params>>",implode($fields,","),$bodyTemplate);
        
        return $bodyTemplate;
    }
    
    public function getBodyDel($metadata){
        $bodyTemplate = File::copyContent($this->templatesDir."delMethod");
        $bodyTemplate = GeneratorUtil::replaceAll(array("<<entity>>" => lcfirst($metadata->name),"<<Entity>>" => ucfirst($metadata->name)),$bodyTemplate);
        return $bodyTemplate;
    }
    
    public function getBodyView($metadata){
        $bodyTemplate = File::copyContent($this->templatesDir."viewMethod");
        $bodyTemplate = GeneratorUtil::replaceAll(array("<<entity>>" => lcfirst($metadata->name)),$bodyTemplate);
        return $bodyTemplate;
    }
    
    public function getBodyList($metadata){
        $bodyTemplate = File::copyContent($this->templatesDir."listMethod");
        $bodyTemplate = GeneratorUtil::replaceAll(array("<<entity>>" => lcfirst($metadata->name),"<<Entity>>" => ucfirst($metadata->name)),$bodyTemplate);
        return $bodyTemplate;
    }
    
    public function genEachClass(){
        foreach ($this->project->metadata as $metadata){
            $class = GeneratorUtil::createClass($metadata->name."Controller","\Util\Controller");
            
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
        //$this->genController();
        $this->genEachClass();
    }
    
    
    
}