<?php

namespace AppBundle\Command;

use AppBundle\Document\User\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:user')
            ->addOption(
                'username',
                'u',
                InputOption::VALUE_OPTIONAL
            )
            ->addOption(
                'password',
                'p',
                InputOption::VALUE_OPTIONAL
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getOption('username');
        $password = $input->getOption('password');
        $dm_user  = $this->getContainer()->get('dm.control')->init(User::class);

        $exists = $dm_user->findOne(['username' => $username]);

        if (null === $exists) {
            $user =
                (new User())
                    ->setUsername($username)
                    ->setRoles(['ROLE_ADMIN'])
                    ->setSalt(md5(time()));
        } else {
            $user = $exists;
        }

        $encoder = $this->getContainer()->get('security.password_encoder');

        $pass = $encoder->encodePassword($user, $password);

        $user->setPassword($pass);

        if (null === $exists) {
            $dm_user->insert($user);
        } else {
            $dm_user->update($user);
        }
    }
}
