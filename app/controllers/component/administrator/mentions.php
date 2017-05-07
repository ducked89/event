<?php
if($this->isConnected()){
    $this->datas['menuSection'] = "mCritere";
    if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
    {
        $params = $this->datas['params'][0];

        switch ($params) {
            // Ajouter
            case 'add':
            {
                if(isset($_POST["createMention"])){

                    extract($_POST);
                    if(!empty($title) && !empty($description))
                    {
                        // Verifications des données
                        $Agent = $this->chargerMyModel('Model');
                        $Agent->useTable('mentions');
                        $check = $Agent->trouver(array(
                            'champs'		=> ' id ',
                            'conditions'	=> ' title="'.$title.'" OR level='.$level,
                            'limit'			=> ' LIMIT 0, 1'
                            ));

                        // Verification de duplication
                        if(!isset($check[0]) && !isset($check[0]->id))
                        {

                            $saved = $Agent->ajouterContent(array(
                                'title'			=>$title,
                                'level'			=>$level,
                                'description'	=>$description
                            ));
                            // var_dump($saved);
                            // die();

                            // Enregistrement effectue
                            if($saved){
                                $this->redirigerVers($this->direct.'mentions/');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] =true;
                                $this->chargerViewLayout($this->layout, $this->direct.'addmention',$this->datas);
                            }
                        }
                        else{
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['error']['existe'] =true;
                            $this->chargerViewLayout($this->layout, $this->direct.'addmention',$this->datas);
                            // $this->redirigerVers("admin/");
                        }
                    }
                    else{
                        if(empty($title)) 		$this->datas['error']['title'] 		= true;
                        if(empty($description)) $this->datas['error']['description'] 	= true;

                        $this->datas['error']['error'] =true;
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'addmention', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'addmention',$this->datas);
                }
            }
            break;

            // Edition
            case 'edit':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                    {
                        $idu = $_GET['idu'];
                        if(isset($_POST["saveMention"])){

                            extract($_POST);
                            if(!empty($title) && !empty($description))
                            {
                                // Verifications des données
                                $Agent = $this->chargerMyModel('Model');
                                $Agent->useTable('mentions');
                                $check = $Agent->trouver(array(
                                    'champs'		=> ' id ',
                                    'conditions'	=> ' level='.$level.' OR title="'.$title.'"',
                                    'limit'			=> ' LIMIT 0, 1'
                                    ));

                                // Verification de duplication
                                if(!isset($check[0]) && !isset($check[0]->id))
                                {

                                    $saved = $Agent->modifier(array(
                                        'id'			=>$idu,
                                        'title'			=>$title,
                                        'level'			=>$level,
                                        'description'	=>$description
                                    ));

                                    // Enregistrement effectue
                                    if($saved){
                                        $this->redirigerVers($this->direct.'mentions/');
                                    }
                                    else{
                                        $this->datas['mdatas'] = $_POST;
                                        $this->datas['error']['notsaved'] =true;
                                        $this->chargerViewLayout($this->layout, $this->direct.'editmention',$this->datas);
                                    }
                                }
                                else{
                                    $this->datas['mdatas'] = $_POST;
                                    $this->datas['error']['existe'] =true;
                                    $this->chargerViewLayout($this->layout, $this->direct.'editmention',$this->datas);
                                    // $this->redirigerVers("admin/");
                                }
                            }
                            else{
                                if(empty($title)) 		$this->datas['error']['title'] 		= true;
                                $this->datas['error']['error'] =true;
                                $this->datas['mdatas'] = $_POST;
                                $this->chargerViewLayout($this->layout, $this->direct.'editmention', $this->datas);
                                // $this->redirigerVers("admin/");
                            }
                            $_POST = array();
                        }
                        else{
                            $Agent = $this->chargerMyModel("User");
                            $Agent->useTable("mentions");

                            $found = $Agent->trouver(array(
                                'conditions'	=> ' id= '.$idu));

                            if(isset($found[0]->id))
                            {
                                $this->datas['mdatas'] = get_object_vars($found[0]);
                                $this->datas['mentions'] = $found[0];
                                $this->chargerViewLayout($this->layout, $this->direct.'editmention',$this->datas);
                            }
                            else{
                                $this->redirigerVers("administrator/mentions/");
                            }
                        }
                    }
                    else{
                        $this->redirigerVers("administrator/mentions/");
                    }
            }
            break;

            default:
                $this->redirigerVers("administrator/mentions/");
            break;
        }
    }
    else
    {
        $Agent = $this->chargerMyModel('Model');
        $Agent->useTable("mentions");
        $this->datas['mentions'] = $Agent->trouver(array('ordre'=>' level ASC'));
        $this->chargerViewLayout($this->layout, $this->direct.'mentions', $this->datas);

    }
}

?>
