<?php
namespace MrStacy\DesignDemo;

class Config
{
    private $config;
    
    /**
     * Load config file
     * 
     * @param string $configFile
     */
    public function __construct($configFile) 
    {
        $this->config = json_decode(file_get_contents($configFile), true);        
    }
    
    /**
     * Get email Token generation salt value
     * 
     * @return string
     */
    public function getEmailTokenSalt()
    {
        return $this->config['emailTokenSalt'];
    }
}