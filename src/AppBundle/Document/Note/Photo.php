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
     * @param $low
     * @return $this
     */
    public function setLow($low)
    {
        $this->low = $low;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * @param $high
     * @return $this
     */
    public function setHigh($high)
    {
        $this->high = $high;

        return $this;
    }
}