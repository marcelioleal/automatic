<?php

namespace Util;

use \Zend\CodeGenerator\Php\PhpClass;
use \Zend\CodeGenerator\Php\PhpMethod;
use \Zend\CodeGenerator\Php\PhpParameter;
use \Zend\CodeGenerator\Php\PhpProperty;
use \Zend\CodeGenerator\Php\PhpFile;
use \Zend\Reflection\ReflectionClass;

use \Util\File;

class GeneratorUtil{
    
    public function __construct(){
        
    }
    
    public static function createClass($name,$super=false,$namespace=false){
        $class = new PhpClass();
        $class->setName($name);
        if($super)
            $class->setExtendedClass($super);
        if($namespace)
            $class->setNamespaceName($namespace);
        return $class;
    }
    
    public static function savePHPClass($class,$path){
        $file = new PhpFile(); 
        $file->setClass($class);
            
        File::save($path, $file->generate());
    }
    
    public static function saveHTMLFile($html,$path,$file){
        File::createDir($path);
        File::save($path.$file, $html);
    }
    
    public static function replaceAll($array,$str){
        foreach ($array as $key => $value) 
            $str = self::replace($key, $value, $str);
        return $str;
    }
    
    public static function replace($i,$o,$str){
        return str_replace($i,$o,$str);
    }
    
}