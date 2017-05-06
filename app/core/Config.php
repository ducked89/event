<?php

/**
 * Configuration
 */

/**
 * Configuration affichage erreurs. Affiche toutes les erreurs dans l'environnement de developpement 
 * et de simple erreurs dans l'environnement de production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);



/**
 * Configuration pour la base de donnees
 * Identifiants et parametres de connexion.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'eventdb');
define('DB_USER', 'root');
define('DB_PASS', '');



/**
 * Configuration pour les vues
 *
 * PATH_VIEWS =  le repertoire ou se trouve les vues !
 * VIEW_FILE_TYPE = l'extention du fichier de la vue.
 */
define('PATH_VIEWS', 'app/views/');
define('EXT', '.php');
define('SITE', str_replace("index.php", "", $_SERVER['SCRIPT_NAME']));
define('SITE2', "/event1/");

/**
* Ouvrir la connexion a la base de donnees avec application/config/config.php
*/

try{
    //  FETCH_ASSOC retourne les resultats sous forme de tableau associatif: $result["user_name] !
    $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

    // Connexion a la base de donnees avec le connecteur PDO
    $PDO = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
}
catch (PDOException $e)
{
	die (" Connexion impossible à la base de donnees !");
}
