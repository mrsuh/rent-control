<?php

namespace AppBundle\Document\BlackList;

use ODM\Document\Document;

/**
 * @ODM\Collection(name="black_list_record")
 */
class Record extends Document
{
    const TYPE_PHONE = 1;
    const TYPE_PERSON = 2;
    const TYPE_DESCRIPTION = 3;

    /**
     * @ODM\Field(name="text", type="string")
     */
    private $text;

    /**
     * @ODM\Field(name="type", type="integer")
     */
    private $type;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}