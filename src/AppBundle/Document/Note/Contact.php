<?php

namespace AppBundle\Document\Note;

class Contact
{
    /**
     * @ODM\Field(name="name", type="string")
     */
    private $name;

    /**
     * @ODM\Field(name="photo_link", type="string")
     */
    private $photo_link;

    /**
     * @ODM\Field(name="link", type="string")
     */
    private $link;

    /**
     * @ODM\Field(name="phones", type="string[]")
     */
    private $phones;

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
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param $phones
     * @return $this
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotoLink()
    {
        return $this->photo_link;
    }

    /**
     * @param $photo_link
     * @return $this
     */
    public function setPhotoLink($photo_link)
    {
        $this->photo_link = $photo_link;

        return $this;
    }
}