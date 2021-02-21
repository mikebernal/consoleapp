<?php

require __DIR__ . '/vendor/autoload.php';

use App\Command\AddPostCommand;
use App\Command\QueryPostsCommand;
use App\Command\QueryPublishedCommand;
use App\Command\DeletePostCommand;
use App\Command\UpdatePostCommand;
use Symfony\Component\Console\Application;

$app = new Application();

$app->add(new AddPostCommand());
$app->add(new QueryPostsCommand());
$app->add(new QueryPublishedCommand());
$app->add(new DeletePostCommand());
$app->add(new UpdatePostCommand());

$app->run();