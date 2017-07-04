<?php

namespace AppBundle\Model\BlackList;

use AppBundle\Document\BlackList\Phone;
use ODM\DocumentMapper\DataMapperFactory;

class PhoneModel
{
    private $dm_phone;

    /**
     * PhoneModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_phone = $dm->init(Phone::class);
    }

    /**
     * @return array|\ODM\Document\Document[]
     */
    public function findAll()
    {
        return $this->dm_phone->find();
    }

    /**
     * @param Phone $obj
     * @return Phone
     */
    public function create(Phone $obj)
    {
        $this->dm_phone->insert($obj);

        return $obj;
    }

    /**
     * @param Phone $obj
     * @return Phone
     */
    public function update(Phone $obj)
    {
        $this->dm_phone->update($obj);

        return $obj;
    }
}
