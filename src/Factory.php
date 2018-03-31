<?php
namespace MrStacy\DesignDemo;

use MrStacy\DesignDemo\Controller\EmailTokenController;
use MrStacy\DesignDemo\EmailToken\TokenGenerator;
use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;

class Factory
{
    /**
     * @var Application
     */
    private $app;
    
    /**
     * @var Config
     */
    private $config;
    
    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    /**
     * Create the singleton Silex application and bootstrap it
     *
     * @return Application
     */
    public function createApplication()
    {
        if (!isset($this->app)) {
            $this->app = new Application();
            $this->registerServiceController();
            $this->initControllers();
            $this->mountRouter();
        }

        return $this->app;
    }
    
    /**
     * Registers the ServiceController provider to the application.
     * This provider enables name_of_service:method_name syntax
     * for declaring controllers.
     */
    private function registerServiceController()
    {
        $this->app->register(
            new ServiceControllerServiceProvider()
        );
    }
    
    /**
     * Register all controllers to the Application that are needed to make all API
     * endpoints available.
     *
     * @param Application $app
     */
    private function initControllers()
    {
        $this->app['controller.v1.emailToken'] = function () {
            return $this->createEmailTokenController();
        };
    }
    
    /**
     * @return EmailTokenController
     */
    private function createEmailTokenController()
    {
        return new EmailTokenController(
            $this->createTokenGenerator()
        );
    }
    
    /**
     * @return Config
     */
    private function getConfig()
    {
        return $this->config;
    }
    
    /**
     * @return TokenGenerator
     */
    private function createTokenGenerator()
    {
        return new TokenGenerator(
            $this->getConfig()->getEmailTokenSalt()
        );
    }
    
    /**
     * Mount the Router to the silex application
     */
    private function mountRouter()
    {
        $this->app->mount('/', new Router());
    }
    
    
}