<?php
/**
 * Class Router маршрутизатор
 */
class Router
{
	private $routes = array();

	/**
	 * Router constructor подключает маршруты
	 */
	public function __construct()
	{
		$this->routes = include("config/routes.php");
	}

	/**
	 * @return string текущий адрес запроса
	 */
	public function getURI()
	{
		if (isset($_SERVER['REQUEST_URI']) and !empty($_SERVER['REQUEST_URI']))

			return trim($_SERVER['REQUEST_URI'], '/');
	}

	public function start()
	{

		// получаем строку запроса
		$uri = $this->getURI();

		// проверяем наличие этого запроса в routes.php
		foreach ($this->routes as $uriPattern => $path) {

			// сравниваем uriPattern и $uri
			if (preg_match("#^$uriPattern$#", $uri)) {

				// Получаем внутренний путь из внешнего согласно правилу
				$innerRoute = preg_replace("#^$uriPattern$#", $path, $uri);
				// Определяем контроллер, action, параметры
				$segments = explode('/', $innerRoute);

				$controllerName = ucfirst(array_shift($segments) . 'Controller');

				$actionName = 'action' . ucfirst(array_shift($segments));

				$parameters = $segments;

				//Подключаем файл контроллера
				$controllerFile = ROOT . "/controllers/" . $controllerName . ".php";
				if (file_exists($controllerFile))
					include_once($controllerFile);

				//Создаем объект контроллера и дергаем нужный action
				$controllerObject = new $controllerName;

				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

				if ($result != null)
                    break;
			}
		}
	}


	// запуск роутера
}?>