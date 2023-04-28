<?php
	namespace Core;
	
	class Track
	{
		private $controller;
		private $action;
		private $params;
        private $middlewares;
		
		public function __construct($controller, $action, $params = [], $middlewares=[])
		{
			$this->controller = $controller;
			$this->action = $action;
			$this->params = $params;
            $this->middlewares=$middlewares;
		}
		
		public function __get($property)
		{
			return $this->$property;
		}
	}
