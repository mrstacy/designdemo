<?php
namespace MrStacy\DesignDemo\Tests\Functional;

use MrStacy\DesignDemo\Config;
use MrStacy\DesignDemo\Factory;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class AppTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    private $app;
    
    public function setUp()
    {
        $config = new Config(__DIR__ . '/../../config/config.test.json');
        $factory = new Factory($config);
        $this->app = $factory->createApplication();
    }
    
    /**
     * @group functional
     * @dataProvider dataProviderEmailAddresses
     */
    public function testV1EmailTokenRequest($emailAddress, $expectedToken)
    {
        $request = Request::create("/v1/emailtoken/{$emailAddress}");
        
        $response = $this->app->handle($request);
        $result = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($expectedToken, $result->token);
    }
    
    public function dataProviderEmailAddresses()
    {
        return [
            ['emailaddress@gmail.com','deIhR/DSOoAf6'],
            ['differentemail@gmail.com','debHATXUzAduY'],
            ['mrsmith@gmail.com','deW/X95WZAhVY'],
            ['MrSmith@Gmail.com','deW/X95WZAhVY'],
        ];
    }
    
    public function testBadRequest()
    {
        $request = Request::create('/badrequest');
        
        $response = $this->app->handle($request);
        
        $this->assertEquals(404, $response->getStatusCode());
    }
}