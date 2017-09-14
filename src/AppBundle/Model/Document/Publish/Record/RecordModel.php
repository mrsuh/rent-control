<?php

namespace AppBundle\Model\Document\Publish\Record;

use ODM\DocumentManager\DocumentManagerFactory;
use Schema\Publish\Record\Record;

class RecordModel
{
    private $dm;

    /**
     * PublishModel constructor.
     * @param DocumentManagerFactory $dm
     */
    public function __construct(DocumentManagerFactory $dm)
    {
        $this->dm = $dm->init(Record::class);
    }

    /**
     * @return array|Record[]
     */
    public function findAll()
    {
        return $this->dm->find([], ['sort' => ['city' => 1]]);
    }

    /**
     * @param $id
     * @return null|Record
     */
    public function findOneById($id)
    {
        return $this->dm->findOne(['_id' => $id]);
    }

    /**
     * @param Record $obj
     * @return Record
     */
    public function create(Record $obj)
    {
        $this->dm->insert($obj);

        return $obj;
    }

    /**
     * @param Record $obj
     * @return Record
     */
    public function update(Record $obj)
    {
        $this->dm->update($obj);

        return $obj;
    }
}
