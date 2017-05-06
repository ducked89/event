<?php 

	/**
	* 
	*/
	class Home extends Controller
	{
		function __construct()
		{
			$this->checkUser();
			$Agent = $this->chargerMyModel('User');
			$this->datas['site'] = $this->checkInfoSession("site");

		}

		// Page d'accueil
		public function index ()
		{
			
			if(isset($this->datas['user']))
			{
				if($this->user->userInfo('roleid')==2)
					header("Location:".SITE."members/");
				else 
					header("Location:".SITE."administrator/");
			}

			$this->chargerViewLayout($this->layout, 'default/index', $this->datas);
		}


		// 404
		public function error()
		{
			$this->datas['menuSection'] = "home";
			$this->datas['title'] = "Connexion ";
			$this->chargerViewLayout($this->layout, 'default/error', $this->datas);
		
		}

		// contact
		public function contact()
		{
			$this->datas['menuSection'] = "contact";
			$this->datas['title'] = "Contactez-nous ";
			$this->chargerViewLayout($this->layout, 'default/contact', $this->datas);
		
		}

		// Acces denied
		public function refuse()
		{
			if($this->user->userInfo('login')==null)
			{
				header("Location:".SITE."home/");
			}
			else if($this->user->userInfo('roleid')==2)
			{
				header("Location:".SITE."members/prohibited");
			}else{
				header("Location:".SITE."administrator/prohibited");
			}
		}

	}

 ?>