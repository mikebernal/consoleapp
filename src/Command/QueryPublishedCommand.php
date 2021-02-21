<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

use Doctrine\DBAL\DriverManager;

require_once __DIR__ . '/../helpers.php';

/**
 * QueryPublishedCommand class
 * 
 * Fetch all post rows from the database
 */
class QueryPublishedCommand extends Command
{
    /**
     * configure function
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('published')
            ->setDescription('Fetch all post that are published only')
            ->setHelp('This command use the Doctrine DBAL API to request data from MySQL');
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
        // Row iterator 
        $i = 0;
        $headers = [];
        $table = new Table($output);

        // Configure database connection
        $params = array(
            'dbname' => 'bluesky',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $db = DriverManager::getConnection($params);

        // Queries
        $posts       = $db->executeQuery("SELECT * FROM post WHERE published = ?", array(1));
        $idsQ        = $db->executeQuery("SELECT id FROM post WHERE published = ?", array(1));
        $titlesQ     = $db->executeQuery("SELECT title FROM post WHERE published = ?", array(1));
        $bodyQ       = $db->executeQuery("SELECT body FROM post WHERE published = ?", array(1));
        $authorQ     = $db->executeQuery("SELECT author FROM post WHERE published = ?", array(1));
        $publlishedQ = $db->executeQuery("SELECT published FROM post WHERE published = ?", array(1));
        $createdAtQ  = $db->executeQuery("SELECT created_at FROM post WHERE published = ?", array(1));
        $rowCountQ   = $db->executeQuery("SELECT COUNT(*) as COUNT FROM post WHERE published = ?", array(1));

        $columns = $db->query("SHOW COLUMNS FROM post");

        // Get table headers dynamically from the db
        while($row = $columns->fetchAssociative()){
            array_push($headers, $row['Field']);
        }

        // Set table output
        $table->setHeaderTitle('Posts');
        $table->setHeaders($headers);
        // $table->setRows($posts->fetchAllAssociative());

        // Get Count
        $count;
        while ($row = $rowCountQ->fetchAssociative()) {
            $count = $row;
        }

        // Get titles
        $ids = [];
        while ($row = $idsQ->fetchAssociative()) {
            array_push($ids, $row['id']);
        }
        
        // Get titles
        $titles = [];
        while ($row = $titlesQ->fetchAssociative()) {
            array_push($titles, $row['title']);
        }

        // Get post body and display excerpt version
        $bodies = [];
        while ($row = $bodyQ->fetchAssociative()) {
            array_push($bodies, excerpt($row['body']));
        }

        // Get authors
        $authors = [];
        while ($row = $authorQ->fetchAssociative()) {
            array_push($authors, $row['author']);
        }

        // Get published
        $published = [];
        while ($row = $publlishedQ->fetchAssociative()) {
            array_push($published, $row['published']);
        }

        // Get created_at
        $created_at = [];
        while ($row = $createdAtQ->fetchAssociative()) {
            array_push($created_at, $row['created_at']);
        }

        // Dynamically add row
        while ($i < $count['COUNT']) {
            $table->addRow([$ids[$i], $titles[$i], $bodies[$i], $authors[$i], $published[$i], $created_at[$i]]);
            $i++;
        }
        $table->setColumnMaxWidth(2, 60);
        $table->render();

        return Command::SUCCESS;
    }
}