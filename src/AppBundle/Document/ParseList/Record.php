<?php

namespace AppBundle\Document\ParseList;

use ODM\Document\Document;

/**
 * @ODM\Collection(name="parse_list_record")
 */
class Record extends Document
{
    /**
     * @ODM\Field(name="name", type="string")
     */
    private $name;

    /**
     * @ODM\Field(name="city", type="string")
     */
    private $city;

    /**
     * @ODM\Field(name="link", type="string")
     */
    private $link;

    /**
     * @ODM\Field(name="sources", type="AppBundle\Document\ParseList\Source[]")
     */
    private $sources;

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
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param $link
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @param Source $source
     * @return $this
     */
    public function addSource(Source $source)
    {
        $this->sources[] = $source;

        return $this;
    }

    /**
     * @param $id
     * @return null|Source
     */
    public function findSourceById($id)
    {
        foreach($this->sources as $source) {
            if($source->getId() === $id) {
                return $source;
            }
        }

        return null;
    }
}