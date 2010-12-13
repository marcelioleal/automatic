<?php

/** @namespace */
namespace BM;

class Paper
{

    public $paperMap = null;

    public function __construct()
    {
        $this->paperMap = MapperFactory::paper();
    }

    public function insert($paper)
    {
        $this->paperMap->insert($paper);
        $this->paperMap->save();
    }

    public function delete($paper)
    {
        $this->paperMap->delete($paper);
        $this->paperMap->save();
    }

    public function update($paper, $id, $title, $description)
    {
        $paper->setId($id);
        $paper->setTitle($title);
        $paper->setDescription($description);
        $this->paperMap->update($paper);
        $this->paperMap->save();
    }


}

