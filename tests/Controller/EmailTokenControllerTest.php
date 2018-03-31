<?php
namespace MrStacy\DesignDemo\Controller\Tests;

use MrStacy\DesignDemo\EmailToken\TokenGenerator;
use MrStacy\DesignDemo\Controller\EmailTokenController;
use Symfony\Component\HttpFoundation\Request;

class EmailTokenControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testV1EmailToken()
    {
        $tokenGeneratorMock = $this->getMockBuilder(TokenGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $tokenGeneratorMock->expects($this->once())
            ->method('generateToken')
            ->willReturn('token');
            
        $controller = new EmailTokenController($tokenGeneratorMock);
        
        $request = Request::create('/v1/emailtoken/emailaddress@gmail.com');
        
        $response = $controller->getEmailToken($request, 'emailaddress@gmail.com');
        
        $result = json_decode($response->getContent());
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('token', $result->token);
    }
}