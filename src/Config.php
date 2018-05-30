<?php
declare(strict_types=1);

namespace MrStacy\DesignDemo;

class Config
{
    const CONFIG_EMAIL_TOKEN_SALT = 'emailTokenSalt';
    
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
    public function getEmailTokenSalt() : ?string
    {
        return $this->getConfig(self::CONFIG_EMAIL_TOKEN_SALT);
    }
    
    /**
     * Get config value
     * 
     * @param string $configName
     */
    private function getConfig(string $configName)
    {
       return isset($this->config[$configName]) ? 
                $this->config[$configName] :
                null;
    }
}