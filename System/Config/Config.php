<?php
namespace Config;
class Config{
    public function __construct($pathConfig){
        
        $this->config = $pathConfig;
        
    }
    
     public function loadConfig(){
         
        require $this->config;
        return $config;
        
    }

    
    
    
}

