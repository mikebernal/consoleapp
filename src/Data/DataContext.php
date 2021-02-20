<?php

namespace App\Data;

use Doctrine\DBAL\DriverManager;

class DataContext
{
    public $params;
    public $ctx;

    public function __construct()
    {
        $this->params = array(
            'dbname' => 'bluesky',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        return $this->ctx = DriverManager::getConnection($this->params);

        return $this->ctx;
    }

    public function getRows()
    {
        $rows = $this->ctx->query("SELECT * FROM post");
        return $rows;
    }

    // public function getRowById($id)
    // {

    // }

    // public function addRow($row)
    // {

    // }
}