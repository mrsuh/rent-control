<?php

namespace AppBundle\Model\BlackList;

use AppBundle\Document\BlackList\Record;

class DescriptionModel extends BlackListModel
{
    /**
     * @return null|Record
     */
    public function findOneById($id)
    {
        return $this->dm_black_list->findOne(['_id' => $id,'type' => Record::TYPE_DESCRIPTION]);
    }

    /**
     * @return array|Record[]
     */
    public function findAll()
    {
        return $this->dm_black_list->find(['type' => Record::TYPE_DESCRIPTION]);
    }
}
