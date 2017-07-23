<?php

namespace AppBundle\Document\User;

use ODM\Document\Document;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ODM\Collection(name="user")
 */
class User extends Document implements UserInterface
{
    /**
     * @ODM\Field(name="username", type="string")
     */
    private $username;

    /**
     * @ODM\Field(name="password", type="string")
     */
    private $password;

    /**
     * @ODM\Field(name="salt", type="string")
     */
    private $salt;

    /**
     * @ODM\Field(name="roles", type="string[]")
     */
    private $roles;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->roles = [];
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return (array)$this->roles;
    }

    /**
     * @param $roles
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return bool
     */
    public function eraseCredentials()
    {
        return false;
    }
}