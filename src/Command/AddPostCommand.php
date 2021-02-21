<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/../helpers.php';

class AddPostCommand extends Command
{
    protected function configure()
    {
        $this->setName('add-post')
            ->setDescription('insert post data to the database')
            ->setHelp('write post using doctrine dbal');
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

        $output->writeln("");
        $output->writeln("[====================]");
        $output->writeln("[--------------------]");
        $output->writeln("[---Write-New-Post---]");
        $output->writeln("[--------------------]");
        $output->writeln("[====================]");
        $output->writeln("");
        $output->writeln("title (required)");
        $output->writeln("body");
        $output->writeln("author");
        $output->writeln("published: [Y/n]");
        $output->writeln("");

        // Title
        $titleHelper = $this->getHelper('question');
        $titleInput  = new Question("Enter post title: ", "title");
        $title = $titleHelper->ask($input, $output, $titleInput);
        $output->writeln("");
        $message = sprintf("Post title: %s", $title);

        // Body
        $bodyHelper = $this->getHelper('question');
        $bodyInput  = new Question("Enter post body: ", "body");
        $body = $bodyHelper->ask($input, $output, $bodyInput);
        $output->writeln("");
        $message = sprintf("Post body: %s", $body);

        // Author
        $authorHelper = $this->getHelper('question');
        $authorInput  = new Question("Enter author: ", "author");
        $author = $authorHelper->ask($input, $output, $authorInput);
        $output->writeln("");
        $message = sprintf("Post author: %s", $author);

        // Published
        $publishedHelper = $this->getHelper('question');
        $publishedInput  = new Question("Publish " . $title . "? [Y/n]", "published");
        $published = $publishedHelper->ask($input, $output, $publishedInput);
        $bool = publishPost($published);
        $output->writeln("");

        // Prepare INSERT statement
        if ($db->insert('post', array(
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'published' => $bool 
        ))) {
            // Success message
            $output->writeln($title . ' has been added successfully.');
        } else {
            $outout->writeln('Please check your query');
            return Command::FAILURE;
        }


        return Command::SUCCESS;
    }
}