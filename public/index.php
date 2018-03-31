<?php
/**
 * Main web entry point of the API.  All requests
 * are funneled to this file via rewrite tasks.
 */
require_once __DIR__ . '/../vendor/autoload.php';

use MrStacy\DesignDemo\Factory;

$factory = new Factory();
$app = $factory->createApplication();

$app->run();
