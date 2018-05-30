<?php
declare(strict_types=1);

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
     * @param string $emailAddress
     * @return string
     */
    public function generateToken($emailAddress) : string
    {
        $emailAddress = strtolower($emailAddress);
        
        return md5($emailAddress . $this->tokenSalt);
    }
    
    /**
     * Check if a token is valid for an email address
     * 
     * @param string $emailAddress
     * @param string $token
     */
    public function validateToken(string $emailAddress, string $token) : bool
    {
        $validToken = $this->generateToken($emailAddress);

        return ($token == $validToken);
    }
}