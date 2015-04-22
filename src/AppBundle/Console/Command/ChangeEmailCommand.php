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
        $oldEmail = $input->getArgument('oldEmail');
        $newEmail = $input->getArgument('newEmail');
        $repeatEmail = $input->getArgument('repeatEmail');

        if($newEmail == $repeatEmail)
        {
            $repository = new UserRepository();
            $user = $repository->getUserByEmail($oldEmail);

            if($user)
            {
                $user->setEmail($newEmail);
                $text = 'The email has been changed';

                $this->getContainer()->get('StatsSystem')->postRequest(json_encode([$user, $_POST['oldEmail']]));
                $this->getContainer()->get('MarketingSystem')->postRequest(json_encode([$user, $_POST['oldEmail']]));

                //$logger = new Logger('logger');
                //$logger->info('Email has been changed from ' . $oldEmail . ' to ' . $newEmail);
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
