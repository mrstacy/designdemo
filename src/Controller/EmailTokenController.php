<?php
declare(strict_types=1);

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
     * GET /v1/email/{emailAddress}/token
     * 
     * @param Request $request
     * @param string $emailAddress
     * @return Response
     */
    public function getEmailToken(Request $request, string $emailAddress) : Response
    {
        $token = $this->tokenGenerator->generateToken($emailAddress);
        
        return new JsonResponse(['token'=>$token], Response::HTTP_OK);
    }
 
    
    /**
     * Endpoint to valid an email/token is valid
     *
     * GET /v1/email/{emailAddress}/token/{token}
     *
     * @param Request $request
     * @param string $emailAddress
     * @param string $token
     * @return Response
     */
    public function getValidateToken(Request $request, string $emailAddress, string $token) : Response
    {
        $isTokenValid = $this->tokenGenerator->validateToken($emailAddress, $token);
        
        return new JsonResponse(['valid'=>$isTokenValid], Response::HTTP_OK);
    }
    
}