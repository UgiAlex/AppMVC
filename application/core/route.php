<?php

class Route
{

	static function start()
	{
		// по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		$post_index = '';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		
		// получаем имя контроллера
		if ( !empty($routes[1]) )	{	
			$controller_name = $routes[1];
		}
		// получаем имя экшена
		if ( !empty($routes[2]) ) {
			$action_name = $routes[2];
		}
		// получаем индекс статьи в базе(если есть)
		if (!empty($routes[3])) {
			$post_index = $routes[3];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		// echo $model_name.'<br>';
		// echo $controller_name.'<br>';
		// echo $action_name.'<br>';
		// echo $post_index;

		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))	{
			include "application/models/".$model_file;
		}

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))	{
			include "application/controllers/".$controller_file;
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action))	{
			// вызываем действие контроллера
			if (!empty($post_index)) {
				$controller->$action($post_index);
			}
			else {
				$controller->$action();
			}
		}
	
	}

}
