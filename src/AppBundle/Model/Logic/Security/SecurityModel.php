<?php

namespace AppBundle\Model\Logic\Security;

use AppBundle\Document\User\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class SecurityModel
{
    private $password_encoder;
    private $security_token_storage;
    private $session;

    /**
     * SecurityModel constructor.
     * @param UserPasswordEncoder $password_encoder
     * @param TokenStorage        $security_token_storage
     * @param Session             $session
     */
    public function __construct(
        UserPasswordEncoder $password_encoder,
        TokenStorage $security_token_storage,
        Session $session
    )
    {
        $this->security_token_storage = $security_token_storage;
        $this->session              = $session;
        $this->password_encoder     = $password_encoder;
    }

    /**
     * @param User   $user
     * @param string $password
     * @return User
     */
    public function authenticate(User $user, string $password)
    {
        if (!$this->password_encoder->isPasswordValid($user, $password)) {
            throw new AuthenticationException('Username or password is invalid');
        }

        return $user;
    }

    /**
     * @param User $user
     * @return string
     */
    public function createToken(User $user)
    {
        $token = new UsernamePasswordToken($user, null, 'view_area', $user->getRoles());
        $this->security_token_storage->setToken($token);
        $this->session->set('_security_view_area', serialize($token));
        $this->session->save();

        return $this->session->getId();
    }
}
