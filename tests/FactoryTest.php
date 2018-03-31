<?php
namespace MrStacy\DesignDemo\Tests;

use MrStacy\DesignDemo\Factory;
use MrStacy\DesignDemo\Config;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFactory()
    {
        $config = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $factory = new Factory($config);
        $app = $factory->createApplication();
        
        self::assertInstanceOf('Silex\Application', $app);
    }
}