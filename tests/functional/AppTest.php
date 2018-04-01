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
        $request = Request::create("/v1/email/{$emailAddress}/token");
        
        $response = $this->app->handle($request);
        $result = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($expectedToken, $result->token);
    }
    
    /**
     * @group functional
     * @dataProvider dataProviderEmailAddresses
     */
    public function testV1EmailTokenValidateRequest($emailAddress, $token)
    {
        $request = Request::create("/v1/email/{$emailAddress}/token/{$token}");
        
        $response = $this->app->handle($request);
        $result = json_decode($response->getContent());
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($result->valid);
    }
    
    public function dataProviderEmailAddresses()
    {
        return [
            ['invalidemail','d30f25c0d1a0e48bf6a0f55e85accc46'],
            ['emailaddress@gmail.com','34c3836ca3d0325502f0999da4b9e480'],
            ['differentemail@gmail.com','c886b4be712819e80abd85bf5d9cc121'],
            ['mrsmith@gmail.com','0b7989e991a65513c105129522fc39be'],
            ['MrSmith@Gmail.com','0b7989e991a65513c105129522fc39be'],
        ];
    }
    
    /**
     * @group functional
     */
    public function testBadRequest()
    {
        $request = Request::create('/badrequest');
        
        $response = $this->app->handle($request);
        
        $this->assertEquals(404, $response->getStatusCode());
    }
}