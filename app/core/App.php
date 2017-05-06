<?php 

	/**
	* 
	*/
	class App 
	{
		protected $controller = 'home';
		protected $controllerName = 'home';
		protected $method = 'index';
		protected $params = array();


		function __construct() 
		{
			$url = $this->parseUrl();


			//Verifier si le controlleur existe, le fichier
			if(isset($url[0]) && file_exists('app/controllers/' . $url[0]. '.Controller.php'))
			{
				$this->controller =  $url[0];
				unset($url[0]);
			}

			require_once 'app/controllers/'. $this->controller . '.Controller.php';
			$this->controllerName = $this->controller;
			$this->controller = new $this->controller;



			//Verifier si une methode est demandee
			if (isset($url[1])) {
				if(method_exists($this->controller, $url[1]))
				{
					$this->method = $url[1];
					unset($url[1]);
				}

			}


			//Allouer les parametres
			$this->params = $url ? array_values($url) : array();
			$this->controller->setparams($this->params);
			$arr = array($this->controller, $this->method);
			call_user_func_array($arr, $this->params);
		}


		/**
	     * Router l'url demandé
	     */
		public function parseUrl()
		{

			if(isset($_GET['url']))
			{
				return $url = explode('/', filter_var(rtrim(strtolower($_GET['url']), '/'), FILTER_SANITIZE_URL));
			}
		}



		 
	}

 ?>