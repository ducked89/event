<?php 
	
	
	
	/**
	* 
	*/
	
	class Controller  
	{
		public $datas = array();
		public $layout = "layout";
		public $forbidenPage ="home/error/";
		public $accessPage = "home/refuse/";
		public $mail="";



		function __construct() 
		{
			
		 	
 		}
 		
 		// Verification de la connexion d'un utilisateur
		public function checkUser()
		{
			if(isset($_SESSION['Auth']))
			{

				$this->user = $this->chargerMyModel("User");
				$this->datas['user'] = $this->user;
			}
		}

		// Verification de la connexion d'un utilisateur
		public function checkInfoSession($key=null)
		{
			$Agent = $this->chargerMyModel("User");
			$Agent->useTable('parametres');
			$found = $Agent->trouverTout();
			$_SESSION['site']=$found[0];
			if(isset($_SESSION[$key])) return $_SESSION[$key];
			else return null;
		}

		/**
	     * Chager un model dans l'application
	     */
		public function chargerModel($model)
		 {
		 	require_once 'app/models/Model.class.php';
		 	require_once 'app/models/'.$model.'.class.php';
		 	// $Model = new Model;
		 	// $mModel = new Users;
		 	return  new $model;
		 }

		 public function chargerMyModel($model)
		 {
		 	require_once 'app/models/Model.class.php';
		 	require_once 'app/models/'.$model.'.class.php';
		 	return  new $model;
		 }


		 /**
	     * Import utilities
	     */
		  public function useUtility($name)
		 {
		 	require_once 'app/core/'.$name.'.php';
		 	return  new $name;
		 }


		/**
	     * Charger une vue dans l'application
		 */
		public function chargerView($view, $datas)
		 {
		 	require_once 'app/core/Utilities.php';
			 if(file_exists('app/views/layouts/' . $view  . '.php'))
		 	 {
			 	require_once 'app/views/layouts/' . $view  . '.php';
			 }
			 else
			 {
			 	return false;
			 }
		 }

		/**
	     * Charger une vue via layout dans l'application
		 */
		public function chargerViewLayout($layout, $view, $datas)
		 {
		 	require_once 'app/core/Utilities.php';
			 if(file_exists('app/views/layouts/' . $layout  . '.php'))
		 	 {
			 	require_once 'app/views/layouts/' . $layout  . '.php';
			 }
			 else
			 {
			 	require_once 'app/views/layouts/default.php';
			 }
		 }


	

		public function setparams($p)
		{
			$this->datas['params'] = $p;
		}

		public function getparams()
		{
			return $this->datas['params'];
		}
		

		
		function rediction($url){
			header("Location:".SITE.$url);
		}

		/*
		* Redirige un utilisateur en cas d'erreur
		*/
		public function redirigerVers($link){
			if($link!=null) header("Location:".SITE.$link);
			else header("Location:".SITE);
		}

		public function forbiden(){
			header("Location:".$this->forbidenPage);
		}

		public function refuse(){
			header("Location:".$this->accessPage);
		}

		public function closeTheSession(){
			$inactive = 1800;
			$actual = strtotime(date("Y-m-d H:i:s"));
			$login = strtotime(($this->user->userInfo("timeout")));
    		$session_life = $actual - $login ;

    		if($session_life > $inactive) 
    		{
    			$_SESSION = array();
    			session_destroy();
    			header("Location:".SITE);
    		}
		}


		public function configMail(){

			$Agent = $this->chargerMyModel("User");
			$Agent->useTable('mailconfig');
			$mailInfo = $Agent->trouverTout();

			if(count($mailInfo)>0 && isset($mailInfo[0]->id))
			{

				$this->mail->isSMTP();                                      // Set mailer to use SMTP
				$this->mail->Host = $mailInfo[0]->host;  				// Specify main and backup SMTP servers
				$this->mail->SMTPAuth = true;                            // Enable SMTP authentication
				$this->mail->Username = $mailInfo[0]->username;          // SMTP username
				$this->mail->Password = $mailInfo[0]->password;                        // SMTP password
				$this->mail->SMTPSecure = $mailInfo[0]->smtpsecure;                            // Enable TLS encryption, `ssl` also accepted
				$this->mail->Port = $mailInfo[0]->port;                                    // TCP port to connect to

				
			}

		}

		
	}

 ?>