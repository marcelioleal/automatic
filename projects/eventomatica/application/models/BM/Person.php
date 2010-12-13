<?php

/** @namespace */
namespace BM;

class Person
{

    public $personMap = null;

    public function __construct()
    {
        $this->personMap = MapperFactory::person();
    }

    public function insert($person)
    {
        $this->personMap->insert($person);
        $this->personMap->save();
    }

    public function delete($person)
    {
        $this->personMap->delete($person);
        $this->personMap->save();
    }

    public function update($person, $id, $type, $createdat, $status)
    {
        $person->setId($id);
        $person->setType($type);
        $person->setCreatedat($createdat);
        $person->setStatus($status);
        $this->personMap->update($person);
        $this->personMap->save();
    }


}

