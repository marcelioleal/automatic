<?php
namespace Automatic\Generator;

use \Symfony\Component\Yaml\Yaml;
use \Util\File;


#TODO: This Class is responsible for 2 or more aspects
#TODO: This Class needs a refactoring now!!!
class Project
{
    public $name;
    public $basePath;
    public $path;
    public $options;
    public $templatesFile;
    public $projectsFile;
    public $structure;
    
    public $entityManager;
    public $metadata;
    
    public function __construct($options = null)
    {
        $this->basePath         = APPLICATION_PATH.'/../data/projects/';
        $this->templatesFile    = APPLICATION_PATH.'/templates';
        $this->projectsFile     = APPLICATION_PATH.'/../data/projects.yml';
        
        $this->structure = Yaml::load($this->templatesFile.'/structure.yml');
        if($options){
            $this->options = $options;
            $this->name = $options['name'];
            $this->path = $options['path'].date("hisdmY");
        }
    }

    public function setConfig(){
        $config     = new \Doctrine\ORM\Configuration();
        $cache      = new \Doctrine\Common\Cache\ApcCache;
        
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver(APPLICATION_PATH . '/models');
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(APPLICATION_PATH . '/proxies');
        $config->setProxyNamespace('Application\Proxies');

        $configModel = new \Automatic\Configuration();
        
        $options = array('dbname'     => $this->options['dbname'],
                         'user'       => $this->options['user'],
                         'password'   => $this->options['password'],
                         'host'       => $configModel->getParam("doctrine.db.host"),
                         'driver'     => $configModel->getParam("doctrine.db.driver")
                   );
        try{
            $this->entityManager = \Doctrine\ORM\EntityManager::create($options, $config);
            $this->loadMetadata();
        }catch (Exception $e){
            print $e->getMessage();
        }
    }
    
    public function loadMetadata()
    {
        $this->entityManager->getConfiguration()->setMetadataDriverImpl(
            new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
                $this->entityManager->getConnection()->getSchemaManager()
            )
        );		
        
        $cmFactory = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
        $cmFactory->setEntityManager($this->entityManager);
        try{
            $classes = $cmFactory->getAllMetadata();
            foreach ($classes as $class){
                $class->customRepositoryClassName = 'Mapper\\'.$class->name;
                $class->name = $class->name;
            }
            $this->metadata = $classes;
        }catch (Exception $e){
            print $e->getMessage();
        }
    }
    
    public static function loadProjects()
    {
        $project = new self();
        return ($data = Yaml::load($project->projectsFile))?$data:array('projects'=>array());
    }
    
    public function create($name, $dbname, $user, $password, $path='')
    {
        $this->name = $name;
        $this->path = ($path)?$path:$this->basePath.$name;
        $this->options = self::factory($name, $dbname, $user, $password, $this->path);
        $projects = self::loadProjects();
        $projects['projects'][$this->name] = $this->options; 
        File::save($this->projectsFile, Yaml::dump($projects));
    }
    
    public function generate()
    {  
      File::createTree($this->structure, $this->path);
      $this->copyFiles();
    }
    
    public function copyFiles()
    {
        File::copy(APPLICATION_PATH.'/templates/Bootstrap.php', $this->path.'/application/Bootstrap.php');
        
        //File::copy(APPLICATION_PATH.'/templates/public/index.php', $this->path.'/public/index.php');
        $fileContent = File::load(APPLICATION_PATH.'/templates/public/index.php');
        $fileContent = str_replace('<<project>>', $this->name, $fileContent);
        File::save($this->path.'/public/index.php', $fileContent);
        
        File::copy(APPLICATION_PATH.'/templates/public/.htaccess', $this->path.'/public/.htaccess');
        
        File::copy(APPLICATION_PATH.'/templates/controller/IndexController.php', $this->path.'/application/controllers/IndexController.php');
        File::copy(APPLICATION_PATH.'/templates/controller/ErrorController.php', $this->path.'/application/controllers/ErrorController.php');
        
        File::copy(APPLICATION_PATH.'/templates/mapper/BaseMapper.php', $this->path.'/application/models/Mapper/BaseMapper.php');
        
        File::copy(APPLICATION_PATH.'/templates/util/AdapterQuery.php', $this->path.'/application/models/Util/AdapterQuery.php');
        File::copy(APPLICATION_PATH.'/templates/util/Controller.php', $this->path.'/application/models/Util/Controller.php');
        File::copy(APPLICATION_PATH.'/templates/util/Enum.php', $this->path.'/application/models/Util/Enum.php');
        File::copy(APPLICATION_PATH.'/templates/util/Exception.php', $this->path.'/application/models/Util/Exception.php');
        File::copy(APPLICATION_PATH.'/templates/util/File.php', $this->path.'/application/models/Util/File.php');
        File::copy(APPLICATION_PATH.'/templates/util/Message.php', $this->path.'/application/models/Util/Message.php');
        File::copy(APPLICATION_PATH.'/templates/util/Util.php', $this->path.'/application/models/Util/Util.php');
        
        File::copy(APPLICATION_PATH.'/templates/view/default.phtml', $this->path.'/application/views/layouts/default.phtml');
        File::copy(APPLICATION_PATH.'/templates/view/error.phtml', $this->path.'/application/views/scripts/error/error.phtml');
        File::copy(APPLICATION_PATH.'/templates/view/index.phtml', $this->path.'/application/views/scripts/index/index.phtml');
        
        File::copy(APPLICATION_PATH.'/templates/images/bt_add.jpg', $this->path.'/public/images/bt_add.jpg');
        File::copy(APPLICATION_PATH.'/templates/images/bt_ed.jpg', $this->path.'/public/images/bt_ed.jpg');
        File::copy(APPLICATION_PATH.'/templates/images/bt_list.jpg', $this->path.'/public/images/bt_list.jpg');
        
    }
    
    public function configure()
    {
        $fileContent = File::load(APPLICATION_PATH.'/templates/application.ini');
        $fileContent = str_replace('%DBNAME%', $this->options['dbname'], $fileContent);
        $fileContent = str_replace('%USERNAME%', $this->options['user'], $fileContent);
        $fileContent = str_replace('%PASSWORD%', $this->options['password'], $fileContent);
        File::save($this->path.'/application/conf/application.ini', $fileContent);
    }
    
    public static function load($name)
    {
        $projects = Project::loadProjects();
        $options  = $projects['projects'][$name];
        $project  = new Project($options);
        $project->setConfig();
        return $project;
    }
    
    public static function factory($name='', $dbname='', $user='', $password='', $path='')
    {
        $options = array('name' => $name,
                         'dbname' => $dbname,
                         'user' => $user,
                         'password' => $password,
                         'path' => $path
        );
        return $options;
    }
}