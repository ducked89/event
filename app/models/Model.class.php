<?php

	class Model{
		var $table;
		var $d = array();

		/*
		* Chargement d'une table
		*/

		function __construct()
		{
			# code...
		}

		function chargerTable($name)
		{
			if(file_exists("app/models/".$name.".class.php")){
				require ("app/models/".$name.".class.php");
				return new $name();
			}
			else
			{
				return false;
			}
		}

		function useTable($name)
		{
			$this->table = $name;
		}


		/*
		* Afficher toutes les données de la table
		*/
		function trouverTout($champs=null)
		{
			global $PDO;
			$d = array();
			if($champs == null)
			{
				$champs = " * ";
			}
			$req = $PDO->prepare("SELECT ".$champs." FROM ".$this->table." ORDER BY id DESC");
			try{
				$req->execute(); 
				while ($data = $req->fetch(PDO::FETCH_OBJ)) {
					$d[] = $data;
				}		
			}
			catch (PDOException $e){
				$d[]=null;
			}
			return $d;
		}

		
		function trouverQuantite()
		{
			global $PDO;
			$req = $PDO->prepare("SELECT COUNT(*) as nb FROM ".$this->table);
			try{
				$req->execute(); 
				$data = $req->fetchAll(PDO::FETCH_OBJ);
				$nb = $data[0]->nb;	
			}
			catch (PDOException $e){
				$nb=0;
			}
			return $nb;
		}

		function trouverQuantiteCondition($cond)
		{
			global $PDO;
			$req = $PDO->prepare("SELECT COUNT(*) as nb FROM ".$this->table." WHERE ".$cond);
			try{
				$req->execute(); 
				$data = $req->fetchAll(PDO::FETCH_OBJ);
				$nb = $data[0]->nb;	
			}
			catch (PDOException $e){
				$nb=0;
			}
			return $nb;
		}



		/*
		* Insertion  de données dans une table
		*/
		function ajouter($data)
		{
			global $PDO;
			if($data!=null && !empty($data))
			{

				$req =  "INSERT INTO ".$this->table." (";				
				foreach ($data as $key=>$val) {
					$req .= " $key," ;
				}

				$req = substr($req, 0, -1);
				$req .= ") VALUES (";
				
				foreach ($data as $val) {
					$req .= $val." ," ;
				}
				$req = substr($req, 0, -1);
				$req .= " )";
			
				$req = $PDO->prepare($req);
				try{
					$req->execute($data); 			
					$ajouter =  true;
				}
				catch (PDOException $e){
					$ajouter =  false;
				}
			}
			else
			{
				$ajouter =  false;
			}
			return $ajouter;
		}

		function ajouterContent($data)
		{
			global $PDO;
			if($data!=null && !empty($data))
			{

				$req =  "INSERT INTO ".$this->table." (";				
				foreach ($data as $key=>$val) {
					$req .= " $key," ;
				}

				$req = substr($req, 0, -1);
				$req .= ") VALUES (";
				
				foreach ($data as $val) {
					$req .= $PDO->quote($val)." ," ;
				}
				$req = substr($req, 0, -1);
				$req .= " )";
			
				$req = $PDO->prepare($req);
				try{
					$req->execute($data); 			
					$ajouter =  true;
				}
				catch (PDOException $e){
					$ajouter =  false;
				}
			}
			else
			{
				$ajouter =  false;
			}
			return $ajouter;
		}

		/*
		* Modification de données dans une table
		*/
		function modifier($data)
		{
			global $PDO;
			if(isset($data["id"]) && !empty($data["id"]))
			{
				$exist = $this->trouver(array('conditions'=>' id='.$data["id"]));
				if($exist!=null && isset($exist[0]))
				{
					$req =  "UPDATE ".$this->table." SET ";
					
					foreach ($data as $key => $value) {
						if($key!="id")
						{
							$req .= $key.'='.$PDO->quote($value).' ,' ;
						}
					}

					$req = substr($req, 0, -1);
					$req .= " WHERE id=".$data["id"];
					// print_r($req);
					// die($req);
					$req = $PDO->prepare($req);
					try{
						$req->execute(); 			
						$modifier =  true;
					}
					catch (PDOException $e){
						$modifier = false;
					}

				}
				else
				{
					$modifier = false;
				}
			}
			else{
				$modifier = false;
			}
			return $modifier;
		}



		/*
		* Modification de données dans une table
		*/
		function modifierCondition($data, $cond)
		{
			global $PDO;
			$req =  "UPDATE ".$this->table." SET ";	
			foreach ($data as $key => $value) {
				$req .= $key.'='.$PDO->quote($value).' ,' ;
			}

			$req = substr($req, 0, -1);
			$req .= " WHERE ".$cond;
			// print_r($req);
			// die($req);
			$req = $PDO->prepare($req);
			try{
				$req->execute(); 			
				$modifier =  true;
			}
			catch (PDOException $e){
				$modifier = false;
			}
			return $modifier;
		}

		function modifierViews($id)
		{
			global $PDO;
			if(isset($id) && !empty($id))
			{
				$req =  "UPDATE ".$this->table." SET nbvues = nbvues+1 WHERE id=".$id;
				$req = $PDO->prepare($req);
				try{
					$req->execute(); 			
					$modifier =  true;
				}
				catch (PDOException $e){
					$modifier = false;
				}				
				return $modifier;
			}
		}



		/*
		* Recherche d'un enregistrement dans une table
		*/
		function trouver($datas)
		{
			global $PDO;
			$champs = " * ";
			$conditions = "1=1";
			$conditions2 = "";
			$ordre = " id DESC ";
			$limit = "";
			
			if(isset($datas["champs"])) {$champs = $datas["champs"];}
			if(isset($datas["conditions"])) {$conditions = $datas["conditions"];}
			if(isset($datas["conditions2"])) {$conditions2 = $datas["conditions2"];}
			if(isset($datas["ordre"])) {$ordre = $datas["ordre"];}
			if(isset($datas["limit"])) {$limit = $datas["limit"];}
			
			$req = "SELECT ".$champs." FROM ".$this->table;
			if(isset($conditions2) && !empty($conditions2) && isset($datas["include"])) 
				$req.= " WHERE ".$conditions." ".$conditions2;
			else if(isset($conditions2) && !empty($conditions2) && !isset($datas["include"]))
				$req.= $conditions2." ORDER BY ".$ordre.$limit;
			else  $req.= " WHERE ".$conditions." ORDER BY ".$ordre.$limit;
			$req = $PDO->prepare($req);
			$d = array();
			try{
				$req->execute(); 			
				while ($data = $req->fetch(PDO::FETCH_OBJ)) {
					$d[] = $data;
				}
			}
			catch (PDOException $e){
				$d[]=null;
			}		
			return $d;
		}



		/*
		* Suppression d'un enregistrement dans une table
		*/
		function supprimer($id=null)
		{
			global $PDO;
			if($id==null) 
			{ 
				$id=$this->id; 
			}
			$req = "DELETE FROM ".$this->table." WHERE id=".$id;
			$req = $PDO->prepare($req);
			
			try
			{
				$req->execute(); 			
				return true;
			}
			catch (PDOException $e){
				return false;
			}
		}

		/*
		* Suppression d'un enregistrement dans une table
		*/
		function supprimerCondition($cond=null)
		{
			global $PDO;
			if($cond==null) 
			{ 
				return false;
			}
			$req = "DELETE FROM ".$this->table." WHERE ".$cond;
			$req = $PDO->prepare($req);
			
			try
			{
				$req->execute(); 			
				return true;
			}
			catch (PDOException $e){
				return false;
			}
		}



		/* Difference entre deux dates
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
		

		/*
		* Conversion d'une chaine de chiffre en decimale de 3 chiffres
		*/
		public function convertStringDecimal($num)
		{
			$v=array();
			$j=1;
			// $num = parse_str($num);
			for ($i=strlen($num)-1; $i >=0 ; $i--) { 
				if($j%3==0) $v{$i} = " ".$num{$i};
				else $v{$i} = $num{$i};
				$j++;
			}
			$j="";
			for ($i=0; $i <count($v) ; $i++) { 
				$j .= $v{$i};
			}
			return $j;
		}

	}

 	$Model = new Model;

?>