<?php
/*
 * 
 */
namespace Router;

class Router {
    
    protected static $route = array();
    protected static $config="config/config.php"; //путь к файлу конфигов
    
    public function __construct(){
		/*
		 * Загрузка конфигов
		*/
        $conf = new \Config\Config('Core/Config/config.php');
        $this->config = $conf->loadConfig();
        $this->load = new \Loader\Loader;

    }

    static public function _init(){
		 
		$uri = parse_url($_SERVER['REQUEST_URI']); //парсим url сайта
		$routes = array_filter(explode('/', str_replace('.php', '', $uri['path']))); //разбиваем сегменты
		if(!isset(self::$route['r'])){
	
		self::$route['controller'] = isset(self::$config['controller_segment']) ? ucwords($routes[self::$config['controller_segment']]).'Controller' : 'IndexController'; //Controller init
		self::$route['action'] = isset(self::$config['action_segment']) ? $routes[self::$config['action_segment']] : 'index'; //Action init 
		}
		$c = ucwords(self::$route['controller']); //Обрабатываем строку
		$c = "Controller\\$c";
		$action = self::$route['action'];
		
		if(is_file('Core/'.str_replace('\\', '//', $c).'.php')){ //Проверяем наличие файла
			
			$controller = new $c; //Create controller object
			
		}
		
		else{
			
			throw new \Exception("<pre>Unknown Controller:<b> ".$c."</b></pre>"); //Если нету, то выбрасываем исключение			
		}
		if(method_exists($controller, self::$route['action'])){ //Проверяем наличие метода
			$controller->$action();   			
		}
		else{
			throw new \Exception("<pre>Unknown action <b>$action</b> in <b>$c</b> </pre>"); 
		}
		
		return 1;


	}
	
	
    static public function get($request, $controllerAction){
	
		
        self::$route['r'] = str_replace('/', '', $request);
		$explodeController = explode('@', $controllerAction);
		self::$route['controller'] = $explodeController[0];
		self::$route['action'] = $explodeController[1];
	}
    
    static public function post($name, $controllerAction){
		
		if(isset($_POST[$name])){
			
			$explodeController = explode('@', $controllerAction);
			self::$route['controller'] = $explodeController[0];
			self::$route['action'] = $explodeController[1];
		
		}
		else{
			
			throw new \Exception("<pre>Unknown post: $name</pre>");
		}
		
	}
 
}
