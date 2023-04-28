<?php
	namespace Core;
	
	class Route
	{
		private $path;
		private $controller;
		private $action;
        private $middlewares;
		
		public function __construct($path, $controller, $action, $middlewares = [])
		{
			$this->path = $path;
			$this->controller = $controller;
			$this->action = $action;
            $this->middlewares = $middlewares;
		}
		
		public function __get($property)
		{
			return $this->$property;
		}
	}
