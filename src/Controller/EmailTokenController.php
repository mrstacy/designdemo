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
     * GET /v1/emailtoken/{emailAddress}
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
    
}