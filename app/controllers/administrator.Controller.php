<?php 
	class Administrator extends Controller
	{
		public $layout = "administrator";
		public $direct = "administrator/";

		


		public function __construct()
		{
			
			$this->user = $this->chargerMyModel("User");
			$this->updateSession();
			$this->iduser = $this->user->userInfo("id");
			$Agent = $this->chargerMyModel('Model');
			$Tools = $this->useUtility("Utilities");
			$this->getNotifications($this->iduser);
			$this->datas['site'] = $this->checkInfoSession("site");


			$this->closeTheSession();
		}

		public function index ()
		{
			if($this->isConnected())
			{			
				$this->updateSession();
				$this->dashboard();
			}
		}

		public function events(){
			require_once 'component/administrator/events.php';
		}

		
	}
?>