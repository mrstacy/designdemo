<?php
namespace MrStacy\DesignDemo\Tests;

use MrStacy\DesignDemo\Router;
use Silex\Application;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $app = new Application();
        $router = new Router();
    
        $controllers = $router->connect($app);
        $routes = $controllers->flush();

        self::assertInstanceOf('Silex\ControllerCollection', $controllers);
        self::assertArrayHasKey('GET_v1_emailtoken_email_emailAddress', $routes->all());
        self::assertArrayHasKey('GET_v1_emailtoken_email_emailAddress_token_token', $routes->all());
    }
}