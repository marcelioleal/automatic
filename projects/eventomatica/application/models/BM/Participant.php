<?php

/** @namespace */
namespace BM;

class Participant
{

    public $participantMap = null;

    public function __construct()
    {
        $this->participantMap = MapperFactory::participant();
    }

    public function insert($participant)
    {
        $this->participantMap->insert($participant);
        $this->participantMap->save();
    }

    public function delete($participant)
    {
        $this->participantMap->delete($participant);
        $this->participantMap->save();
    }

    public function update($participant, $id, $eventid)
    {
        $participant->setId($id);
        $participant->setEventid($eventid);
        $this->participantMap->update($participant);
        $this->participantMap->save();
    }


}

