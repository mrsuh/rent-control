<?php

namespace AppBundle\Model\City;

use AppBundle\Document\City\City;
use ODM\DocumentMapper\DataMapperFactory;

class CityModel
{
    private $dm_city;

    /**
     * CityModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_city = $dm->init(City::class);
    }

    /**
     * @return array|\ODM\Document\Document[]
     */
    public function findAll()
    {
        return $this->dm_city->find();
    }

    /**
     * @param City $obj
     * @return City
     */
    public function create(City $obj)
    {
        $this->dm_city->insert($obj);

        return $obj;
    }

    /**
     * @param City $obj
     * @return City
     */
    public function update(City $obj)
    {
        $this->dm_city->update($obj);

        return $obj;
    }
}
