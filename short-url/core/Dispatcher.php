<?php
	namespace Core;
	
	class Dispatcher
	{
		public function getPage(Track $track)
		{
			
			try {

                if (!(count($track->middlewares) == 0)) {
                    $middlewaresResult =  $this->executeMiddlewares($track->middlewares);
                    //var_dump($middlewaresResult);
                    if (!$middlewaresResult) {
                        echo "<div>Middleware check failed</div>"; die();
                    //throw new \Exception('Middleware check failed');
                    }
                }

                $className = ucfirst($track->controller) . 'Controller';
                $fullName = "\\Project\\Controllers\\$className";
				$controller = new $fullName;
				
				if (method_exists($controller, $track->action)) {
					$result = $controller->{$track->action}($track->params);
					
					if ($result) {
						return $result;
					} else {
						return new Page('default');
					}
				} else {
					echo "Метод <b>{$track->action}</b> не найден в классе $fullName."; die();
				}
			} catch (\Exception $error) {
				echo $error->getMessage(); die();
			}
		}

        private function executeMiddlewares($middlewares) {
            foreach ($middlewares as $middleware) {
                $middlewarePath = $_SERVER['DOCUMENT_ROOT'] . "/project/middlewares/$middleware.php";
                //var_dump($middlewarePath);
                if (file_exists($middlewarePath)) {
                    require_once $middlewarePath;
                    $isChecked = $middleware();
                    if (!$isChecked) {
                        //var_dump(false);
                        return false;
                    }

                }
            }
            return true;
        }
	}
