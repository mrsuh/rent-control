<?php

namespace AppBundle\Model\User;

use AppBundle\Document\User\User;
use ODM\DocumentMapper\DataMapperFactory;

class UserModel
{
    private $dm_user;

    /**
     * UserModel constructor.
     * @param DataMapperFactory $dm
     */
    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_user = $dm->init(User::class);
    }

    /**
     * @return array|\ODM\Document\Document[]
     */
    public function findAll()
    {
        return $this->dm_user->find();
    }

    /**
     * @param User $obj
     * @return User
     */
    public function create(User $obj)
    {
        $this->dm_user->insert($obj);

        return $obj;
    }

    /**
     * @param User $obj
     * @return User
     */
    public function update(User $obj)
    {
        $this->dm_user->update($obj);

        return $obj;
    }
}
