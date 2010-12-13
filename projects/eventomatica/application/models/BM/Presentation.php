<?php

/** @namespace */
namespace BM;

class Presentation
{

    public $presentationMap = null;

    public function __construct()
    {
        $this->presentationMap = MapperFactory::presentation();
    }

    public function insert($presentation)
    {
        $this->presentationMap->insert($presentation);
        $this->presentationMap->save();
    }

    public function delete($presentation)
    {
        $this->presentationMap->delete($presentation);
        $this->presentationMap->save();
    }

    public function update($presentation, $id, $title, $description, $begin, $end)
    {
        $presentation->setId($id);
        $presentation->setTitle($title);
        $presentation->setDescription($description);
        $presentation->setBegin($begin);
        $presentation->setEnd($end);
        $this->presentationMap->update($presentation);
        $this->presentationMap->save();
    }


}

