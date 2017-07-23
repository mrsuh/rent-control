<?php

namespace AppBundle\Model\User;

use AppBundle\Document\User\User;
use ODM\DocumentManager\DocumentManagerFactory;

class UserModel
{
    private $dm_user;

    /**
     * UserModel constructor.
     * @param DocumentManagerFactory $dm
     */
    public function __construct(DocumentManagerFactory $dm)
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
