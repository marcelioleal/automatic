<?php

/** @namespace */
namespace BM;

class Province
{

    public $provinceMap = null;

    public function __construct()
    {
        $this->provinceMap = MapperFactory::province();
    }

    public function insert($province)
    {
        $this->provinceMap->insert($province);
        $this->provinceMap->save();
    }

    public function delete($province)
    {
        $this->provinceMap->delete($province);
        $this->provinceMap->save();
    }

    public function update($province, $id, $name, $sigla)
    {
        $province->setId($id);
        $province->setName($name);
        $province->setSigla($sigla);
        $this->provinceMap->update($province);
        $this->provinceMap->save();
    }


}

