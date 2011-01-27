<?php
namespace Automatic\Generator;

use \Zend\CodeGenerator\Php\PhpClass;
use \Zend\CodeGenerator\Php\PhpMethod;
use \Zend\CodeGenerator\Php\PhpParameter;
use \Zend\CodeGenerator\Php\PhpProperty;
use \Zend\CodeGenerator\Php\PhpFile;
use \Zend\Reflection\ReflectionClass;
use \Util\File;

class Model
{
    public $project;
    
    public function __construct($project)
    {
        $this->project = $project;
    }
    
    public function generate(){
        $this->generateEntities();
    	$this->generateEntityFactory();
    	$this->generateMappers();
    	$this->generateMapperFactory();
    	$this->generateBM();
    }
    
    public function generateEntities()
    {
        $newMeta = array();
        foreach ($this->project->metadata as $metadata)
        {
          $new = clone $metadata;
          $new->name = 'Entities\\'.$new->name;
          $newMeta[] = $new;  
        } 
        $generator = new \Doctrine\ORM\Tools\EntityGenerator(); 
        $generator->setGenerateAnnotations(true); 
        $generator->setGenerateStubMethods(true); 
        $generator->setRegenerateEntityIfExists(false); 
        $generator->setUpdateEntityIfExists(true);
        $generator->generate($newMeta, $this->project->path.'/application/models');
    }
    
    public function generateEntityFactory()
    {
        $class = new PhpClass();
        $class->setNamespaceName('Entities');
        $class->setName('EntityFactory');
        $parameters = array();
        
        foreach ($this->project->metadata as $metadata) 
        {
		    $name = strtolower($metadata->name);
            $method = new PhpMethod();
            $method->setName($name);
            $method->setStatic(true);
            $body = '$'.$name.' = new '.ucfirst($name).";\n";
                echo '<pre>'.$metadata->name;
                print_r($metadata->fieldMappings);
                echo '</pre>'; 
            foreach ($metadata->fieldNames as $field)
            {
                if((!$metadata->isIdentifier($field))||($metadata->isIdentifierNatural($field)))
                {
                    $param = new PhpParameter();
                    $param->setName($field);
                    if($metadata->isNullable($field)) $param->setDefaultValue(null);
                    $method->setParameter($param);
                    $body .= '$'.$name.'->set'.ucfirst($field).'($'.$field.')'.";\n";
                }
            }
            /*
             * TODO: Definir padr‹o para geracao de objetos dentro de objetos
            foreach ($metadata->getAssociationMappings() as $mapping)
            {
                $field = $mapping['fieldName'];
                //$param = new PhpParameter();
                //$param->setName($field);
                //$method->setParameter($param);
                if($pars = $parameters[$field])
                {
                    foreach ($pars as $par2) {
                        $par = clone $par2;
                        $par->setName($field.ucfirst($par->getName()));
                        $method->setParameter($par);
                    }
                }
                $body .= '$'.$name.'->set'.ucfirst($field).'($'.$field.')'.";\n";
            }
            */
            $body .= "return \$$name;\n";
            $method->setBody($body);
            $class->setMethod($method);
            $parameters[$name] = $method->getParameters();
        }
        $file = new PhpFile(); 
        $file->setClass($class);
        File::save($this->project->path.'/application/models/Entities/EntityFactory.php', $file->generate());
    }
    
    public function generateMappers()
    {
        File::copy($this->project->templatesFile.'/BaseMapper.php', $this->project->path.'/application/models/Mapper/BaseMapper.php');
        foreach ($this->project->metadata as $metadata)
        {
            $name = strtolower($metadata->name);
            $class = new PhpClass();
            $class->setNamespaceName('Mapper');
            $class->setName(ucfirst($name));
            $class->setExtendedClass('BaseMapper');
            $file = new PhpFile(); 
            $file->setClass($class);
            File::save($this->project->path.'/application/models/Mapper/'.$class->getName().'.php', $file->generate());
        }
    }
    
    public function generateMapperFactory()
    {
        $class = new PhpClass();
        $class->setNamespaceName('Mapper');
        $class->setName('MapperFactory');
        
        $method = new PhpMethod();
        $method->setName('entityManager');
        $method->setStatic(true);
        $method->setBody('return \Zend\Registry::get("entitymanager");');
        $class->setMethod($method);
        foreach ($this->project->metadata as $metadata) 
        {
		    $name = strtolower($metadata->name);
            $method = new PhpMethod();
            $method->setName($name);
            $method->setStatic(true);
            $body = 'return new '.ucfirst($name)."(self::entityManager(), self::entityManager()->getClassMetadata('".$metadata->name."'));\n";
            $method->setBody($body);
            $class->setMethod($method);
        }
        
        $file = new PhpFile(); 
        $file->setClass($class);
        File::save($this->project->path.'/application/models/Mapper/MapperFactory.php', $file->generate());  
    }
    
    public function generateBM()
    {
        foreach ($this->project->metadata as $metadata)
        {
            
            $name = strtolower($metadata->name);
            $class = new PhpClass();
            $class->setNamespaceName('BM');
            $class->setName(ucfirst($name));
            
            $property = new PhpProperty();
            $property->setName($name.'Map');
            $class->setProperty($property);
            
            $construct = new PhpMethod();
            $construct->setName('__construct');
            $construct->setBody('$this->'.$name.'Map = MapperFactory::'.$name.'();');
            $class->setMethod($construct);
            
            $entParam = new PhpParameter();
            $entParam->setName($name);
            $save = '$this->'.$name.'Map->save();';
            
            $insert = new PhpMethod();
            $insert->setParameter($entParam);
            $insert->setName('insert');
            $isBody = '$this->'.$name.'Map->insert($'.$name.");\n";
            $isBody .= $save;
            $insert->setBody($isBody);
            $class->setMethod($insert);
            
            $delete = new PhpMethod();
            $delete->setParameter($entParam);
            $delete->setName('delete');
            $dlBody = '$this->'.$name.'Map->delete($'.$name.");\n";
            $dlBody .= $save;
            $delete->setBody($dlBody);
            $class->setMethod($delete);  
            
            $update = new PhpMethod();
            $update->setParameter($entParam);
            $update->setName('update');
            $udBody = '';
            foreach ($metadata->fieldNames as $field)
            {
                $param = new PhpParameter();
                $param->setName($field);
                $update->setParameter($param);
                $udBody .= '$'.$name.'->set'.ucfirst($field).'($'.$field.')'.";\n";
            }
            
            $udBody .= '$this->'.$name.'Map->update($'.$name.");\n";
            $udBody .= $save;
            $update->setBody($udBody);
            $class->setMethod($update);
           
            $file = new PhpFile();
            #TODO: Change Zend Framework
            $file->setUse('Mapper\MapperFactory'); 
            $file->setClass($class);
            File::save($this->project->path.'/application/models/BM/'.$class->getName().'.php', $file->generate());
        }
    }
}