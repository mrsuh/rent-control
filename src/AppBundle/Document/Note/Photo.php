<?php

namespace AppBundle\Document\Note;

class Photo
{
    /**
     * @ODM\Field(name="low", type="string")
     */
    private $low;

    /**
     * @ODM\Field(name="high", type="string")
     */
    private $high;

    /**
     * @return mixed
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * @return mixed
     */
    public function getHigh()
    {
        return $this->high;
    }
}