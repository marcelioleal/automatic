<?php
namespace Util;

class File
{

    public static function createDir($path)
    {
         if(!self::exists($path)) mkdir($path, 0777, true);
    }
    
    public static function save($name, $content)
    {
        file_put_contents($name, $content);
    }
    
    public static function createTree($tree, $root)
    {
        foreach (array_keys($tree) as $dir)
        {
            self::createDir($root.'/'.$dir);
            if(is_array($tree[$dir]))
                self::createTree($tree[$dir], $root.'/'.$dir);
        }
    }
    
    public static function exists($filename)
    {
        return file_exists($filename);
    }
    
    public static function load($filename)
    {
        return file_get_contents($filename);
    }
    
    public static function copy($filename, $destination)
    {
        copy($filename, $destination);
    }
    
    public static function copyContent($templateName){
        return file_get_contents(__DIR__."/../../templates/".$templateName.".tem");
    } 
}