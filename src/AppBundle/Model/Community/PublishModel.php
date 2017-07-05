<?php

namespace AppBundle\Model\Community;

use AppBundle\Document\Community\Publish;
use ODM\DocumentMapper\DataMapperFactory;

class PublishModel
{
    private $dm_publish;

    /**
     * PublishModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_publish = $dm->init(Publish::class);
    }

    /**
     * @return array|Publish[]
     */
    public function findAll()
    {
        return $this->dm_publish->find();
    }

    /**
     * @param Publish $obj
     * @return Publish
     */
    public function create(Publish $obj)
    {
        $this->dm_publish->insert($obj);

        return $obj;
    }

    /**
     * @param Publish $obj
     * @return Publish
     */
    public function update(Publish $obj)
    {
        $this->dm_publish->update($obj);

        return $obj;
    }
}
