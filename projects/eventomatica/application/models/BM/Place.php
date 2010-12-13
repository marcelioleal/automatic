<?php

/** @namespace */
namespace BM;

class Place
{

    public $placeMap = null;

    public function __construct()
    {
        $this->placeMap = MapperFactory::place();
    }

    public function insert($place)
    {
        $this->placeMap->insert($place);
        $this->placeMap->save();
    }

    public function delete($place)
    {
        $this->placeMap->delete($place);
        $this->placeMap->save();
    }

    public function update($place, $id, $description, $type)
    {
        $place->setId($id);
        $place->setDescription($description);
        $place->setType($type);
        $this->placeMap->update($place);
        $this->placeMap->save();
    }


}

