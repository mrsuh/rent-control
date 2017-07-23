<?php

namespace AppBundle\Document\City;

use ODM\Document\Document;

/**
 * @ODM\Collection(name="city")
 */
class City extends Document
{
    /**
     * @ODM\Field(name="name", type="string")
     */
    private $name;

    /**
     * @ODM\Field(name="short_name", type="string")
     */
    private $short_name;

    /**
     * @ODM\Field(name="picture_link", type="string")
     */
    private $picture_link;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureLink()
    {
        return $this->picture_link;
    }

    /**
     * @param $picture_link
     * @return $this
     */
    public function setPictureLink($picture_link)
    {
        $this->picture_link = $picture_link;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * @param $short_name
     * @return $this
     */
    public function setShortName($short_name)
    {
        $this->short_name = $short_name;

        return $this;
    }
}