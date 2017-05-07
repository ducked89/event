<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mAccounts";
    if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
    {
        $params = $this->datas['params'][0];

        switch ($params) {

            // Ajouter
            case 'add':
            {
                $Agent = $this->chargerMyModel('User');
                $Agent->useTable('roles');
                $this->datas['roles'] = $Agent->trouver(null);

                $Agent->useTable("employes");
                $this->datas['employes'] = $Agent->trouver(array(
                    'champs'	=>'id, lastname, firstname',
                    'conditions'=>' iduser is NULL'));
                if(isset($_POST["createUser"])){

                    extract($_POST);
                    if(!empty($login) && !empty($password1) && !empty($password2))
                    {
                        // Verifications des données
                        $Agent = $this->chargerMyModel('Model');
                        $Agent->useTable('users');
                        $check = $Agent->trouver(array(
                            'champs'		=> ' id ',
                            'conditions'	=> ' login="'.$login.'"',
                            'limit'			=> ' LIMIT 0, 1'
                            ));

                        // Verification de duplication
                        if(!isset($check[0]) && !isset($check[0]->id))
                        {

                            $saved = $Agent->ajouterContent(array(
                                'login'			=>$login,
                                'password'		=>sha1($password1),
                                'token'			=>sha1($login),
                                'datecreated'	=>date("Y-m-d H:i:s"),
                                'roleid'		=>2,
                                'status'		=>0
                            ));

                            // Enregistrement effectue
                            if($saved){

                                $Agent->useTable('users');
                                $check = $Agent->trouver(array(
                                    'champs'		=> ' id ',
                                    'conditions'	=> ' login="'.$login.'"',
                                    'limit'			=> ' LIMIT 0, 1'
                                    ));

                                $Agent->useTable('employes');
                                $updateEmp = $Agent->modifier(array(
                                    'id'			=>$account,
                                    'iduser'		=> $check[0]->id
                                    ));

                                $this->redirigerVers($this->direct.'accounts/index');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] =true;
                                $this->chargerViewLayout($this->layout, $this->direct.'accounts/add',$this->datas);
                            }
                        }
                        else{
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['error']['existe'] =true;
                            $this->chargerViewLayout($this->layout, $this->direct.'accounts/add',$this->datas);
                            // $this->redirigerVers("admin/");
                        }
                    }
                    else{
                        if(empty($login)) 		$this->datas['error']['login'] 		= true;
                        if(empty($password1) || empty($password2) ||
                            empty($password1) != empty($password2) )
                            $this->datas['error']['password'] 	= true;

                        $this->datas['error']['error'] =true;
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'accounts/add', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'accounts/add',$this->datas);
                }
            }
            break;

            // Editer password
            case 'password':
            {
                $this->datas['istitle'] = "Editer mot de passe";
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                {
                    if(isset($_POST['cuPassword']) && $_POST['iduser']==$_GET['idu'])
                    {
                        if($_POST['password1'] == $_POST['password2'] ){
                            $Agent = $this->chargerMyModel("User");
                            $Agent->useTable("users");
                            $found = $Agent->modifier(array(
                                'id'=>$_POST['iduser'],
                                'password'=>sha1($_POST['password2'])
                                ));
                            $this->datas['result']="DONE";
                        }
                        else {
                            $this->datas['result']="NOTMATCH";

                        }
                    }

                        // echo "elsE";
                        $idu = $_GET['idu'];
                        $Agent = $this->chargerMyModel("User");
                        $Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser");

                        $found = $Agent->trouver(array(
                            'champs'	=>'users.id, users.login, employes.lastname, employes.firstname, employes.photo, employes.email, employes.phone',
                            'conditions'	=> ' users.id= '.$idu));

                        if(isset($found[0]->id))
                        {
                            $this->datas['mdatas'] = get_object_vars($found[0]);
                        }
                        else $this->redirigerVers("administrator/accounts/");

                    $this->chargerViewLayout($this->layout, $this->direct.'accounts/password', $this->datas);
                }
                else{
                    $this->redirigerVers("administrator/accounts/");
                    }
            }
            break;

            // Edition
            case 'edit':
            {

                if(
                    (isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu'])) ||
                    (isset($_POST['idu']) && preg_match("/^[0-9]+$/i", $_POST['idu'])) )

                    {
                        $idu = $_GET['idu'];
                        if(isset($_POST['idu'])) $idu = $_POST['idu'];

                        $Agent = $this->chargerMyModel("User");
                        $Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser");
                        $found = $Agent->trouver(array(
                                'champs'	=>' users.id, users.login, users.status, employes.lastname, employes.firstname, employes.photo, employes.email, employes.phone ',
                                'conditions'	=> ' users.id= '.$idu));
                        // var_dump($found);
                        // die();

                        if(isset($found[0]->id))
                        {
                            $this->datas['mdatas'] = get_object_vars($found[0]);
                            $this->datas['users'] = $found[0];
                            if(isset($_POST["saveUser"]))
                            {

                                extract($_POST);
                                if(!empty($login))
                                {
                                    // Verifications des données
                                    $Agent = $this->chargerMyModel('Model');
                                    $Agent->useTable('users');
                                    $check = $Agent->trouver(array(
                                        'champs'		=> ' id ',
                                        'conditions'	=> ' id='.$id,
                                        'limit'			=> ' LIMIT 0, 1'
                                        ));

                                    // Verification de duplication
                                    if(isset($check[0]) && isset($check[0]->id))
                                    {

                                        $saved = $Agent->modifier(array(
                                            'id'			=>$idu,
                                            'login'			=>$login,
                                            'roleid'		=>2,
                                            'status'		=>$status
                                        ));

                                        // Enregistrement effectue
                                        if($saved){
                                            $this->redirigerVers($this->direct.'accounts/');
                                        }
                                        else{
                                            $this->datas['mUserTemp'] = $_POST;
                                            $this->datas['error']['notsaved'] =true;
                                            $this->chargerViewLayout($this->layout, $this->direct.'accounts/edit',$this->datas);
                                        }
                                    }
                                    else{
                                        $this->datas['mUserTemp'] = $_POST;
                                        $this->datas['error']['existe'] =true;
                                        $this->chargerViewLayout($this->layout, $this->direct.'accounts/edit',$this->datas);
                                        // $this->redirigerVers("admin/");
                                    }
                                }
                                else{
                                    if(empty($login)) $this->datas['error']['login'] 		= true;
                                    $this->datas['error']['error'] =true;
                                    $this->datas['mUserTemp'] = $_POST;
                                    $this->chargerViewLayout($this->layout, $this->direct.'accounts/edit', $this->datas);
                                    // $this->redirigerVers("admin/");
                                }
                                $_POST = array();
                            }
                            else $this->chargerViewLayout($this->layout, $this->direct.'accounts/edit',$this->datas);
                        }
                        else $this->redirigerVers("administrator/accounts/");
                }
                else $this->redirigerVers("administrator/accounts/");
            }
            break;

            // Desactiver un compte
            case 'disable':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                {
                    $idu = $_GET['idu'];

                    $Agent = $this->chargerMyModel('User');
                    $found = $Agent->trouver(array('champs'=>'id', 'conditions'	=> ' id= '.$idu));

                    if(isset($found[0]->id))
                    {
                        $found = $Agent->modifier(array(
                            'id'	=> $idu,
                            'status'=>0));
                    }
                    $this->redirigerVers("administrator/accounts/");
                }
                else{
                    $this->redirigerVers("administrator/accounts/");
                }
            }
            break;

            // Activer un compte
            case 'enable':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                {
                    $idu = $_GET['idu'];

                    $Agent = $this->chargerMyModel('User');
                    $found = $Agent->trouver(array('champs'=>'id','conditions'	=> ' id= '.$idu));
                    if(isset($found[0]->id))
                    {
                        $found = $Agent->modifier(array(
                            'id'	=> $idu,
                            'status'=>1));

                    }
                    $this->redirigerVers("administrator/accounts/");
                }
                else{
                    $this->redirigerVers("administrator/accounts/");
                }
            }
            break;

            // Desactiver tous les comptes
            case 'desactivate':
            {
                if(isset($_POST['opt']) && $_POST['opt']==0)
                {
                    $Agent = $this->chargerMyModel('User');
                    $found = $Agent->modifierCondition(array('status'=>0), ' roleid != 1');
                    $this->redirigerVers("administrator/accounts/");
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'accounts/desactivateconfirm', $this->datas);
                }
            }
            break;

            // Desactiver tous les comptes
            case 'activate':
            {
                if(isset($_POST['opt']) && $_POST['opt']==1)
                {
                    $Agent = $this->chargerMyModel('User');
                    $found = $Agent->modifierCondition(array('status'=>1), ' roleid != 1');
                    $this->redirigerVers("administrator/accounts/");
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'accounts/activateconfirm', $this->datas);
                }
            }
            break;

            // Voir profile employe
            case 'view':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                {
                    $idu = $_GET['idu'];
                    $this->redirigerVers("administrator/organizers/view/?idu=".$idu);
                }
                else $this->redirigerVers("administrator/accounts/");
            }
            break;

            default:
                $this->redirigerVers("administrator/accounts/");
            break;
        }
    }
    else
    {
        $Agent = $this->chargerMyModel('Model');
        $Agent->useTable(" users LEFT JOIN employes ON users.id = employes.iduser ");
        $this->datas['users'] = $Agent->trouver(array(
            'champs'=>'users.id, employes.id as empid, login, roleid, users.datecreated, lastattempts,status ',
            'ordre'=>'login ASC'));

        // Chek last connexion
        $Agent->useTable("connexionlog");
        $mLogs = $Agent->trouverTout();
        //$mLogs = $Agent->trouver(array('champs'=>'iduser, MAX(connexiondate)','conditions'=>'GROUP BY iduser'));

        //SELECT iduser, max(connexiondate) FROM utedb.connexionlog group by iduser;
        if(isset($mLogs[0]))
        {
            $i=0;
            foreach ($this->datas['users'] as $tempUser) {
                foreach ($mLogs as $mLog) {
                    if($mLog->iduser == $tempUser->id)
                        $this->datas['users'][$i]->lastattempts = $mLog->connexiondate;
                    else $this->datas['users'][$i]->lastattempts="Inconnu";
                }
                $i++;
            }
        }

        // Check user type
        $Agent->useTable("roles");
        $this->datas['types'] = $Agent->trouverTout();
        $this->chargerViewLayout($this->layout, $this->direct.'accounts/index', $this->datas);

    }
}

?>
