<?php

namespace AppBundle\Document\ParseList;

class Source
{
    const TYPE_VK_COMMENT = 'vk.com:comment';
    const TYPE_VK_WALL    = 'vk.com:wall';

    /**
     * @ODM\Field(name="id", type="string")
     */
    private $id;

    /**
     * @ODM\Field(name="type", type="string")
     */
    private $type;

    /**
     * @ODM\Field(name="link", type="string")
     */
    private $link;

    /**
     * @ODM\Field(name="parameters", type="string")
     */
    private $parameters;

    /**
     * Source constructor.
     */
    public function __construct()
    {
        $this->id = uniqid();
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
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param $parameters
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }
}