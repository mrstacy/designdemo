<?php
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
    public function connect(Application $application)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $application["controllers_factory"];
    
        // Base Url is prepended to all requests listed in this router
        $controllers->get("/v1/emailtoken/{emailAddress}", "controller.v1.emailToken:getEmailToken");
    
        return $controllers;
    }
    
}