<?php


require 'vendor/autoload.php';

try{
    $route=new \Router\Router;
    $route->_init();
   
} catch (Exception $ex){
    
    echo $ex->getMessage(), "\n";
}

