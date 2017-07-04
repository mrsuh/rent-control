<?php

namespace AppBundle\Security;

use AppBundle\Document\User\User;
use ODM\DocumentMapper\DataMapperFactory;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    private $dm_user;

    public function __construct(DataMapperFactory $dm)
    {
        $this->dm_user = $dm->init(User::class);
    }

    public function loadUserByUsername($username)
    {
        $user = $this->dm_user->findOne(['username' => $username]);

        if(null === $user) {
            throw new UsernameNotFoundException();
        }

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}