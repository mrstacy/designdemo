<?php
namespace MrStacy\DesignDemo\Tests;

use MrStacy\DesignDemo\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $configFile = __DIR__ . '/../config/config.test.json';
        $config = new Config($configFile);
        
        self::assertEquals('demoSaltValue', $config->getEmailTokenSalt());
    }
}