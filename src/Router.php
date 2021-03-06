<?php
declare(strict_types=1);

namespace MrStacy\DesignDemo;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Silex\ControllerCollection;

class Router implements ControllerProviderInterface
{

    /**
     * Map routes to controller methods here to map out the RESTful application
     *
     * @param Application $Application
     * @return ControllerCollection
     */
    public function connect(Application $application) : ControllerCollection
    {
        /** @var ControllerCollection $controllers */
        $controllers = $application["controllers_factory"];
    
        // endpoint to generate email token
        $controllers->get("/v1/email/{emailAddress}/token", "controller.v1.emailToken:getEmailToken");
        
        // validate email token
        $controllers->get("/v1/email/{emailAddress}/token/{token}", "controller.v1.emailToken:getValidateToken");
    
        return $controllers;
    }
    
}