<?php

namespace Automatic\Generator;

use Automatic\Util\Mapper;

use \Util\GeneratorUtil;
use \Util\File;
use \Automatic\Util;


class View implements Generator
{
    
    public $project;
    public $templatesDir;
    public $viewPath;
    
    function __construct($project)
    {
        $this->project = $project;
        $this->templatesDir = "view/";
        $this->viewPath = $this->project->path.'/application/views/scripts/';
    }
    
    public function add($class)
    {
        $viewTemplate = File::copyContent($this->templatesDir."add");
        $viewTemplate = GeneratorUtil::replaceAll(array("<class>" => $class->name,"<Class>" => ucfirst($class->name),"<action>" => "edit","<Action>" => "Edit"),$viewTemplate);
        
        $fields = "";
        foreach ($class->fieldNames as $field){
            if(!Mapper::isPKSequence($class,$field)){
                $viewF = File::copyContent($this->templatesDir."input");
                $array = array("<field>" => $field,"<Field>" => ucfirst($field),"<type>" => "text","<default>" => "", "<value>" => "","<required>" => "required");
                $viewF = GeneratorUtil::replaceAll($array,$viewF);
                $fields .= $viewF;
            }
        }
        $viewTemplate = GeneratorUtil::replace("<fields>",$fields,$viewTemplate);
        
        GeneratorUtil::saveHTMLFile($viewTemplate,$this->viewPath.strtolower($class->name).'/','add.phtml');
    }
    
    public function edit($class)
    {
        $viewTemplate = File::copyContent($this->templatesDir."add");
        $viewTemplate = GeneratorUtil::replaceAll(array("<class>" => $class->name,"<Class>" => ucfirst($class->name),"<action>" => "edit","<Action>" => "Edit"),$viewTemplate);
        
        $fields = "";
        foreach ($class->fieldNames as $field){
            if(!Mapper::isPKSequence($class,$field)){
                $viewF = File::copyContent($this->templatesDir."input");
                $value = '<?php print $'.lcfirst($class->name).'->get'.ucfirst($field).'(); ?>';
                $array = array("<field>" => $field,"<Field>" => ucfirst($field),"<type>" => "text","<default>" => "", "<value>" => $value,"<required>" => "required");
                $viewF = GeneratorUtil::replaceAll($array,$viewF);
                $fields .= $viewF;
            }
        }
        $viewTemplate = GeneratorUtil::replace("<fields>",$fields,$viewTemplate);
        
        GeneratorUtil::saveHTMLFile($viewTemplate,$this->viewPath.strtolower($class->name).'/','edit.phtml');
    }
    
    public function view($class)
    {
        $viewTemplate = File::copyContent($this->templatesDir."view");
        $viewTemplate = GeneratorUtil::replaceAll(array("<Class>" => ucfirst($class->name)),$viewTemplate);
        
        $fields = "";
        foreach ($class->fieldNames as $field){
            if(!Mapper::isPKSequence($class,$field)){
                $viewF = File::copyContent($this->templatesDir."detailField");
                $value = '<?php print $'.lcfirst($class->name).'->get'.ucfirst($field).'(); ?>';
                $viewF = GeneratorUtil::replaceAll(array("<Field>" => ucfirst($field),"<value>" => $value),$viewF);
                $fields .= $viewF;
            }
        }
        $viewTemplate = GeneratorUtil::replace("<fields>",$fields,$viewTemplate);
        
        GeneratorUtil::saveHTMLFile($viewTemplate,$this->viewPath.strtolower($class->name).'/','view.phtml');
    }
    
    public function listClass($class)
    {
        $viewTemplate = File::copyContent($this->templatesDir."list");
        $viewTemplate = GeneratorUtil::replaceAll(array("<Class>" => ucfirst($class->name)),$viewTemplate);
        
        $fields = $values = "";
        foreach ($class->fieldNames as $field){
            if(!Mapper::isPKSequence($class,$field)){
                $viewF  = File::copyContent($this->templatesDir."listField");
                $viewF  = GeneratorUtil::replaceAll(array("<Field>" => ucfirst($field)),$viewF);
                
                $viewV  = File::copyContent($this->templatesDir."valueList");
                $viewV  = GeneratorUtil::replaceAll(array("<value>" => '<?php print $'.lcfirst($class->name).'->get'.ucfirst($field).'(); ?>'),$viewV);
                
                $fields .= $viewF;
                $values .= $viewV;
            }
        }
        $viewTemplate = GeneratorUtil::replace("<fields>",$fields,$viewTemplate);
        $viewTemplate = GeneratorUtil::replace("<values>",$values,$viewTemplate);
        
        GeneratorUtil::saveHTMLFile($viewTemplate,$this->viewPath.strtolower($class->name).'/','list.phtml');
    }
    
    
    public function generate()
    {
        foreach ($this->project->metadata as $metadata){
            $this->add($metadata);
            $this->edit($metadata);
            $this->view($metadata);
            $this->listClass($metadata);
        }    
    }
    
}