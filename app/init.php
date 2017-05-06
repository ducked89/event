<?php 
	 // Lien du site de la racine
	define('ROOT', str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']));

	date_default_timezone_set('America/New_York');
	
	// Connexion a la base de donnees
	require (ROOT.'app/core/Config.php');
	require (ROOT.'app/core/Utilities.php');

	// Connexion Client mail
	require_once (ROOT.'app/vendor/phpmailer/PHPMailerAutoload.php');
	require_once (ROOT.'app/vendor/swiftmailer/lib/swift_required.php');
	

	//Passage de la langue choisie dans l'URL
	if(!empty($_GET) && sizeof($_GET)>1){
		$exelang = $_SERVER['REQUEST_URI']."&lang=";
	}
	elseif(isset($_SERVER['REDIRECT_URL'])){
		$exelang = $_SERVER['REDIRECT_URL']."?lang=";
	}
	else{
		$exelang = str_replace("?lang=ht", "", str_replace("?lang=fr", "", str_replace("?lang=en", "", $_SERVER['REQUEST_URI']) ) )."?lang=";
	}

	define('EXELANG', $exelang);
	define('EXE', $_SERVER['REQUEST_URI']);

	// Initialisation du systeme
	require (ROOT.'app/core/App.php');
	require (ROOT.'app/core/Controller.php');

	$PDO == null;
 ?>