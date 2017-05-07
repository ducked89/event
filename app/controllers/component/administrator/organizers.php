<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mEmployes";
    if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
    {
        $params = $this->datas['params'][0];

        switch ($params) {
            // Ajouter
            case 'add':
            {
                if(isset($_POST["createEmploye"])){

                    extract($_POST);
                    if(!empty($nom) && !empty($prenom) && !empty($phone) && !empty($poste))
                    {
                        // Verifications des données
                        $Agent = $this->chargerMyModel('Model');
                        $Agent->useTable('employes');
                        $check = $Agent->trouver(array(
                            'champs'		=> ' id ',
                            'conditions'	=> ' lastname="'.$nom.'" AND firstname="'.$prenom.'"',
                            'limit'			=> ' LIMIT 0, 1'
                            ));

                        // Verification de duplication
                        if(!isset($check[0]) && !isset($check[0]->id))
                        {

                            $saved = $Agent->ajouterContent(array(
                                'idservice'		=>$service,
                                'lastname'		=>$nom,
                                'firstname'		=>$prenom,
                                'sex'			=>$sexe,
                                'email'			=>$email,
                                'phone'			=>$phone,
                                'adresse'		=>$adresse,
                                'extension'		=>$extension,
                                'position'		=>$poste
                            ));
                            // var_dump($saved);
                            // die();

                            // Enregistrement effectue
                            if($saved){
                                $this->redirigerVers($this->direct.'organizers/');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] =true;
                                $this->chargerViewLayout($this->layout, $this->direct.'organizers/add',$this->datas);
                            }
                        }
                        else{
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['error']['existe'] =true;
                            $this->chargerViewLayout($this->layout, $this->direct.'organizers/add',$this->datas);
                            // $this->redirigerVers("admin/");
                        }
                    }
                    else{
                        if(empty($nom)) $this->datas['error']['nom'] = true;
                        if(empty($prenom)) $this->datas['error']['prenom'] = true;
                        if(empty($phone)) $this->datas['error']['phone'] = true;
                        if(empty($poste)) $this->datas['error']['poste'] = true;
                        $this->datas['error']['error'] =true;
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'organizers/add', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $Agent = $this->chargerMyModel('Model');
                    $Agent->useTable("profiltypes");
                    $this->datas['services'] = $Agent->trouver(array('ordre'=>' title ASC'));

                    $this->chargerViewLayout($this->layout, $this->direct.'organizers/add',$this->datas);
                }
            }
            break;

            // Edition
            case 'edit':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                    {
                        $idu = $_GET['idu'];
                        if(isset($_POST["saveEmploye"])){

                            extract($_POST);
                            if(!empty($nom) && !empty($prenom) && !empty($phone) && !empty($poste) )
                            {
                                // Verifications des données
                                $Agent = $this->chargerMyModel('Model');
                                $Agent->useTable('employes');
                                $check = $Agent->trouver(array(
                                    'champs'		=> ' id ',
                                    'conditions'	=> ' id='.$idu,
                                    'limit'			=> ' LIMIT 0, 1'
                                    ));

                                // Verification de duplication
                                if(isset($check[0]) && isset($check[0]->id))
                                {

                                    $saved = $Agent->modifier(array(
                                        'id'			=>$idu,
                                        'idservice'		=>$service,
                                        'lastname'		=>$nom,
                                        'firstname'		=>$prenom,
                                        'sex'			=>$sexe,
                                        'email'			=>$email,
                                        'phone'			=>$phone,
                                        'adresse'		=>$adresse,
                                        'extension'		=>$extension,
                                        'position'		=>$poste
                                    ));
                                    // var_dump($saved);
                                    // die();

                                    // Enregistrement effectue
                                    if($saved){
                                        $this->redirigerVers($this->direct.'organizers/');
                                    }
                                    else{
                                        $this->datas['mdatas'] = $_POST;
                                        $this->datas['error']['notsaved'] =true;
                                        $this->chargerViewLayout($this->layout, $this->direct.'organizers/edit',$this->datas);
                                    }
                                }
                                else{
                                    $this->datas['mdatas'] = $_POST;
                                    $this->datas['error']['existe'] =true;
                                    $this->chargerViewLayout($this->layout, $this->direct.'organizers/edit',$this->datas);
                                    // $this->redirigerVers("admin/");
                                }
                            }
                            else{
                                if(empty($nom)) $this->datas['error']['nom'] = true;
                                if(empty($prenom)) $this->datas['error']['prenom'] = true;
                                if(empty($phone)) $this->datas['error']['phone'] = true;
                                if(empty($poste)) $this->datas['error']['poste'] = true;
                                $this->datas['error']['error'] =true;
                                $this->datas['mdatas'] = $_POST;
                                $this->chargerViewLayout($this->layout, $this->direct.'organizers/edit', $this->datas);
                                // $this->redirigerVers("admin/");
                            }
                            $_POST = array();
                        }
                        else{
                            $Agent = $this->chargerMyModel("User");
                            $Agent->useTable("employes");
                            $found = $Agent->trouver(array('conditions'	=> ' id= '.$idu));

                            if(isset($found[0]->id))
                            {
                                $this->datas['mdatas'] = get_object_vars($found[0]);
                                $this->datas['employes'] = $found[0];
                                if(!empty($this->datas['employes']->id))
                                $Agent->useTable("profiltypes");
                                $this->datas['services'] = $Agent->trouverTout();
                                $this->chargerViewLayout($this->layout, $this->direct.'organizers/edit',$this->datas);
                            }
                            else{
                                $this->redirigerVers("administrator/organizers/");
                            }
                        }
                    }
                    else{
                        $this->redirigerVers("administrator/organizers/");
                    }
            }
            break;

            // Voir profile employe
            case 'view':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                    {
                        $idu = $_GET['idu'];
                        $Agent = $this->chargerMyModel("User");
                        $Agent->useTable("employes");
                        $found = $Agent->trouver(array('conditions'	=> ' id= '.$idu));

                        if(isset($found[0]->id))
                        {
                            $this->datas['mdatas'] = get_object_vars($found[0]);
                            $this->datas['employes'] = $found[0];

                            if(!empty($this->datas['employes']->iduser))
                            {
                                $Agent->useTable("users");
                                $this->datas['employes']->user = $Agent->trouver(array(
                                    'champs'=>'id, login, status, lastattempts, roleid,datecreated',
                                    'conditions'=>' id='.$this->datas['employes']->iduser
                                    ));

                                $Agent->useTable("roles");
                                $this->datas['employes']->role = $Agent->trouver(array(
                                    'champs'=>'description',
                                    'conditions'=>' id='.$this->datas['employes']->user[0]->roleid
                                    ));
                            }
                            if(!empty($this->datas['employes']->idservice)
                                && $this->datas['employes']->idservice!=null)
                                {
                                    $Agent->useTable("profiltypes");
                                    $this->datas['employes']->service = $Agent->trouver(array(
                                        'champs'=>'title, description',
                                        'conditions'=>' id='.$this->datas['employes']->idservice
                                        ));
                                }

                            $this->chargerViewLayout($this->layout, $this->direct.'organizers/view',$this->datas);
                        }
                        else{
                            $this->redirigerVers("administrator/organizers/");
                        }
                    }
                    else{
                        $this->redirigerVers("administrator/organizers/");
                    }
            }
            break;


            // Upload diaporama image
            case 'photo':
            {
                if( (isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']) ) || (isset($_POST['idu']) && preg_match("/^[0-9]+$/i", $_POST['idu'])) )
                {
                    if(isset($_GET['idu'])) $idu=$_GET['idu'];
                    if(isset($_POST['idu'])) $idu=$_POST['idu'];

                    $this->datas['idu'] = $idu;
                    // Verifications des données
                    $Agent = $this->chargerMyModel('Model');
                    $Agent->useTable('employes');
                    $this->datas['employes'] = $Agent->trouver(array('conditions'=>'id='.$idu));
                    $this->datas['employes'] = $this->datas['employes'][0];

                    if(isset($_POST["uploadphoto"]))
                    {

                        // an array of allowed extensions
                        $idu = $_POST['idu'];
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
                                      $this->chargerViewLayout($this->layout, $this->direct.'organizers/photo', $this->datas);
                                    }
                                    else {
                                        $directory = "public/images/profiles/";
                                        $filename = "employe_".$idu.'_'.date("Y").date("m").date("d").'_'.date("H").date("i").date("s").'.'.$ext;
                                        $Agent->useTable('employes');
                                        $employe = $Agent->trouver(array('conditions'=>'id='.$idu));

                                        if(isset($employe[0]->id)){

                                            $saved = $Agent->modifier(array(
                                            'id'=>$idu,
                                            'photo'=>$filename
                                            ));
                                            if($saved){
                                                // move_uploaded_file($temp, $target.$filename);
                                                $destination = getcwd().DIRECTORY_SEPARATOR;
                                                if(!empty($employe[0]->photo)) unlink($destination . $directory .$employe[0]->photo);
                                                unlink($directory.$employe[0]->photo);
                                                $target = $destination . $directory . basename($filename);
                                                @move_uploaded_file($_FILES['photo']['tmp_name'], $target);
                                                $this->redirigerVers("administrator/organizers/");
                                            }
                                            else {
                                                $this->datas['error'] = "Il n'existe pas d'employe avec ce id.";
                                                $this->chargerViewLayout($this->layout, $this->direct.'organizers/photo', $this->datas);
                                            }
                                        }
                                        else {
                                                $this->datas['error'] = "Il n'existe pas d'employe avec ce id.";
                                                $this->chargerViewLayout($this->layout, $this->direct.'organizers/photo', $this->datas);
                                            }
                                    }
                                }
                                else
                                {

                                    $this->datas['error']['size'] = "Le poids du fichier est trop lourd (pour un slide, max 1MB).";
                                    $this->chargerViewLayout($this->layout, $this->direct.'organizers/photo', $this->datas);
                                }
                            }
                            else{
                                  $this->datas['error']['format'] = "Le format du fichier n'est pas valide (.JPG, .PNG, .GIF).";
                                      $this->chargerViewLayout($this->layout, $this->direct.'organizers/photo', $this->datas);
                                }
                       }
                       else
                        {
                          $this->datas['error']['error'] = "Impossible de telecharger ce fichier. Veuillez verifier re-essayer ou contactez votre administrateur.";
                          $this->chargerViewLayout($this->layout, $this->direct.'organizers/photo', $this->datas);
                      }
                    }
                    else {
                        $this->chargerViewLayout($this->layout, $this->direct.'organizers/photo',$this->datas);
                    }
                }
                else $this->redirigerVers("administrator/organizers/");
            }
            break;


            // Exporter les donnees en format XLS, DOC, PDF
            case 'export':
            {
                $Agent = $this->chargerMyModel('Model');
                $Agent->useTable("employes");
                $this->datas['employes'] = $Agent->trouver(array('ordre'=>' firstname ASC'));

                $i =0;
                foreach ($this->datas['employes'] as $memploye) {
                    if(!empty($memploye->iduser)){
                        $Agent->useTable("users");
                        $tememploye = $Agent->trouver(array(
                            'champs'		=>'id, login ',
                            'conditions'=> ' id ='.$memploye->iduser));
                        $this->datas['employes'][$i]->compte=$tememploye[0];
                        }
                    if(!empty($memploye->idservice) && $memploye->idservice!=null)
                    {
                        $Agent->useTable("profiltypes");
                        $tememploye = $Agent->trouver(array(
                            'champs'=>'title, description',
                            'conditions'=>' id='.$memploye->idservice
                            ));
                        $this->datas['employes'][$i]->service=$tememploye[0];

                    }
                    $i++;
                }
                $this->chargerViewLayout($this->layout, $this->direct.'organizers/export', $this->datas);
            }
            break;

            default:
                $this->redirigerVers("administrator/organizers/");
            break;
        }
    }
    else
    {
        $Agent = $this->chargerMyModel('Model');
        $Agent->useTable("employes");
        $this->datas['employes'] = $Agent->trouver(array('ordre'=>' firstname ASC'));

        $i =0;
        foreach ($this->datas['employes'] as $memploye) {
            if(!empty($memploye->iduser)){
                $Agent->useTable("users");
                $tememploye = $Agent->trouver(array(
                    'champs'		=>'id, login ',
                    'conditions'=> ' id ='.$memploye->iduser));
                $this->datas['employes'][$i]->compte=$tememploye[0];
            }

            if(!empty($memploye->idservice)){
                $Agent->useTable("profiltypes");
                $tememploye = $Agent->trouver(array(
                    'champs'	=>'title',
                    'conditions'=> ' id ='.$memploye->idservice));
                $this->datas['employes'][$i]->service=$tememploye[0];
            }
            $i++;
        }
        $this->chargerViewLayout($this->layout, $this->direct.'organizers/index', $this->datas);
    }
}

?>
