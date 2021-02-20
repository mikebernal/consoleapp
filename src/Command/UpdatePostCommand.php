<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdatePostCommand extends Command
{
    protected function configure()
    {
        $this->setName('edit-post')
            ->setDescription('edit post data from the database')
            ->setHelp('edit post using doctrine dbal');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Initialization

        // Configure database connection
        $params = array(
            'dbname' => 'bluesky',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $db = DriverManager::getConnection($params);

        $postHelper = $this->getHelper('question');
        $postInput  = new Question("Enter post id to edit: ", "id");
        $postId     = $postHelper->ask($input, $output, $postInput);

        return Command::SUCCESS;

    }
}