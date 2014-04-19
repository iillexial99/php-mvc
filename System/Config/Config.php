<?php
namespace Config;
class Config{
    public function __construct($pathConfig){
        
        $this->config = $pathConfig;
        
    }
    
     public function loadConfig($type){
         
        $config = require($this->config);
        return $config[$type];
        
    }

    
    
    
}

