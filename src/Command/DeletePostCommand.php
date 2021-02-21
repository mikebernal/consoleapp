<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\DBAL\DriverManager;

class DeletePostCommand extends Command
{
    protected function configure()
    {
        $this->setName('delete-post')
            ->setDescription('delete post data from the database')
            ->setHelp('delete post using doctrine dbal');
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
        $postInput  = new Question("Enter post id to delete: ", "id");
        $postId     = $postHelper->ask($input, $output, $postInput);

        $res = $db->executeQuery('SELECT title FROM post WHERE id = ?', array($postId));
        $title = $res->fetchNumeric();

        // Prepare DELETE statement
        if ($db->delete('post', array('id' => $postId))) {
            $output->writeln($title[0] . ' has been added deleted.');
        } else {
            return Command::FAILURE;
        }

        return Command::SUCCESS;

    }
}