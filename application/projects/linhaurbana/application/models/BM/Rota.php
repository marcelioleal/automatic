<?php
namespace BM;

use Mapper\MapperFactory;

class Rota
{
    public $rotaMap;
    
    public function __construct()
    {
        $this->rotaMap = MapperFactory::Rota();
    }
    
    public function insert($rota)
    {
        $this->rotaMap->insert($rota);
        $this->rotaMap->save();
    }
    
    public function update($rota, $id, $rota)
    {
        $rota->setId = $id;\n        $rota->setRota = $rota;\n        
        
        $this->rotaMap->insert($contract);
        $this->rotaMap->save();
    }
    
    public function delete($rota)
    {
        $this->rotaMap->delete($rota);
        $this->rotaMap->save();
    }

}