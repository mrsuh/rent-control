<?php

namespace AppBundle\Model\Document\Publish\User;

use ODM\DocumentManager\DocumentManagerFactory;
use Schema\Publish\User\User;

class UserModel
{
    private $dm;

    /**
     * PublishModel constructor.
     * @param DocumentManagerFactory $dm
     */
    public function __construct(DocumentManagerFactory $dm)
    {
        $this->dm = $dm->init(User::class);
    }

    /**
     * @return array|User[]
     */
    public function findAll()
    {
        return $this->dm->find();
    }

    /**
     * @param $id
     * @return null|User
     */
    public function findOneById($id)
    {
        return $this->dm->findOne(['_id' => $id]);
    }

    /**
     * @param User $obj
     * @return User
     */
    public function create(User $obj)
    {
        $this->dm->insert($obj);

        return $obj;
    }

    /**
     * @param User $obj
     * @return User
     */
    public function update(User $obj)
    {
        $this->dm->update($obj);

        return $obj;
    }
}
