<?php
namespace MrStacy\DesignDemo\EmailToken;

class TokenGenerator
{
    /**
     * @var string
     */
    private $tokenSalt;
    
    /**
     * @param string $tokenSalt
     */
    public function __construct($tokenSalt) 
    {
        $this->tokenSalt = $tokenSalt;
    }
    
    /**
     * Generate a token for an email address.
     * 
     * Note: For purposes of this demo we are just going to keep it simple and create a 1-way token for the email address.
     * 
     * I ideally this would probably generate a token/uuid and save it to the database along with the email address so it can be retrieve again later
     * Alternatively, we coudl do a two-way encryption for the email address. I chose not to do this for the demo so no additional extensions would be required.
     * 
     * @param string $emailAddress
     * @return string
     */
    public function generateToken($emailAddress)
    {
        $emailAddress = strtolower($emailAddress);
        
        return crypt($emailAddress, $this->tokenSalt);
    }
}