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
			require_once 'component/home/index.php';
		}


		// 404
		public function error()
		{
			require_once 'component/home/error.php';
		}

		// contact
		public function contact()
		{
			require_once 'component/home/contact.php';
		}

		// Acces denied
		public function refuse()
		{
			require_once 'component/home/refuse.php';
		}

	}

 ?>
