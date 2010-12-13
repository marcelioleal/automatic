<?php

/** @namespace */
namespace BM;

class Address
{

    public $addressMap = null;

    public function __construct()
    {
        $this->addressMap = MapperFactory::address();
    }

    public function insert($address)
    {
        $this->addressMap->insert($address);
        $this->addressMap->save();
    }

    public function delete($address)
    {
        $this->addressMap->delete($address);
        $this->addressMap->save();
    }

    public function update($address, $id, $street, $complement, $number, $postalcode)
    {
        $address->setId($id);
        $address->setStreet($street);
        $address->setComplement($complement);
        $address->setNumber($number);
        $address->setPostalcode($postalcode);
        $this->addressMap->update($address);
        $this->addressMap->save();
    }


}

