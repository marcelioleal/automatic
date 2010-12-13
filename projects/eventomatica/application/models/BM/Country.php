<?php

/** @namespace */
namespace BM;

class Country
{

    public $countryMap = null;

    public function __construct()
    {
        $this->countryMap = MapperFactory::country();
    }

    public function insert($country)
    {
        $this->countryMap->insert($country);
        $this->countryMap->save();
    }

    public function delete($country)
    {
        $this->countryMap->delete($country);
        $this->countryMap->save();
    }

    public function update($country, $id, $name, $sigla)
    {
        $country->setId($id);
        $country->setName($name);
        $country->setSigla($sigla);
        $this->countryMap->update($country);
        $this->countryMap->save();
    }


}

