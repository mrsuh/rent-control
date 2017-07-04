<?php

namespace AppBundle\Model\BlackList;

use AppBundle\Document\BlackList\Description;
use ODM\DocumentMapper\DataMapperFactory;

class DescriptionModel
{
    private $dm_description;

    /**
     * DescriptionModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_description = $dm->init(Description::class);
    }

    /**
     * @return array|\ODM\Document\Document[]
     */
    public function findAll()
    {
        return $this->dm_description->find();
    }

    /**
     * @param Description $obj
     * @return Description
     */
    public function create(Description $obj)
    {
        $this->dm_description->insert($obj);

        return $obj;
    }

    /**
     * @param Description $obj
     * @return Description
     */
    public function update(Description $obj)
    {
        $this->dm_description->update($obj);

        return $obj;
    }
}
