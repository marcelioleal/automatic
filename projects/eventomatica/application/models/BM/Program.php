<?php

/** @namespace */
namespace BM;

class Program
{

    public $programMap = null;

    public function __construct()
    {
        $this->programMap = MapperFactory::program();
    }

    public function insert($program)
    {
        $this->programMap->insert($program);
        $this->programMap->save();
    }

    public function delete($program)
    {
        $this->programMap->delete($program);
        $this->programMap->save();
    }

    public function update($program, $id, $description)
    {
        $program->setId($id);
        $program->setDescription($description);
        $this->programMap->update($program);
        $this->programMap->save();
    }


}

