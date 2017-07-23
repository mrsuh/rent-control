<?php

namespace AppBundle\Document\Note;

use ODM\Document\Document;

/**
 * @ODM\Collection(name="note")
 */
class Note extends Document
{
    const ROOM   = 0;
    const FLAT_1 = 1;
    const FLAT_2 = 2;
    const FLAT_3 = 3;
    const FLAT_N = 4;
    const STUDIO = 5;
    const ERR    = 6;

    /**
     * @ODM\Field(name="external_id", type="string")
     */
    private $external_id;

    /**
     * @ODM\Field(name="city", type="integer")
     */
    private $city;

    /**
     * @ODM\Field(name="type", type="integer")
     */
    private $type;

    /**
     * @ODM\Field(name="photos", type="AppBundle\Document\Note\Photo[]")
     */
    private $photos;

    /**
     * @ODM\Field(name="price", type="float")
     */
    private $price;

    /**
     * @ODM\Field(name="area", type="float")
     */
    private $area;

    /**
     * @ODM\Field(name="contact", type="AppBundle\Document\Note\Contact")
     */
    private $contact;

    /**
     * @ODM\Field(name="timestamp", type="integer")
     */
    private $timestamp;

    /**
     * @ODM\Field(name="subways", type="array")
     */
    private $subways;

    /**
     * @ODM\Field(name="description", type="string")
     */
    private $description;

    /**
     * @ODM\Field(name="published", type="integer")
     */
    private $published;

    /**
     * @ODM\Field(name="published_timestamp", type="integer")
     */
    private $published_timestamp;

    /**
     * Note constructor.
     */
    public function __construct()
    {
        $this->subways   = [];
        $this->published = false;
    }

    public function initId()
    {
        $this->id = Date('U') . $this->external_id;
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
     * @return \AppBundle\Document\Note\Photo[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param Photo $photo
     * @return $this
     */
    public function addPhoto(Photo $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param $area
     * @return $this
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return array
     */
    public function getSubways(): array
    {
        return $this->subways;
    }

    /**
     * @param array $subways
     * @return $this
     */
    public function setSubways(array $subways)
    {
        $this->subways = $subways;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description      = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * @param $external_id
     * @return $this
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;

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
     * @return bool
     */
    public function getPublished(): bool
    {
        return (bool)$this->published;
    }

    /**
     * @param bool $published
     * @return $this
     */
    public function setPublished(bool $published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return $this
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPublishedTimestamp()
    {
        return $this->published_timestamp;
    }

    /**
     * @param $published_timestamp
     * @return $this
     */
    public function setPublishedTimestamp($published_timestamp)
    {
        $this->published_timestamp = $published_timestamp;

        return $this;
    }
}