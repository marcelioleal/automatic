<?php

/** @namespace */
namespace BM;

class Customer
{

    public $customerMap = null;

    public function __construct()
    {
        $this->customerMap = MapperFactory::customer();
    }

    public function insert($customer)
    {
        $this->customerMap->insert($customer);
        $this->customerMap->save();
    }

    public function delete($customer)
    {
        $this->customerMap->delete($customer);
        $this->customerMap->save();
    }

    public function update($customer, $id, $status, $begin, $end)
    {
        $customer->setId($id);
        $customer->setStatus($status);
        $customer->setBegin($begin);
        $customer->setEnd($end);
        $this->customerMap->update($customer);
        $this->customerMap->save();
    }


}

