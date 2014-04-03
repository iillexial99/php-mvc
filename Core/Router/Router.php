<?php
/*
 * 
 */
namespace Router;

class Router {
    
    public $route = array();
    public $config="config/config.php";
    
    public function __construct(){
        $conf = new \Config\Config('Core/Config/config.php');
        $this->config = $conf->loadConfig();

    }
    public function _init(){
		 
		$uri = parse_url($_SERVER['REQUEST_URI']);
		$routes = array_filter(explode('/', str_replace('.php', '', $uri['path'])));
		
		$this->route['controller'] = isset($routes[$this->config['controller_segment']]) ? ucwords($routes[$this->config['controller_segment']]).'Controller' : 'IndexController'; //Controller init
		$this->route['action'] = isset($routes[$this->config['action_segment']]) ? $routes[$this->config['action_segment']] : 'index'; //Action init 
		
		$c = $this->route['controller'];
		$c = "Controller\\$c";
		
		$action = $this->route['action'];
		
		if(is_file('Core/'.str_replace('\\', '//', $c).'.php')){
			
			$controller = new $c; //Create controller object
			
		}
		
		else{
			
			throw new \Exception("<pre>Unknown Controller:<b> ".$c."</b></pre>");
			
		}
		if(method_exists($controller, $this->route['action'])){
			$controller->$action();   
			
			
		}
		else{
			throw new \Exception("<pre>Unknown action <b>$action</b> in <b>$c</b> </pre>");
		}


	}
    
    
    public function routes($r, $controller, $action){
		
        $this->route['r'] = $r;
        $this->route['controller'] = $controller;
        $this->route['action'] = $action;

        
    }  
}
