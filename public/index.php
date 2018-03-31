<?php
/**
 * Main web entry point of the API.  All requests
 * are funneled to this file via rewrite tasks.
 */
require_once __DIR__ . '/../vendor/autoload.php';

use MrStacy\DesignDemo\Factory;
use MrStacy\DesignDemo\Config;

$config = new Config(__DIR__ . '/../config/config.json');
$factory = new Factory($config);
$app = $factory->createApplication();

$app->run();
