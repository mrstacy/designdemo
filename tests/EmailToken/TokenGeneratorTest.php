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
        $tokenGenerator = new TokenGenerator();
        $token = $tokenGenerator->generateToken($emailAddress);

        self::assertEquals($expectedToken, $token);
    }
    
    public function dataProviderEmailAddresses()
    {
        return [
	       ['invalidemail', 'dem.IJlUK3sNQ'],
	       ['demotester@gmail.com', 'deWnptq3lB/PE'],
	       ['DemoTester@Gmail.com', 'deWnptq3lB/PE'],
	       ['johndoe@yahoo.com', 'deQ7RfwrW7Kw6'],
	       ['Edward.Testington@IHaveaReallyReallyLongDomainNameForMyEmailWhichIsProbablySillyButGoodForTestingWith.com', 'deqTkZEFLx55g'],
        ];
    }
}