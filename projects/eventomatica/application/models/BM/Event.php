<?php

/** @namespace */
namespace BM;

class Event
{

    public $eventMap = null;

    public function __construct()
    {
        $this->eventMap = MapperFactory::event();
    }

    public function insert($event)
    {
        $this->eventMap->insert($event);
        $this->eventMap->save();
    }

    public function delete($event)
    {
        $this->eventMap->delete($event);
        $this->eventMap->save();
    }

    public function update($event, $id, $createdat, $type)
    {
        $event->setId($id);
        $event->setCreatedat($createdat);
        $event->setType($type);
        $this->eventMap->update($event);
        $this->eventMap->save();
    }


}

