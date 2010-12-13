<?php
namespace Automatic;
use \Symfony\Component\Yaml\Yaml;
use \Util\File;

class Project
{
    public $name;
    public $path;
    public $options;
    public $projectsFile;
    public $templatesFile;
    public $structure;
    
    public function __construct($name, $options)
    {
        $this->name = $name;
        $this->options = $options;
        $this->path = __DIR__.'/../../projects/'.$name;
        $this->templatesFile = APPLICATION_PATH.'/templates';
        $this->projectsFile = APPLICATION_PATH.'/configs/projects.yml';
        $this->structure = Yaml::load(__DIR__.'/../../templates/structure.yml');
    }

    public function loadProjects()
    {
        return ($data = Yaml::load($this->projectsFile))?$data:array();
    }
    
    public function create()
    {
        $projects = $this->loadProjects();
        $projects['projects'][$this->name] = array('name'=>$this->name,
                                             	   'path'=>$this->path,
                                                   'dbname'=>$this->options['dbname'],
                                                   'user'=>$this->options['user'],
                                                   'password'=>$this->options['password']); 
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
}