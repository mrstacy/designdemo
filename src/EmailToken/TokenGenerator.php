<?php
namespace MrStacy\DesignDemo\EmailToken;

class TokenGenerator
{
    const tokenSalt = 'demoSaltValue';
    
    /**
     * Generate a token for an email address.
     *  
     * Note: For purposes of this demo we are just going to create a 1-way token for the email address.
     * This token would need to be saved with the email address if we wanted to get the email address by token.
     * Alternatively, we could do a two-way encryption for email address. I chose not to do this for the demo so no additional extensions would be required.   
     * 
     * @param string $emailAddress
     * @return string
     */
    public function generateToken($emailAddress)
    {
        $emailAddress = strtolower($emailAddress);
        
        return crypt($emailAddress, self::tokenSalt);
    }
}