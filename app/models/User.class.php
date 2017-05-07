<?php

class User extends Model
{

	function __construct(){
		$this->table="users";
	}



		/*
		* Permet d'identifier un utilisateur updateUserSession
		*/
		function loginUser($da){
			global $PDO;
			$req = $PDO->prepare("SELECT users.id, users.login, users.roleid, users.firstlogin, employes.lastname, employes.firstname, employes.photo, employes.sex , employes.phone, employes.email, employes.position, employes.adresse, employes.extension FROM users LEFT JOIN employes ON users.id = employes.iduser
				WHERE users.login=:connectname AND users.password=:connectpass AND users.status=1 LIMIT 1");

				try{
					$req->execute($da);
					$data = $req->fetchAll();
					if(count($data)>0){

						$req = $PDO->prepare("SELECT roles.id, roles.name, roles.level  FROM roles WHERE id = ".$data[0]->roleid);
						$req->execute();
						$temp = $req->fetchAll();

						$_SESSION['Auth'] = $data[0];
						$_SESSION['Auth']->name=$temp[0]->name;
						$_SESSION['Auth']->level=$temp[0]->level;
						$_SESSION['Auth']->timeout = date("H:i:s");

						return true;
					}
					else{
						return false;
					}
				}
				catch (PDOException $e){
					return false;
				}
		}

        /*
		* Mise a jour des informations dans la session
		*/

		function setSessTimeout($dat)
		{
			global $PDO;
			$req = $PDO->prepare("INSERT INTO connexionlog (iduser, ipaddress, browser, connexiondate) VALUES (:iduser, :ipaddress, :browser, :connexiondate)");
			// print_r($req);
			try{
				$req->execute($dat);
				return true;
			}
			catch (PDOException $e){
				return false;
			}
		}

		function updateUserSession($da){
			global $PDO;
			$req = $PDO->prepare("SELECT users.id, users.login, users.roleid, users.firstlogin, users.notice, employes.lastname, employes.firstname, employes.photo, employes.sex , employes.phone, employes.email, employes.position, employes.adresse, employes.extension FROM users LEFT JOIN employes ON users.id = employes.iduser
				WHERE users.id=:id LIMIT 1" );


			try{
				$req->execute($da);
				$data = $req->fetchAll();

				$req2 = $PDO->prepare("SELECT MAX(connexiondate) AS timeout FROM connexionlog WHERE iduser=".$data[0]->id);

				$req2->execute();
				$data2 = $req2->fetch();

				if(count($data)>0){
					$_SESSION['Auth'] = $data[0];
					$_SESSION['Auth']->timeout = $data2->timeout;
				}
			}
			catch (PDOException $e){
			}
		}

		/*
		* Autorise un rang a acceder a une page, redirige vers forbiden sion
		*/
		function allowUser($rang){
			global $PDO;
			$req = $PDO->prepare("SELECT name, level FROM roles");
			try{
				$req->execute();
				$data = $req->fetchAll();
				$roles = array();
				foreach ($data as $d) {
					$roles[$d->name] = $d->level;
				}

				if(!$this->userInfo('name')){
					$this->forbiden();
				}
				else{
					if($roles[$rang] !=$this->userInfo('level')){
						$this->refused();
					}
				}
			}
			catch (PDOException $e){
				return false;
			}
		}


		/*
		*Recupere une info utilisateur
		*/
		function userInfo($info){
			if(isset($_SESSION['Auth']->$info)){
				return $_SESSION['Auth']->$info;
			}
			else{
				return false;
			}
		}

		/*
		*Recupere lien profil reseau social
		*/
		function userSocial($social){
			global $PDO;
			$req = $PDO->prepare("SELECT $social FROM employes WHERE iduser=".$this->userInfo('id'));
			try{
				$req->execute();
				$data = $req->fetch();

				if(isset($data->$social)){
					return $data->$social;
				}
				else{
					return "";
				}
			}
			catch (PDOException $e){
				return "";
			}
		}


		/*
		* Permet de retourner la liste complete des utilisateur
		*/
		function usersList($da){
			return $this->trouverTout();
		}

		/*
		* Permet a un utilisateur de publier un lyric
		*/
		function publierLyric($da){
			return true;
		}

		/*
		* trouver un utilisateur via des parametres
		*/
		function userExist($mid=null, $mlogin=null)
		{
			global $PDO;
			if($mid==null) $conds="login='".$mlogin."'";
			else $conds="id=".$mid." OR login='".$mlogin."'";
			$param = array(
				'champs'=>'id',
				'conditions'=>$conds
				);

			try{
				if($this->trouver($param)!=null){
					return true;
				}
				else{ return false; }
			}
			catch (PDOException $e){
				return false;
			}
		}


		/*
		* Fermer compte user
		*/
		function closeUser($mid, $mlogin)
		{
			global $PDO;
			$param = array(
				'champs'=>'id',
				'conditions'=> 'id='.$mid.' AND login="'.$mlogin.'"'
				);

			try{
				if($this->trouver($param)){
					$req = $PDO->prepare("UPDATE users SET activated = 0 WHERE login='".$mlogin."'");
					$_SESSION['Auth']=null;
					return true;
				}
				else{ return false; }
			}
			catch (PDOException $e){
				return false;
			}
		}

		/*
		* Reactiver compte user
		*/
		function resetUser($mlogin, $mPass)
		{
			global $PDO;
			$param = array(
				'champs'=>'id',
				'conditions'=> 'login="'.$mlogin.'" AND password="'.$mPass.'"'
				);

			try{
				if($this->trouver($param)!=null){
					$req = $PDO->prepare("UPDATE users SET activated = 1 WHERE login='".$mlogin."'");
					$req->execute();
					return true;
				}
				else{ return false; }
			}
			catch (PDOException $e){
				return false;
			}
		}



	}
	$User = new User();
	?>
