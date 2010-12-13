<?php

/** @namespace */
namespace BM;

class Participantrole
{

    public $participantroleMap = null;

    public function __construct()
    {
        $this->participantroleMap = MapperFactory::participantrole();
    }

    public function insert($participantrole)
    {
        $this->participantroleMap->insert($participantrole);
        $this->participantroleMap->save();
    }

    public function delete($participantrole)
    {
        $this->participantroleMap->delete($participantrole);
        $this->participantroleMap->save();
    }

    public function update($participantrole, $id, $name, $description)
    {
        $participantrole->setId($id);
        $participantrole->setName($name);
        $participantrole->setDescription($description);
        $this->participantroleMap->update($participantrole);
        $this->participantroleMap->save();
    }


}

