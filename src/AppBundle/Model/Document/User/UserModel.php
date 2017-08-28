<?php

namespace AppBundle\Model\Document\User;

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
     * @return array|User[]
     */
    public function findAll()
    {
        return $this->dm_user->find();
    }

    /**
     * @return User|null
     */
    public function findOneByUsername(string $username)
    {
        return $this->dm_user->findOne(['username' => $username]);
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
