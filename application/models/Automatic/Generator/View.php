<?php

namespace Automatic\Generator;

use \Util\GeneratorUtil;
use \Util\File;


class View implements Generator
{
    
    public $project;
    public $templatesDir;
    
    function __construct($project)
    {
        $this->project = $project;
        $this->templatesDir = "view/";
    }
    
    public function add($class)
    {
        $viewTemplate = File::copyContent($this->templatesDir."add");
        $viewTemplate = GeneratorUtil::replace("<class>",$class->name,$viewTemplate);
        $viewTemplate = GeneratorUtil::replace("<Class>",ucfirst($class->name),$viewTemplate);
        
        $fields = "";
        foreach ($class->fieldNames as $field){
            $viewF = File::copyContent($this->templatesDir."input");
            $viewF = GeneratorUtil::replace("<field>",$field,$viewF);
            $viewF = GeneratorUtil::replace("<Field>",ucfirst($field),$viewF);
            $viewF = GeneratorUtil::replace("<type>","text",$viewF);
            $viewF = GeneratorUtil::replace("<default>","",$viewF);
            $viewF = GeneratorUtil::replace("<value>","",$viewF);
            $viewF = GeneratorUtil::replace("<required>","required",$viewF);
            $fields .= $viewF;
        }
        $viewTemplate = GeneratorUtil::replace("<fields>",$fields,$viewTemplate);
        
        GeneratorUtil::saveHTMLFile($viewTemplate,$this->project->path.'/application/views/'.strtolower($class->name).'/','add.phtml');
    }
    
    
    public function generate()
    {
        foreach ($this->project->metadata as $metadata){
            $this->add($metadata);
        }    
    }
    
}