<?php

/** @namespace */
namespace BM;

class Movement
{

    public $movementMap = null;

    public function __construct()
    {
        $this->movementMap = MapperFactory::movement();
    }

    public function insert($movement)
    {
        $this->movementMap->insert($movement);
        $this->movementMap->save();
    }

    public function delete($movement)
    {
        $this->movementMap->delete($movement);
        $this->movementMap->save();
    }

    public function update($movement, $id, $value, $type, $payday, $status)
    {
        $movement->setId($id);
        $movement->setValue($value);
        $movement->setType($type);
        $movement->setPayday($payday);
        $movement->setStatus($status);
        $this->movementMap->update($movement);
        $this->movementMap->save();
    }


}

