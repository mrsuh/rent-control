<?php

namespace AppBundle\Command;

use AppBundle\Document\User\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:user');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dm_user = $this->getContainer()->get('dm.control')->init(User::class);

        $user =
            (new User())
                ->setUsername('admin')
                ->setRoles(['ROLE_ADMIN'])
                ->setSalt('salt');

        $encoder = $this->getContainer()->get('security.password_encoder');

        $pass = $encoder->encodePassword($user, 'password');

        $user->setPassword($pass);
        $dm_user->insert($user);
    }
}
