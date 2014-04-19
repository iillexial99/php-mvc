<?php
ini_set('display_errors', 1);

require 'vendor/autoload.php';

try{
	

	\Router\Router::_init();
	
   
} catch (Exception $ex){
    
    echo $ex->getMessage(), "\n";
}

