<?php

namespace AppBundle\Console\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Form\Type\ChangeEmailType;
use AppBundle\Model\UserRepository;
use Monolog\Logger;

class ChangeEmailCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
        ->setName('change:password')
        ->setDescription('Change password')
        ->addArgument(
            'oldEmail',
            InputArgument::REQUIRED,
            'Old email'
        )
        ->addArgument(
            'newEmail',
            InputArgument::REQUIRED,
            'New email'
        )
        ->addArgument(
            'repeatEmail',
            InputArgument::REQUIRED,
            'Repeat email'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get arguments
        $oldEmail = $input->getArgument('oldEmail');
        $newEmail = $input->getArgument('newEmail');
        $repeatEmail = $input->getArgument('repeatEmail');

        // if emails match
        if($newEmail == $repeatEmail)
        {
            $repository = new UserRepository();

            // get user
            $user = $repository->getUserByEmail($oldEmail);

            if($user)
            {
                $this->getContainer()->get('UserService')->changeEmail($user, $user->getEmail(), $oldEmail);
                $text = 'The email has changed';
            }
            else
            {
                $text = 'User with the given email was not found';
            }
        }
        else
        {
            $text = 'Emails dont match';
        }

        $output->writeln($text);
    }

} // End ChangeEmailCommand
