<?php

namespace AppBundle\Document\Community;

use ODM\Document\Document;

class CommunityParse extends Document
{
    private $id;

    private $name;

    private $city;

    private $links;

    public function __construct()
    {
        $this->links = [];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param $links
     * @return $this
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }
}