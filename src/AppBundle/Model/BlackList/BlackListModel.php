<?php

namespace AppBundle\Model\BlackList;

use AppBundle\Document\BlackList\Record;
use ODM\DocumentManager\DocumentManagerFactory;

class BlackListModel
{
    /**
     * @var \ODM\DocumentManager\DocumentManager
     */
    protected $dm_black_list;

    /**
     * DescriptionModel constructor.
     * @param DocumentManagerFactory $dm
     */
    public function __construct(DocumentManagerFactory $dm)
    {
        $this->dm_black_list = $dm->init(Record::class);
    }

    /**
     * @param Record $obj
     * @return Record
     */
    public function create(Record $obj)
    {
        $this->dm_black_list->insert($obj);

        return $obj;
    }

    /**
     * @param Record $obj
     * @return Record
     */
    public function update(Record $obj)
    {
        $this->dm_black_list->update($obj);

        return $obj;
    }
}
