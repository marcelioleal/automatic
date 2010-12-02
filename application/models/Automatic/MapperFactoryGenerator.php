<?php
namespace Automatic;

class MapperFactoryGenerator{
	public $classes;
	public $projectDir;
	protected $_template = '<?php
namespace Mapper;

class MapperFactory
{
	public static function EntityManager()
	{
		return \Zend\Registry::get("entitymanager");
	}
	
	%METHODS%	
}';
	
	protected $_methodTemplate = "public static function %ENTITY_NAME%()
	{
		return new %ENTITY_NAME%(self::EntityManager(), self::EntityManager()->getClassMetadata('%FULL_ENTITY_NAME%'));
	}
	
	";
	
	public function __construct($classes, $projectDir){
		$this->classes = $classes;
		$this->projectDir = $projectDir;
	}
	
	public function generate(){
		$content = $this->_template;
		$methods = '';
		foreach ($this->classes as $class) {
			$methods .= $this->generateMethod($class);
		}
		$content = str_replace('%METHODS%', $methods, $content);
		
		file_put_contents($this->projectDir.'/application/models/Mapper/MapperFactory.php', $content);
	}
	
	public function generateMethod($class){
		$fullName = $class->name;
		$name = substr($class->name,strpos($class->name, '\\')+1);
		
		$method = $this->_methodTemplate;
		$method = str_replace('%ENTITY_NAME%', $name, $method);
		$method = str_replace('%FULL_ENTITY_NAME%', $fullName, $method);
		
		return $method;
	} 
}