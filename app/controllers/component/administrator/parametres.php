<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mParametres";
    if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
    {
        $params = $this->datas['params'][0];

        switch ($params) {

            // Editer le nom de compte
            case 'login':
            {
                if(isset($_POST["createLogin"])){
                    extract($_POST);
                    if(!empty($login))
                    {
                        // Verifications des données
                        $Agent = $this->chargerMyModel('Model');
                        $Agent->useTable('users');
                        $check = $Agent->trouver(array(
                            'champs'		=> ' id, login',
                            'conditions'	=> ' id='.$this->iduser.' AND login="'.$this->user->userInfo("login").'"',
                            'limit'			=> ' LIMIT 0, 1'
                            ));

                        // Verification de duplication
                        if(isset($check[0]) && isset($check[0]->id))
                        {
                            if($login!=$check[0]->login)
                            {
                                $saved = $Agent->modifier(array(
                                    'id'		=>$this->iduser,
                                    'login'		=>$login,
                                    'token'		=>sha1($login)
                                ));

                                // Enregistrement effectue
                                if($saved){
                                    $this->redirigerVers($this->direct.'parametres/');
                                }
                                else{
                                    $this->datas['mdatas'] = $_POST;
                                    $this->datas['result'] ="NOTSAVED";
                                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/login',$this->datas);
                                }


                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['result'] ="SAME";
                                $this->chargerViewLayout($this->layout, $this->direct.'parametres/login',$this->datas);
                            }

                        }
                        else{
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['result'] ="EXISTE";
                            $this->chargerViewLayout($this->layout, $this->direct.'parametres/login',$this->datas);
                            // $this->redirigerVers("admin/");
                        }

                    }
                    else{
                        if(empty($login)) 		$this->datas['result'] = "EMPTY";
                        $this->datas['result'] = "EMPTY";
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'parametres/login', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/login',$this->datas);
                }
            }
            break;


            // Editer password
            case 'password':
            {
                if(isset($_POST["createPassword"])){
                    extract($_POST);
                    if(!empty($oldpass) && !empty($password1) && !empty($password2))
                    {

                        if($password1 == $password2){

                            // Verifications des données
                            $Agent = $this->chargerMyModel('Model');
                            $Agent->useTable('users');
                            $check = $Agent->trouver(array(
                                'champs'		=> ' id, password',
                                'conditions'	=> ' id='.$this->iduser.' AND login="'.$this->user->userInfo("login").'" AND password="'.sha1($oldpass).'"',
                                'limit'			=> ' LIMIT 0, 1'
                                ));

                            // Verification de duplication
                            if(isset($check[0]) && isset($check[0]->id))
                            {
                                if(sha1($password2)!=$check[0]->password)
                                {
                                    $saved = $Agent->modifier(array(
                                        'id'			=>$this->iduser,
                                        'password'		=>sha1($password1),
                                        'token'			=>sha1($login)
                                    ));

                                    // Enregistrement effectue
                                    if($saved){
                                        $this->redirigerVers($this->direct.'parametres/');
                                    }
                                    else{
                                        $this->datas['mdatas'] = $_POST;
                                        $this->datas['result'] ="NOTSAVED";
                                        $this->chargerViewLayout($this->layout, $this->direct.'parametres/password',$this->datas);
                                    }


                                }
                                else{
                                    $this->datas['mdatas'] = $_POST;
                                    $this->datas['result'] ="SAME";
                                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/password',$this->datas);
                                }

                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['result'] ="EXISTE";
                                $this->chargerViewLayout($this->layout, $this->direct.'parametres/password',$this->datas);
                                // $this->redirigerVers("admin/");
                            }
                        }
                        else {
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['result'] ="NOTMATCH";
                            $this->chargerViewLayout($this->layout, $this->direct.'parametres/password',$this->datas);
                            // $this->redirigerVers("admin/");
                        }
                    }
                    else{
                        if(empty($login)) 		$this->datas['result'] = "EMPTY";
                        if(empty($password1) || empty($password2) ||
                            empty($password1) != empty($password2) )
                            $this->datas['result'] = "EMPTY";

                        $this->datas['result'] = "EMPTY";
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'parametres/password', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/password',$this->datas);
                }
            }
            break;

            // Changer le login
            case 'connexion':
            {
                if(isset($_POST["createConnexion"]))
                {
                    extract($_POST);
                    // die();

                    // // Verifications des données
                    // $Agent = $this->chargerMyModel('Model');
                    // $Agent->useTable('parametres');
                    // $check = $Agent->trouver(array(
                    // 	'champs'		=> ' id, logintype',
                    // 	'limit'			=> ' LIMIT 0, 1'
                    // 	));

                    // // Verification de duplication
                    // if(isset($check[0]) && isset($check[0]->id))
                    // {
                    // 	if($idlogin!=$check[0]->logintype)
                    // 	{
                    // 		$saved = $Agent->modifierCondition(array(
                    // 			'logintype'		=>$idlogin
                    // 		), ' id!=0');

                    // 		// Enregistrement effectue
                    // 		if($saved){
                    // 			$this->redirigerVers($this->direct.'parametres/');
                    // 		}
                    // 		else{
                    // 			$this->datas['mdatas'] = $_POST;
                    // 			$this->datas['result'] ="NOTSAVED";
                    // 			$this->chargerViewLayout($this->layout, $this->direct.'editlogin',$this->datas);
                    // 		}


                    // 	}
                    // 	else{
                    // 		$this->datas['mdatas'] = $_POST;
                    // 		$this->datas['result'] ="SAME";
                    // 		$this->chargerViewLayout($this->layout, $this->direct.'editlogin',$this->datas);
                    // 	}

                    // }
                    // else{
                    // 	$this->datas['mdatas'] = $_POST;
                    // 	$this->datas['result'] ="EXISTE";
                    // 	$this->chargerViewLayout($this->layout, $this->direct.'editlogin',$this->datas);
                    // 	// $this->redirigerVers("admin/");
                    // }



                    $this->redirigerVers("administrator/parametres/");

                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/editlogin',$this->datas);
                }
            }
            break;

            // Upload banner image
            case 'banner':
            {
                if(isset($_POST["uploadBanner"]))
                {

                    // an array of allowed extensions
                    $file = $_FILES["photo"]["name"];
                    $type = $_FILES["photo"]["type"];
                    $taille = $_FILES["photo"]["size"];
                    $temp = $_FILES["photo"]["tmp_name"];
                    $error = $_FILES["photo"]["error"];
                    $ext = strtolower(substr($_FILES["photo"]["name"], -3));
                    $allowedExts = array('jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF');

                    //Verification du telechargement du fichier
                    if($error==UPLOAD_ERR_OK){

                       // Check Extention
                        if(in_array($ext, $allowedExts)){

                            // Check size
                            if($taille<=1048576){
                                if ($_FILES["photo"]["error"] > 0)
                                {
                                  $this->datas['error']['upload'] = "Oups ! Une erreur s'est produite dans le chargement. Veuillez ré-essayer";
                                  $this->chargerViewLayout($this->layout, $this->direct.'parametres/banner', $this->datas);
                                }
                                else {
                                    $directory = "public/images/";
                                    $filename = "utebanner.".$ext;
                                    $destination = getcwd().DIRECTORY_SEPARATOR;
                                    $target = $destination . $directory . basename($filename);
                                    @move_uploaded_file($_FILES['photo']['tmp_name'], $target);

                                    $Agent = $this->chargerMyModel('Model');
                                    $Agent->useTable("parametres");
                                    $Agent->modifierCondition(array('banner'=>$filename), ' 1=1');
                                    $this->redirigerVers("administrator/parametres/");

                                }
                            }
                            else
                            {

                                $this->datas['error']['size'] = "Le poids du fichier est trop lourd (pour un slide, max 1MB).";
                                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/banner', $this->datas);
                            }
                        }
                        else{
                              $this->datas['error']['format'] = "Le format du fichier n'est pas valide (.JPG, .PNG, .GIF).";
                                  $this->chargerViewLayout($this->layout, $this->direct.'parametres/banner', $this->datas);
                            }
                   }
                   else
                    {
                      $this->datas['error']['error'] = "Impossible de telecharger ce fichier. Veuillez verifier re-essayer ou contactez votre administrateur.";
                      $this->chargerViewLayout($this->layout, $this->direct.'parametres/banner', $this->datas);
                  }
                }
                else {
                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/banner',$this->datas);
                }

            }
            break;

            // Upload banner image
            case 'logo':
            {
                if(isset($_POST["uploadLogo"]))
                {

                    // an array of allowed extensions
                    $file = $_FILES["photo"]["name"];
                    $type = $_FILES["photo"]["type"];
                    $taille = $_FILES["photo"]["size"];
                    $temp = $_FILES["photo"]["tmp_name"];
                    $error = $_FILES["photo"]["error"];
                    $ext = strtolower(substr($_FILES["photo"]["name"], -3));
                    $allowedExts = array('jpg', 'png', 'gif', 'JPG', 'PNG', 'GIF');

                    //Verification du telechargement du fichier
                    if($error==UPLOAD_ERR_OK){

                       // Check Extention
                        if(in_array($ext, $allowedExts)){

                            // Check size
                            if($taille<=1048576){
                                if ($_FILES["photo"]["error"] > 0)
                                {
                                  $this->datas['error']['upload'] = "Oups ! Une erreur s'est produite dans le chargement. Veuillez ré-essayer";
                                  $this->chargerViewLayout($this->layout, $this->direct.'parametres/banner', $this->datas);
                                }
                                else {
                                    $directory = "public/images/";
                                    $filename = "utelogo.".$ext;
                                    $destination = getcwd().DIRECTORY_SEPARATOR;
                                    $target = $destination . $directory . basename($filename);
                                    @move_uploaded_file($_FILES['photo']['tmp_name'], $target);

                                    $Agent = $this->chargerMyModel('Model');
                                    $Agent->useTable("parametres");
                                    $Agent->modifierCondition(array('logo'=>$filename), ' 1=1');
                                    $this->redirigerVers("administrator/parametres/");

                                }
                            }
                            else
                            {

                                $this->datas['error']['size'] = "Le poids du fichier est trop lourd (pour un slide, max 1MB).";
                                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/logo', $this->datas);
                            }
                        }
                        else{
                              $this->datas['error']['format'] = "Le format du fichier n'est pas valide (.JPG, .PNG, .GIF).";
                                  $this->chargerViewLayout($this->layout, $this->direct.'parametres/logo', $this->datas);
                            }
                   }
                   else
                    {
                      $this->datas['error']['error'] = "Impossible de telecharger ce fichier. Veuillez verifier re-essayer ou contactez votre administrateur.";
                      $this->chargerViewLayout($this->layout, $this->direct.'parametres/logo', $this->datas);
                  }
                }
                else {
                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/logo',$this->datas);
                }

            }
            break;

            // Editer le nom de compte
            case 'info':
            {
                $Agent = $this->chargerMyModel('Model');
                $Agent->useTable("parametres");
                $found = $Agent->trouverTout();
                $this->datas['site']=$found[0];

                if(isset($_POST["changeInfo"])){
                    extract($_POST);
                    if(!empty($login) && !empty($accueil) && !empty($contact1) && !empty($contact2) && !empty($notice))
                    {
                        $Agent->useTable("parametres");
                        $saved = $Agent->modifierCondition(array(
                            'login'		=>$login,
                            'accueil'	=>$accueil,
                            'contact1'	=>$contact1,
                            'contact2'	=>$contact2,
                            'notice'	=>$notice
                        ), ' 1=1');

                        // Enregistrement effectue
                        if($saved){
                            $this->redirigerVers($this->direct.'parametres/');
                        }
                        else{
                            $this->datas['site']=(object)($_POST);
                            // var_dump($_POST); die();
                            $this->datas['error']['saved'] = true;
                            $this->chargerViewLayout($this->layout, $this->direct.'parametres/siteinfo',$this->datas);
                        }

                    }
                    else{
                        if(empty($login)) 		$this->datas['error']['login'] = true;
                        if(empty($accueil)) 	$this->datas['error']['accueil'] = true;
                        if(empty($contact1)) 	$this->datas['error']['contact1'] = true;
                        if(empty($contact2)) 	$this->datas['error']['contact2'] = true;
                        if(empty($notice)) 	$this->datas['error']['notice'] = true;
                        $this->datas['site']=(object)($_POST);
                            var_dump($_POST); die();
                        $this->chargerViewLayout($this->layout, $this->direct.'parametres/siteinfo', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/siteinfo',$this->datas);
                }
            }
            break;

            // Editer le nom de compte
            case 'config':
            {
                $Agent = $this->chargerMyModel('Model');
                $Agent->useTable("mailconfig");
                $this->datas['mdatas'] = $Agent->trouverTout();

                if(isset($_POST["saveConfing"])){
                    extract($_POST);
                    if(!empty($host) && !empty($username) && !empty($password) && !empty($smtpsecure) && !empty($smtpsecure))
                    {
                        // Verifications des données
                        if($password==$password2)
                        {
                            $Agent = $this->chargerMyModel('Model');
                            $Agent->useTable('parametres');
                            $saved = $Agent->modifierCondition(array(
                                'host'			=>$host,
                                'username'		=>$username,
                                'password'		=>$password,
                                'smtpsecure'	=>$smtpsecure,
                                'port'			=>$port
                            ), ' 1=1');

                            // Enregistrement effectue
                            if($saved){
                                $this->redirigerVers($this->direct.'parametres/');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] = true;
                                $this->chargerViewLayout($this->layout, $this->direct.'parametres/login',$this->datas);
                            }
                        }
                        else{
                            $this->datas['error']['password'] = true;
                            $this->datas['mdatas'] = $_POST;
                            $this->chargerViewLayout($this->layout, $this->direct.'parametres/login', $this->datas);
                        }
                    }
                    else{
                        if(empty($host)) 	$this->datas['error']['host'] = true;
                        if(empty($username)) 	$this->datas['error']['username'] = true;
                        if(empty($password) || empty($password2)) 	$this->datas['error']['password'] = true;
                        if(empty($host)) 	$this->datas['error']['host'] = true;
                        if(empty($smtp)) 	$this->datas['error']['smtp'] = true;
                        if(empty($port)) 	$this->datas['error']['port'] = true;
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'parametres/configmail', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'parametres/configmail',$this->datas);
                }
            }
            break;

            default:
                $this->redirigerVers("administrator/parametres/");
            break;
        }
    }
    else
    {
        $this->chargerViewLayout($this->layout, $this->direct.'parametres/index', $this->datas);
    }
}

?>
