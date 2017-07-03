<?php

namespace AppBundle\Document\BlackList;

use ODM\Document\Document;

class Person extends Document
{
    private $id;

    private $name;

    private $designation;

    private $photo;

    private $noteExpireDays;

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
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param $designation
     * @return $this
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param $photo
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNoteExpireDays()
    {
        return $this->noteExpireDays;
    }

    /**
     * @param $noteExpireDays
     * @return $this
     */
    public function setNoteExpireDays($noteExpireDays)
    {
        $this->noteExpireDays = $noteExpireDays;

        return $this;
    }
}