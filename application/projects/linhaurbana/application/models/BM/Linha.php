<?php
namespace BM;

use Mapper\MapperFactory;

class Linha
{
    public $linhaMap;
    
    public function __construct()
    {
        $this->linhaMap = MapperFactory::Linha();
    }
    
    public function insert($linha)
    {
        $this->linhaMap->insert($linha);
        $this->linhaMap->save();
    }
    
    public function update($linha, $id, $nome, $idSetran, $codSetran)
    {
        $linha->setId = $id;\n        $linha->setNome = $nome;\n        $linha->setIdSetran = $idSetran;\n        $linha->setCodSetran = $codSetran;\n        
        
        $this->linhaMap->insert($contract);
        $this->linhaMap->save();
    }
    
    public function delete($linha)
    {
        $this->linhaMap->delete($linha);
        $this->linhaMap->save();
    }

}