<?php
namespace Automatic;

class BMGenerator
{
    public $classes;
    public $path;
    
    public $template = '<?php
namespace BM;

use Mapper\MapperFactory;

class %ENTITY_NAME%
{
    public $%LOW_ENTITY_NAME%Map;
    
    public function __construct()
    {
        $this->%LOW_ENTITY_NAME%Map = MapperFactory::%ENTITY_NAME%();
    }
    
    public function insert($%LOW_ENTITY_NAME%)
    {
        $this->%LOW_ENTITY_NAME%Map->insert($%LOW_ENTITY_NAME%);
        $this->%LOW_ENTITY_NAME%Map->save();
    }
    
    public function update($%LOW_ENTITY_NAME%, %METHOD_ASSIGN%)
    {
        %METHOD_BODY%
        
        $this->%LOW_ENTITY_NAME%Map->insert($contract);
        $this->%LOW_ENTITY_NAME%Map->save();
    }
    
    public function delete($%LOW_ENTITY_NAME%)
    {
        $this->%LOW_ENTITY_NAME%Map->delete($%LOW_ENTITY_NAME%);
        $this->%LOW_ENTITY_NAME%Map->save();
    }

}';
    
    public function __construct($classes, $path)
    {
        $this->classes = $classes;
        $this->path = $path;
    }
    
    public function generate()
    {
        foreach ($this->classes as $class)
        {
            $name = substr($class->name, strpos($class->name, '\\')+1);
            $lowName = strtolower($name);
            $data = $this->template;
            $assign = '$'.implode(', $', $class->fieldNames);
            $methodBody = '';
            foreach ($class->fieldNames as $field)
                $methodBody .= '$'.$lowName.'->set'.ucfirst($field).'($'.$field.");\n        ";
            
            
            $data = str_replace('%ENTITY_NAME%', $name, $data);
            $data = str_replace('%LOW_ENTITY_NAME%', $lowName, $data);
            $data = str_replace('%METHOD_ASSIGN%', $assign, $data);
            $data = str_replace('%METHOD_BODY%', $methodBody, $data);
            
            $this->save($this->path.$name.'.php', $data);
        }
    }
    
    public function save($filename, $data)
    {
        file_put_contents($filename, $data);
    }
}