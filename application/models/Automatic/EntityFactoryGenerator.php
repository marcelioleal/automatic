<?php
namespace Automatic;

class EntityFactoryGenerator{
	public $classes;
	public $projectDir;
	protected $_template = '<?php
namespace Entities;

class EntityFactory
{
	%METHODS%
}';
	
	protected $_methodTemplate = 'public static function %ENTITY_NAME%( %METHOD_SIGNATURE% )
	{
		%METHOD_BODY%
	}
	
	';
	
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
		
		file_put_contents($this->projectDir.'/application/models/Entities/EntityFactory.php', $content);
	}
	
	public function generateMethod($class){
		$fields = $class->fieldNames;
		$sign = '$'.implode(', $', $fields);
		$name = strtolower(substr($class->name,strpos($class->name, '\\')+1));
		$body = '$'.$name.' = new '.ucfirst($name).";\n";
		foreach ($fields as $field) {
			$body .= '		$'.$name.'->set'.ucfirst($field).'($'.$field.')'.";\n";
		}
		$body .= '		return $'.$name.";";
		
		$method = $this->_methodTemplate;
		$method = str_replace('%ENTITY_NAME%', ucfirst($name), $method);
		$method = str_replace('%METHOD_SIGNATURE%', $sign, $method);
		$method = str_replace('%METHOD_BODY%', $body, $method);
		
		return $method;
	} 
}