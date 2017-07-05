<?php

namespace AppBundle\Model\Community;

use AppBundle\Document\Community\Parse;
use ODM\DocumentMapper\DataMapperFactory;

class ParseModel
{
    private $dm_parse;

    /**
     * ParseModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_parse = $dm->init(Parse::class);
    }

    /**
     * @return array|Parse[]
     */
    public function findAll()
    {
        return $this->dm_parse->find();
    }

    /**
     * @param Parse $obj
     * @return Parse
     */
    public function create(Parse $obj)
    {
        $this->dm_parse->insert($obj);

        return $obj;
    }

    /**
     * @param Parse $obj
     * @return Parse
     */
    public function update(Parse $obj)
    {
        $this->dm_parse->update($obj);

        return $obj;
    }
}
