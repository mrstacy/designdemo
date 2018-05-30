<?php
namespace MrStacy\DesignDemo\EmailToken\Tests;

use MrStacy\DesignDemo\EmailToken\TokenGenerator;
use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase
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
	       ['invalidemail', 'b81490d83f718276679b472831c5a3a5'],
	       ['demotester@gmail.com', 'e7b6955ba3e75f257f03db2c92e16f9c'],
	       ['DemoTester@Gmail.com', 'e7b6955ba3e75f257f03db2c92e16f9c'],
	       ['johndoe@yahoo.com', '4a618a7c4cf0e12d764750b83d9e2485'],
	       ['Edward.Testington@IHaveaReallyReallyLongDomainNameForMyEmailWhichIsProbablySillyButGoodForTestingWith.com', 'ae4edfbc4ef4aef1b2ebcea4923eb245'],
        ];
    }
    
    /**
     * @dataProvider dataProviderEmailAddresses
     */
    public function testValidateToken($emailAddress, $token)
    {
        $tokenGenerator = new TokenGenerator('saltvalue');
        $valid = $tokenGenerator->validateToken($emailAddress, $token);
        
        self::assertTrue($valid);
    }
}