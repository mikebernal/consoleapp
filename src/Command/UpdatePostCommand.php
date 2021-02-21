<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/../helpers.php';

/**
 * UpdatePostCommand class
 */
class UpdatePostCommand extends Command
{
    /**
     * configure function
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('edit-post')
            ->setDescription('edit post data from the database')
            ->setHelp('edit post using doctrine dbal');
    }

    /**
     * execute function
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return statuscode
     */
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

        // Enter post id to edit
        $postHelper = $this->getHelper('question');
        $postInput  = new Question("Enter post id to edit: ", "id");
        $postId     = $postHelper->ask($input, $output, $postInput);

        // $postToEdit = $db->query("SELECT * FROM post");
        $postToEdit = $db->fetchAssociative('SELECT id, title, body, author, published FROM post WHERE id = ?', array($postId));
        print_r($postToEdit);

        // Display current title
        $output->writeln("Current title value: " . $postToEdit['title']);

        // Prompt user for new title - empty for no changes
        $titleHelper = $this->getHelper('question');
        $titleInput  = new Question("Enter new title: [Leave blank to keep current value]: ", $postToEdit['title']);
        $title       = $titleHelper->ask($input, $output, $titleInput);
        $output->writeln("New title value: " . checkVal($title, $postToEdit['title']));
        $output->writeln("");

        // Display current body
        $output->writeln("Current body value: " . $postToEdit['body']);

        // Prompt user for new body - empty for no changes
        $bodyHelper = $this->getHelper('question');
        $bodyInput  = new Question("Enter new body: [Leave blank to keep current value]: ", $postToEdit['body']);
        $body       = $bodyHelper->ask($input, $output, $bodyInput);
        
        $output->writeln("New body value: " . checkVal($body, $postToEdit['body']));
        $output->writeln("");
        
        // Display current author
        $output->writeln("Current author value: " . $postToEdit['author']);

        // Prompt user for new author - empty for no changes
        $authorHelper = $this->getHelper('question');
        $authorInput  = new Question("Enter new body: [Leave blank to keep current value]: ", $postToEdit['author']);
        $author       = $authorHelper->ask($input, $output, $authorInput);
        $output->writeln("New author value: " . checkVal($author, $postToEdit['author']));
        $output->writeln("");

        // Display current published
        $output->writeln("Current published value: " . displayBool($postToEdit['published']));

        // Prompt user for new published - empty for no changes
        $publishedHelper = $this->getHelper('question');
        $publishedInput  = new Question("Enter new published: [Y/n]: ", 'y');
        $published       = $publishedHelper->ask($input, $output, $publishedInput);
        
        $output->writeln("New published value: " . displayBool(publishPost($published)));
        $output->writeln("");

        // Prepare UPDATE statement
        if ($db->update('post', array(
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'published' => publishPost($published)
        ), array('id' => $postId))) {
            $output->writeln($title . " has been updated successfully.");
        } else {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}