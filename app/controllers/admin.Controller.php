<?php
	class Admin extends Controller
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
			//$this->getNotifications($this->iduser);
			$this->datas['site'] = $this->checkInfoSession("site");


			$this->closeTheSession();
		}

		public function index ()
		{
			//if($this->isConnected())
			//{
				$this->updateSession();
			//	$this->profile();

            $this->chargerViewLayout($this->layout, $this->direct.'dashboard', $this->datas);

			//}
		}

		// public function sendMail($to, $to_name, $subject, $message){
		// 	require_once 'component/administrator/sendmail.php';
		// }
        //
		// public function genererTitre($idevalue, $idevaluateur, $mois, $annee){
		// 	require_once 'component/administrator/generer.php';
		// }
        //
        // public function dashboard (){
        //     require_once 'component/administrator/dashboard.php';
        // }
        //
		// public function events(){
		// 	require_once 'component/administrator/events.php';
		// }
        //
        // public function messages ()
        // {
        //     require_once 'component/administrator/messages.php';
        // }
        //
        // public function ponderations ()
        // {
        //     require_once 'component/administrator/ponderations.php';
        // }
        //
        // public function criteres ()
        // {
        //     require_once 'component/administrator/criteres.php';
        // }
        //
        // public function mentions ()
        // {
        //     require_once 'component/administrator/mentions.php';
        // }
        //
        // public function organizers ()
        // {
        //     require_once 'component/administrator/organizers.php';
        // }
        //
        // public function services ()
        // {
        //     require_once 'component/administrator/services.php';
        // }
        //
        // public function notifications ()
        // {
        //     require_once 'component/administrator/notifications.php';
        // }
        //
        // public function accounts ()
        // {
        //     require_once 'component/administrator/accounts.php';
        // }
        //
        // public function rapport ()
        // {
        //     require_once 'component/administrator/rapport.php';
        // }
        //
        // public function getNotifications($idu)
        // {
        //     require_once 'component/administrator/getNotification.php';
        // }
        //
        // public function getLastEvaluations()
        // {
        //     require_once 'component/administrator/getLastEvent.php';
        // }
        //
        // public function profile ()
        // {
        //     require_once 'component/administrator/profile.php';
        // }
        //
        // public function parametres ()
        // {
        //     require_once 'component/administrator/parametres.php';
        // }
        //
        // public function tools ()
        // {
        //     require_once 'component/administrator/tools.php';
        // }

		public function password ()
		{
            require_once 'component/administrator/password.php';
        }

		public function isConnected()
		{
            if($this->user->userInfo('login')==null)
            {
                header("Location:".SITE."home/");
            }
            else if($this->user->userInfo('roleid')!=1)
            {
                header("Location:".SITE."home/refuse/");
            }
            else{
                $this->updateSession();
                $this->datas['user'] = $this->user;
                return true;
            }
        }

		public function updateSession()
		{
			if(isset($_SESSION['Auth']) && !empty($_SESSION['Auth']->id))
				$this->user->updateUserSession(array('id'=>$_SESSION['Auth']->id));
			else
				header("Location:".SITE);
		}

		public function prohibited ()
		{
			if($this->isConnected())
			{
				$this->chargerViewLayout($this->layout, $this->direct.'prohibited', $this->datas);
			}
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

		public function logout()
		{
			// Destruction du tableau de Session
			$_SESSION = array();
			session_destroy();

			//Redirection vers la page d'accueil
			if(isset($_GET['goto']) && !empty($_GET['goto']))
			{
				header("Location:".SITE.$_GET['goto']);
			}
			else
			{
				header("Location:".SITE);
			}
		}


	}
?>
