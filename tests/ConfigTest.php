<?php
namespace MrStacy\DesignDemo\Tests;

use MrStacy\DesignDemo\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testConfig()
    {
        $configFile = __DIR__ . '/../config/config.json';
        $config = new Config($configFile);
        
        self::assertEquals('demoSaltValue', $config->getEmailTokenSalt());
    }
}