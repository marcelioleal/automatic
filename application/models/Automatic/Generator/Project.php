<?php
namespace Automatic\Generator;
use \Symfony\Component\Yaml\Yaml;
use \Util\File;

class Project
{
    public $name;
    public $path;
    public $options;
    public $templatesFile;
    public $projectsFile;
    public $structure;
    
    public function __construct()
    {
        $this->templatesFile = APPLICATION_PATH.'/templates';
        $this->projectsFile = APPLICATION_PATH.'/configs/projects.yml';
        $this->structure = Yaml::load(__DIR__.'/../../templates/structure.yml');
    }

    public static function loadProjects()
    {
        $project = new self();
        return ($data = Yaml::load($project->projectsFile))?$data:array('projects'=>array());
    }
    
    public function create($name, $dbname, $user, $password, $path='')
    {
        $this->name = $name;
        $this->path = ($path)?$path:APPLICATION_PATH.'/../projects/'.$name;
        $this->options = self::factory($name, $dbname, $user, $password, $this->path);
        $projects = self::loadProjects();
        $projects['projects'][$this->name] = $this->options; 
        File::save($this->projectsFile, Yaml::dump($projects));
    }
    
    public function generate()
    {
      File::createTree($this->structure, $this->path);
    }
    
    public function configure()
    {
        $fileContent = File::load(APPLICATION_PATH.'/templates/application.ini');
        $fileContent = str_replace('%DBNAME%', $this->options['dbname'], $fileContent);
        $fileContent = str_replace('%USERNAME%', $this->options['user'], $fileContent);
        $fileContent = str_replace('%PASSWORD%', $this->options['password'], $fileContent);
        File::save($this->path.'/application/configs/application.ini', $fileContent);
        File::copy(APPLICATION_PATH.'/templates/Bootstrap.php', $this->path.'/application/Bootstrap.php');
    }
    
    public static function load($name)
    {
        $project = new self();
        $projects = $project->loadProjects();
        return ($options = $projects['projects'][$name])?$options: false;
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