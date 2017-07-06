<?php

namespace AppBundle\Model\BlackList;

use AppBundle\Document\BlackList\Person;
use ODM\DocumentMapper\DataMapperFactory;

class PersonModel
{
    private $dm_person;

    /**
     * PersonModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_person = $dm->init(Person::class);
    }

    /**
     * @return array|Person[]
     */
    public function findAll()
    {
        return $this->dm_person->find();
    }

    /**
     * @param Person $obj
     * @return Person
     */
    public function create(Person $obj)
    {
        $this->dm_person->insert($obj);

        return $obj;
    }

    /**
     * @param Person $obj
     * @return Person
     */
    public function update(Person $obj)
    {
        $this->dm_person->update($obj);

        return $obj;
    }
}
