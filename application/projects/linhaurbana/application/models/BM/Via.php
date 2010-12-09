<?php
namespace BM;

use Mapper\MapperFactory;

class Via
{
    public $viaMap;
    
    public function __construct()
    {
        $this->viaMap = MapperFactory::Via();
    }
    
    public function insert($via)
    {
        $this->viaMap->insert($via);
        $this->viaMap->save();
    }
    
    public function update($via, $id, $nome)
    {
        $via->setId = $id;\n        $via->setNome = $nome;\n        
        
        $this->viaMap->insert($contract);
        $this->viaMap->save();
    }
    
    public function delete($via)
    {
        $this->viaMap->delete($via);
        $this->viaMap->save();
    }

}