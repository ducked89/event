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
                if(isset($_POST["createService"])){

                    extract($_POST);
                    if(!empty($title))
                    {
                        // Verifications des données
                        $Agent = $this->chargerMyModel('Model');
                        $Agent->useTable('profiltypes');
                        $check = $Agent->trouver(array(
                            'champs'		=> ' id ',
                            'conditions'	=> ' title="'.$title.'"',
                            'limit'			=> ' LIMIT 0, 1'
                            ));

                        // Verification de duplication
                        if(!isset($check[0]) && !isset($check[0]->id))
                        {

                            $saved = $Agent->ajouterContent(array(
                                'title'			=>$title,
                                'description'	=>$description,
                            ));
                            // var_dump($saved);
                            // die();

                            // Enregistrement effectue
                            if($saved){
                                $this->redirigerVers($this->direct.'services/');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] =true;
                                $this->chargerViewLayout($this->layout, $this->direct.'addservice',$this->datas);
                            }
                        }
                        else{
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['error']['existe'] =true;
                            $this->chargerViewLayout($this->layout, $this->direct.'addservice',$this->datas);
                            // $this->redirigerVers("admin/");
                        }
                    }
                    else{
                        if(empty($title)) 		$this->datas['error']['title'] 		= true;

                        $this->datas['error']['error'] =true;
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'addservice', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'addservice',$this->datas);
                }
            }
            break;

            // Edition
            case 'edit':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                    {
                        $idu = $_GET['idu'];
                        if(isset($_POST["saveService"])){

                            extract($_POST);
                            if(!empty($title) && !empty($description))
                            {
                                // Verifications des données
                                $Agent = $this->chargerMyModel('Model');
                                $Agent->useTable('profiltypes');
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
                                        'title'			=>$title,
                                        'description'	=>$description
                                    ));

                                    // Enregistrement effectue
                                    if($saved){
                                        $this->redirigerVers($this->direct.'services/');
                                    }
                                    else{
                                        $this->datas['mdatas'] = $_POST;
                                        $this->datas['error']['notsaved'] =true;
                                        $this->chargerViewLayout($this->layout, $this->direct.'editservice',$this->datas);
                                    }
                                }
                                else{
                                    $this->datas['mdatas'] = $_POST;
                                    $this->datas['error']['existe'] =true;
                                    $this->chargerViewLayout($this->layout, $this->direct.'editservice',$this->datas);
                                    // $this->redirigerVers("admin/");
                                }
                            }
                            else{
                                if(empty($title)) 		$this->datas['error']['title'] 		= true;
                                $this->datas['error']['error'] =true;
                                $this->datas['mdatas'] = $_POST;
                                $this->chargerViewLayout($this->layout, $this->direct.'editservice', $this->datas);
                                // $this->redirigerVers("admin/");
                            }
                            $_POST = array();
                        }
                        else{
                            $Agent = $this->chargerMyModel("User");
                            $Agent->useTable("profiltypes");
                            $found = $Agent->trouver(array(
                                'conditions'	=> ' id= '.$idu));

                            if(isset($found[0]->id))
                            {
                                $this->datas['mdatas'] = get_object_vars($found[0]);

                                $this->chargerViewLayout($this->layout, $this->direct.'editservice',$this->datas);
                            }
                            else{
                                $this->redirigerVers("administrator/services/");
                            }
                        }
                    }
                    else{
                        $this->redirigerVers("administrator/services/");
                    }
            }
            break;

            default:
                $this->redirigerVers("administrator/services/");
            break;
        }
    }
    else
    {
        $Agent = $this->chargerMyModel('Model');
        $Agent->useTable("profiltypes");
        $this->datas['services'] = $Agent->trouver(array('ordre'=>' title ASC'));

        $i =0;
        foreach ($this->datas['services'] as $mService) {
            $Agent->useTable("employes");
            $this->datas['services'][$i]->employes = $Agent->trouver(array(
                'champs'	=>'id, firstname, lastname',
                'conditions'=> ' idservice ='.$mService->id));
            $i++;
        }
        $this->chargerViewLayout($this->layout, $this->direct.'services', $this->datas);

    }
}

?>
