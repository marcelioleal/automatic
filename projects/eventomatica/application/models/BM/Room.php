<?php

/** @namespace */
namespace BM;

class Room
{

    public $roomMap = null;

    public function __construct()
    {
        $this->roomMap = MapperFactory::room();
    }

    public function insert($room)
    {
        $this->roomMap->insert($room);
        $this->roomMap->save();
    }

    public function delete($room)
    {
        $this->roomMap->delete($room);
        $this->roomMap->save();
    }

    public function update($room, $id, $description, $type)
    {
        $room->setId($id);
        $room->setDescription($description);
        $room->setType($type);
        $this->roomMap->update($room);
        $this->roomMap->save();
    }


}

