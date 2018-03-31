<?php
namespace MrStacy\DesignDemo\Tests;

use MrStacy\DesignDemo\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFactory()
    {
        $factory = new Factory();
        $app = $factory->createApplication();
        
        self::assertInstanceOf('Silex\Application', $app);
    }
}