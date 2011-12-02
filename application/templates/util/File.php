<?php

namespace Util;

Class File 
{
    
    static function openFile($path){
        $content = file_get_contents($path);
        return $content;
    }
    
    static function saveFile($name,$content)
    {
        $file = fopen($name, "w+");
        fwrite($file, stripslashes($content));
        fclose($file);
    }
    
    public function moveFile($from, $to)
    {
        try{
            return copy($from, $to);
        }catch(Exception $e){
            print $e->getMessage();
        }
    }
    
    public function eraseFile($fileName)
    {
        unlink($fileName);
    }
    
    public function createDirectory($dir)
    {
        if (!is_dir($dir)) 
            mkdir($dir);
    }
    
    public function rmDir($dir)
    {
        if (is_dir($dir))
            rmdir($dir);
    }
    
   
    static function getFileExt($fileName)
    {
        if(stristr($fileName,"."))
            return substr($fileName,strripos($fileName, ".")+1);
        else
            return "";
    }
    
    static function download($url,$newName)
    {
        try{
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
            file_put_contents($newName, $data);
        }catch (Exception $e){
            print $e->getMessage();
        }
    }
    
    
    static function toTXT($filePath)
    {
        $command = "pdftotext -layout ".$filePath;
        exec($command);
    }
        
}