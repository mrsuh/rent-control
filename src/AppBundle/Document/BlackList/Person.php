<?php

namespace AppBundle\Document\BlackList;

use ODM\Document\Document;

class Person extends Document
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}