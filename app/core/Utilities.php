<?php

/**
* 
*/
class Utilities {
	public $v="";
	
	/**
	* Difference entre deux dates
	*/
	function dateDifference($beginDate, $endDate) {
			$fromDate = date('Y-m-d',strtotime($beginDate));
			$toDate = date('Y-m-d',strtotime($endDate));
			$date_parts1=explode('-', $beginDate);
			$date_parts2=explode('-', $endDate);
			$start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
			$end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
			return $end_date - $start_date;
		}

	    // Function to get the client IP address
		public function get_client_ip() {
		    $ipaddress = '';
		    if (isset($_SERVER['HTTP_CLIENT_IP']))
		        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED'];
		    else if(isset($_SERVER['REMOTE_ADDR']))
		        $ipaddress = $_SERVER['REMOTE_ADDR'];
		    else
		        $ipaddress = 'UNKNOWN';
		    return $ipaddress;
		}

		public function get_client_browser() {
			 $browser = '';

			 $browser = $_SERVER['HTTP_USER_AGENT'];

			return $browser;
		}



	
	/**
	* Difference entre deux dates
	*/
	function convertToLink($string)
	{
		$link="";
		$tabwords =	preg_split('/[^a-zA-Z\'"-]+/', $string, -1, PREG_SPLIT_NO_EMPTY);
		foreach($tabwords as $word)
		{
			if(strlen($word)>=3) $link .= strtolower($word)."-";
		}
		return substr($link,0, -1);
	}

	function nomMois($mois){
		$nomMois= "";
		switch ($mois) {
			case 1:
			$nomMois= 'JAN';
			break;

			case 2:
			$nomMois= 'FÉV';
			break;

			case 3:
			$nomMois= 'MAR';
			break;

			case 4:
			$nomMois= 'AVR';
			break;

			case 5:
			$nomMois= 'MAI';
			break;

			case 6:
			$nomMois= 'JUN';
			break;

			case 7:
			$nomMois= 'JUL';
			break;

			case 8:
			$nomMois= 'AOÛ';
			break;

			case 9:
			$nomMois= 'SEP';
			break;

			case 10:
			$nomMois= 'OCT';
			break;

			case 11:
			$nomMois= 'NOV';
			break;

			case 12:
			$nomMois= 'DÉC';
			break;

			
			
			default:
				$nomMois = '';
				break;
		}
		return $nomMois;
	}


	/**
	* Generer le code
	*/
	public function creerCode($name){
		$code = "spahaiti-";
		$words = strtolower(str_replace(" ", "-", str_replace("'", "-", stripslashes($name))));
		$tabwords = explode("-",$words);
		$i = 0;
		foreach($tabwords as $word)
		{
			if(strlen($word)>3 && $i<5) $code .=substr(strtolower(preg_replace('/[^A-Za-z\-]/', '', $word)), 0, 1);
			$i++;
		}
		$code .= "-".(date("d")+date("m")).date("Y").(date("H")+date("i")+date("s"));
		return strtoupper($code);
	}



	/**
	* Generer le code des utilisateur
	*/
	public function creerCodeUser($name, $lastname){
		$code = strtolower(substr($name), 0, 1).strtolower(substr($lastname), 0, 1).substr(date("Y"), -2).'-'.(date("H")+date("i")+date("s"));
		return strtoupper($code);
	}



	/**
	* Conversion d'une chaine de chiffre en decimale de 3 chiffres
	*/
	public function convertStringDecimal($num)
	{
		$j=1;
		for ($i=strlen($num)-1; $i >=0 ; $i--) { 
			if($j%3==0) $v{$i} = " ".$num{$i};
			else $v{$i} = $num{$i};
			$j++;
		}
		$j="";
		for ($i=0; $i <=sizeof($v)-1 ; $i++) { 
			$j .= $v{$i};
		}
		return $j;
	}


	/**
	* Creer la miniatiure d'une image
	*/
	static function creerMin($img,$chemin,$nom,$mlargeur=100,$mhauteur=100){
		// On supprime l'extension du nom
		$nom = substr($nom,0,-4);
		// On récupère les dimensions de l'image
		$dimension=getimagesize($img);
		// On cré une image à partir du fichier récup
		if(substr(strtolower($img),-4)==".jpg" || substr(strtolower($img),-4)==".JPG"){$image = imagecreatefromjpeg($img); }
		else if(substr(strtolower($img),-4)==".png" || substr(strtolower($img),-4)==".PNG"){$image = imagecreatefrompng($img); }
		else if(substr(strtolower($img),-4)==".gif" || substr(strtolower($img),-4)==".GIF"){$image = imagecreatefromgif($img); }
		// L'image ne peut etre redimensionne
		else{return false; }
		
		// Création des miniatures
		// On cré une image vide de la largeur et hauteur voulue
		$miniature =imagecreatetruecolor ($mlargeur,$mhauteur); 
		// On va gérer la position et le redimensionnement de la grande image
		if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0;}
		if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0;}
		if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0;}
		// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
		imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
		// On sauvegarde le tout
		imagejpeg($miniature,$chemin."/".$nom.substr(strtolower($img),-4),90);
		return true;
	}


	/**
	* Creer une pagination simple
	*/
	public function creerPaginationSimple($onPage, $nbPage, $obj){

		$pagination = '
		<div class="break"></div>
		<div class="table-pagination">
			<a class="btn btn-white btn-sm" href="?page=1">Premier</a>
			';


			if($onPage>0 && $onPage<=$nbPage){
				$pagination .= '
				<a class="btn btn-white btn-sm button-icon" href="?page='.($onPage-1).'">
					<i class="fa fa-chevron-left"></i></a>
				<a class="btn btn-white btn-sm onpage" href="?page='.$onPage.'">'.$onPage.'</a>
				<a class="btn btn-white btn-sm button-icon" href="?page='.($onPage+1).'">
					<i class="fa fa-chevron-right"></i></a>
				<a class="btn btn-white btn-sm" href="?page='.$nbPage.'">Dernier</a>
			';
			}
			$pagination .= '</div> <div class="clear"></div>
		';
		return $pagination;
	}

	public function creerPaginationSimpleAction($onPage, $nbPage, $obj, $action){

		$pagination = '
		<div class="break"></div>
		<div class="table-pagination">
			<a class="btn btn-white btn-sm" href="?action='.$action.'&page=1">Premier</a>
			';


			if($onPage>0 && $onPage<=$nbPage){
				$pagination .= '
				<a class="btn btn-white btn-sm button-icon" href="?action='.$action.'&page='.($onPage-1).'">
					<i class="fa fa-chevron-left"></i></a>
				<a class="btn btn-white btn-sm onpage" href="?action='.$action.'&page='.$onPage.'">'.$onPage.'</a>
				<a class="btn btn-white btn-sm button-icon" href="?action='.$action.'&page='.($onPage+1).'">
					<i class="fa fa-chevron-right"></i></a>
				<a class="btn btn-white btn-sm" href="?action='.$action.'&page='.$nbPage.'">Dernier</a>
			';
			}
			$pagination .= '</div> <div class="clear"></div>
		';
		return $pagination;
	}
	public function creerCustomPagination($onPage, $nbPage, $obj){

		$pagination = '
		<div class="clear break"></div>
		<div class="table-foot">

		<ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="?page=1">&laquo;</a></li>';

        if($onPage>0 && $onPage<=$nbPage){
			$pagination .= '
            <li><a href="?page='.($onPage-1).'">Prec.</a></li>
            <li><a href="?page='.($onPage+2).'">Suiv.</a>
            <li><a href="?page='.$nbPage.'">&raquo;</a></li>
            ';
		}
		else $pagination .= '<li><a href="?page='.($onPage+1).'">&raquo;</a></li>';

		$pagination .= '</ul></div>';
		return $pagination;
	}


	/**
	* Creer une pagination
	*/
	public function creerPagination($onPage, $nbPage, $obj){

		$pagination = '
		<div class="break"></div>
		<div class="table-pagination">
			<a class="pagination button" href="?page=1">First</a>
			';


			if($onPage>0 && $onPage<=$nbPage){
				$pagination .= '
				<a class="pagination button" href="?page='.($onPage-1).'">Previous</a>
				<a class="pagination button onpage" href="?page='.$onPage.'">'.$onPage.'</a>
				<a class="pagination button" href="?page='.($onPage+1).'">'.($onPage+1).'</a>
				<a class="pagination button" href="?page='.($onPage+2).'">Next</a>
				<a class="pagination button" href="?page='.$nbPage.'">Last</a>
			';
			}
			$pagination .= '
			<a class="pagination button" id="none">Page '.$onPage.' sur '.$nbPage.' page(s)</a> 
			<a class="ajax pagination button" onclick="refresh'.$obj.'()">Recharger</a> 
		</div>
		<div class="clear break"></div>
		';
		return $pagination;
	}


	/**
	* Convertir PHP Array to JSO Objects
	*/
	function convertPHPJSON($arr) {
	    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
	    $parts = array();
	    $is_list = false;

	    //Find out if the given array is a numerical array
	    $keys = array_keys($arr);
	    $max_length = count($arr)-1;
	    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {
	    	//See if the first key is 0 and last key is length - 1
	        $is_list = true;
	        for($i=0; $i<count($keys); $i++) { 
	        	//See if each key correspondes to its position
	            if($i != $keys[$i]) { 
	            	//A key fails at position check.
	                $is_list = false; 
	                //It is an associative array.
	                break;
	            }
	        }
	    }

	    foreach($arr as $key=>$value) {
	        if(is_array($value)) { 
	        	//Custom handling for arrays
	            if($is_list) $parts[] = convertPHPJSON($value); /* :RECURSION: */
	            else $parts[] = '"' . $key . '":' . convertPHPJSON($value); /* :RECURSION: */
	        } else {
	            $str = '';
	            if(!$is_list) $str = '"' . $key . '":';

	            //Custom handling for multiple data types
	            if(is_numeric($value)) $str .= $value; //Numbers
	            elseif($value === false) $str .= 'false'; //The booleans
	            elseif($value === true) $str .= 'true';
	            else $str .= '"' . addslashes($value) . '"'; //All other things
	            // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

	            $parts[] = $str;
	        }
	    }
	    $json = implode(',',$parts);
	    
	    if($is_list) return '[' . $json . ']';//Return numerical JSON
	    return '{' . $json . '}';//Return associative JSON
	}

	
}

$Tools = new Utilities;
?>