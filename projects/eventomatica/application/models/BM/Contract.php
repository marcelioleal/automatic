<?php

/** @namespace */
namespace BM;

class Contract
{

    public $contractMap = null;

    public function __construct()
    {
        $this->contractMap = MapperFactory::contract();
    }

    public function insert($contract)
    {
        $this->contractMap->insert($contract);
        $this->contractMap->save();
    }

    public function delete($contract)
    {
        $this->contractMap->delete($contract);
        $this->contractMap->save();
    }

    public function update($contract, $id, $description, $value, $begin, $end, $createdat)
    {
        $contract->setId($id);
        $contract->setDescription($description);
        $contract->setValue($value);
        $contract->setBegin($begin);
        $contract->setEnd($end);
        $contract->setCreatedat($createdat);
        $this->contractMap->update($contract);
        $this->contractMap->save();
    }


}

