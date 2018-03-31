<?php
namespace MrStacy\DesignDemo\Controller;

use MrStacy\DesignDemo\EmailToken\TokenGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EmailTokenController
{
    /**
     * @var TokenGenerator
     */
    private $tokenGenerator;
    
    /**
     * @param TokenGenerator $tokenGenerator
     */
    public function __construct(TokenGenerator $tokenGenerator) 
    {
        $this->tokenGenerator = $tokenGenerator;
    }
    
    /**
     * Get email token endpoint
     * 
     * GET /v1/emailtoken/email/{emailAddress}
     * 
     * @param Request $request
     * @param string $emailAddress
     * @return Response
     */
    public function getEmailToken(Request $request, $emailAddress)
    {
        $token = $this->tokenGenerator->generateToken($emailAddress);
        
        return new JsonResponse(['token'=>$token], Response::HTTP_OK);
    }
 
    
    /**
     * Endpoint to valid an email/token is valid
     *
     * GET /v1/emailtoken/email/{emailAddress}/token/{token}
     *
     * @param Request $request
     * @param string $emailAddress
     * @param string $token
     * @return Response
     */
    public function getValidateToken(Request $request, $emailAddress, $token)
    {
        $isTokenValid = $this->tokenGenerator->validateToken($emailAddress, $token);
        
        return new JsonResponse(['valid'=>$isTokenValid], Response::HTTP_OK);
    }
    
}