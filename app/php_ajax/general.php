<?php
	session_start();
	date_default_timezone_set('America/New_York');
	// require('../core/Config.php'); 
	require('../core/connect_ajax.php'); 
	require('../core/Utilities.php'); 

	$find = new Model;
	$tools = new Utilities;
	$randLimit = rand(1, 10);


	// AJAX login utilisateur
	if(isset($_POST['id']) && $_POST['id']=="user_login_form" )
	{
		try{
			require('../models/User.class.php'); 
			$isLogged = $User->loginUser(array('connectname'=>$_POST['connectname'], 'connectpass' => sha1($_POST['connectpass'])));

			if($isLogged && $_SESSION['Auth']->level == 1) {
				$User->setSessTimeout(array('iduser'=>$_SESSION['Auth']->id, 
					'ipaddress'=>$Tools->get_client_ip(), 
					'browser'=>$Tools->get_client_browser(),
				'connexiondate'=>date("Y-m-d H:i:s")));
				echo "ADMIN";
			}
			else if($isLogged && $_SESSION['Auth']->level == 2) {
				$User->setSessTimeout(array('iduser'=>$_SESSION['Auth']->id, 
					'ipaddress'=>$Tools->get_client_ip(), 
					'browser'=>$Tools->get_client_browser(),
					'connexiondate'=>date("Y-m-d H:i:s")));
				echo "USER";
			}
			else echo "Identifiants incorrects !";
		}
		catch(PDOException $e)
		{
			echo "Erreur ! Contactez le webmaster.";
		}
	}


$PDO=null;
?>
