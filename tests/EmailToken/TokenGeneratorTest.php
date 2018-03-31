<?php
namespace MrStacy\DesignDemo\EmailToken\Tests;

use MrStacy\DesignDemo\EmailToken\TokenGenerator;

class TokenGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderEmailAddresses
     */
    public function testGenerateToken($emailAddress, $expectedToken)
    {
        $tokenGenerator = new TokenGenerator('saltvalue');
        $token = $tokenGenerator->generateToken($emailAddress);

        self::assertEquals($expectedToken, $token);
    }
    
    public function dataProviderEmailAddresses()
    {
        return [
	       ['invalidemail', 'sabHmnjg2D.8U'],
	       ['demotester@gmail.com', 'saonjsPsgv7wk'],
	       ['DemoTester@Gmail.com', 'saonjsPsgv7wk'],
	       ['johndoe@yahoo.com', 'sa0dMN.t5Djsk'],
	       ['Edward.Testington@IHaveaReallyReallyLongDomainNameForMyEmailWhichIsProbablySillyButGoodForTestingWith.com', 'satGA1jrTzuic'],
        ];
    }
}