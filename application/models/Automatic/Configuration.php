<?php
namespace Automatic;

class Configuration{
    
    private $_pathConfig;
    private $_generalConfigName;
    private $_generalConfig;
    
    function __construct(){
        $this->_pathConfig = APPLICATION_PATH.'/configs/';
        $this->_generalConfigName = "application.ini";
        $this->setGeneralConfiguration();
    }
    
    public function setGeneralConfiguration(){
        $this->_generalConfig = new \Zend\Config\Ini($this->_pathConfig.$this->_generalConfigName,null,array('skipExtends'=> true,"allowModifications"=>true));
    }
    
    public function getParam($param){
        try{
            eval(str_replace(".","->",'$value = $this->_generalConfig->'.APPLICATION_ENV.'->'.$param).";");
            if(!$value)
                eval(str_replace(".","->",'$value = $this->_generalConfig->production->'.$param).';');
            return $value;
        }catch (Exception $e){
            print $e->getMessage();
        }
    }
    
    public function setParam($param,$value){
        try{
            eval(str_replace(".","->",'$this->_generalConfig->'.APPLICATION_ENV.'->'.$param).' = $value;');
            if(!$value)
                eval(str_replace(".","->",'$this->_generalConfig->production->'.$param).'= $value;');
        }catch (Exception $e){
            print $e->getMessage();
        }
    }
    
    public function write(){
        $configWriter = new \Zend\Config\Writer\Ini();
        $configWriter->write($this->_pathConfig.$this->_generalConfigName,$this->_generalConfig);
    }
    
}