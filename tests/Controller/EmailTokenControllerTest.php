<?php
namespace MrStacy\DesignDemo\Controller\Tests;

use MrStacy\DesignDemo\EmailToken\TokenGenerator;
use MrStacy\DesignDemo\Controller\EmailTokenController;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class EmailTokenControllerTest extends TestCase
{
    public function testGetEmailToken()
    {
        $tokenGeneratorMock = $this->getMockBuilder(TokenGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $tokenGeneratorMock->expects($this->once())
            ->method('generateToken')
            ->with('emailaddress@gmail.com')
            ->willReturn('token');
            
        $controller = new EmailTokenController($tokenGeneratorMock);
        
        $request = Request::create('/v1/email/emailaddress@gmail.com/token');
        
        $response = $controller->getEmailToken($request, 'emailaddress@gmail.com');
        
        $result = json_decode($response->getContent());
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('token', $result->token);
    }
    
    public function testGetValidateToken()
    {
        $tokenGeneratorMock = $this->getMockBuilder(TokenGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        $tokenGeneratorMock->expects($this->once())
            ->method('validateToken')
            ->with('emailaddress@gmail.com', 'abcd1234')
            ->willReturn(true);
        
        $controller = new EmailTokenController($tokenGeneratorMock);
        
        $request = Request::create('/v1/email/emailaddress@gmail.com/token/abcd1234');
        
        $response = $controller->getValidateToken($request, 'emailaddress@gmail.com', 'abcd1234');
        
        $result = json_decode($response->getContent());
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(true, $result->valid);
    }
    
}