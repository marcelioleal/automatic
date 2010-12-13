<?php
namespace Automatic;
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
    public $entityManager;
    public $metadata;
    
    public function __construct($project)
    {
        $this->project = $project;
        
        $config = new \Doctrine\ORM\Configuration();
        $cache = new \Doctrine\Common\Cache\ApcCache;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(APPLICATION_PATH . '/models');
        $config->setMetadataDriverImpl($driverImpl);

        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(APPLICATION_PATH . '/proxies');
        $config->setProxyNamespace('Application\Proxies');

        $options = array('dbname' => $this->project->options['dbname'],
                         'user' => $this->project->options['user'],
                         'password' => $this->project->options['password'],
                         'host' => '127.0.0.1',
                         'driver' => 'pdo_mysql');

        $this->entityManager = \Doctrine\ORM\EntityManager::create($options, $config);
        $this->loadMetadata();
    }
    
    public function loadMetadata()
    {
        $this->entityManager->getConfiguration()->setMetadataDriverImpl(
            new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
                $this->entityManager->getConnection()->getSchemaManager()
            )
        );		
        $cmFactory = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory($this->entityManager);
        
        $classes = $cmFactory->getAllMetadata();
        foreach ($classes as $class)
        {
            $class->customRepositoryClassName = 'Mapper\\'.$class->name;
            $class->name = 'Entities\\'.$class->name;
            $class->rootEntityName = $class->name;
        }
        
        $this->metadata = $classes;
    }
    
    public function generateEntities()
    {
        $generator = new \Doctrine\ORM\Tools\EntityGenerator(); 
        $generator->setGenerateAnnotations(true); 
        $generator->setGenerateStubMethods(true); 
        $generator->setRegenerateEntityIfExists(false); 
        $generator->setUpdateEntityIfExists(true);
        $generator->generate($this->metadata, $this->project->path.'/application/models');
    }
    
    public function generateEntityFactory()
    {
        $class = new PhpClass();
        $class->setNamespaceName('Entities');
        $class->setName('EntityFactory');
        
        foreach ($this->metadata as $metadata) 
        {
		    $name = strtolower(substr($metadata->name,strpos($metadata->name, '\\')+1));
            $method = new PhpMethod();
            $method->setName($name);
            $method->setStatic(true);
            $body = '$'.$name.' = new '.ucfirst($name).";\n"; 
            foreach ($metadata->fieldNames as $field)
            {
                $param = new PhpParameter();
                $param->setName($field);
                $method->setParameter($param);
                $body .= '$'.$name.'->set'.ucfirst($field).'($'.$field.')'.";\n";
            }
            $body .= "return \$$name;\n";
            $method->setBody($body);
            $class->setMethod($method);
        }
        $file = new PhpFile(); 
        $file->setClass($class);
        File::save($this->project->path.'/application/models/Entities/EntityFactory.php', $file->generate());
    }
    
    public function generateMappers()
    {
        File::copy($this->project->templatesFile.'/BaseMapper.php', $this->project->path.'/application/models/Mapper/BaseMapper.php');
        foreach ($this->metadata as $metadata)
        {
            $name = strtolower(substr($metadata->name,strpos($metadata->name, '\\')+1));
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
        foreach ($this->metadata as $metadata) 
        {
		    $name = strtolower(substr($metadata->name,strpos($metadata->name, '\\')+1));
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
        foreach ($this->metadata as $metadata)
        {
            
            $name = strtolower(substr($metadata->name,strpos($metadata->name, '\\')+1));
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
            $file->setUse('Mapper\MapperFactory'); 
            $file->setClass($class);
            File::save($this->project->path.'/application/models/BM/'.$class->getName().'.php', $file->generate());
        }
    }
}