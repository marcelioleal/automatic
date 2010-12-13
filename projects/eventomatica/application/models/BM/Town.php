<?php

/** @namespace */
namespace BM;

class Town
{

    public $townMap = null;

    public function __construct()
    {
        $this->townMap = MapperFactory::town();
    }

    public function insert($town)
    {
        $this->townMap->insert($town);
        $this->townMap->save();
    }

    public function delete($town)
    {
        $this->townMap->delete($town);
        $this->townMap->save();
    }

    public function update($town, $id, $name)
    {
        $town->setId($id);
        $town->setName($name);
        $this->townMap->update($town);
        $this->townMap->save();
    }


}

