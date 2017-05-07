<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mPonderation";
    if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
    {
        $params = $this->datas['params'][0];

        switch ($params) {
            // Ajouter
            case 'add':
            {
                if(isset($_POST["createPonderation"])){

                    extract($_POST);
                    if(!empty($title))
                    {
                        // Verifications des données
                        $Agent = $this->chargerMyModel('Model');
                        $Agent->useTable('ponderations');
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
                                $this->redirigerVers($this->direct.'ponderations/');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] =true;
                                $this->chargerViewLayout($this->layout, $this->direct.'addponderation',$this->datas);
                            }
                        }
                        else{
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['error']['existe'] =true;
                            $this->chargerViewLayout($this->layout, $this->direct.'addponderation',$this->datas);
                            // $this->redirigerVers("admin/");
                        }
                    }
                    else{
                        if(empty($title)) 		$this->datas['error']['title'] 		= true;

                        $this->datas['error']['error'] =true;
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'addponderation', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'addponderation',$this->datas);
                }
            }
            break;

            // Edition
            case 'edit':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                    {
                        $idu = $_GET['idu'];
                        if(isset($_POST["savePonderation"])){

                            extract($_POST);
                            if(!empty($title) && !empty($description))
                            {
                                // Verifications des données
                                $Agent = $this->chargerMyModel('Model');
                                $Agent->useTable('ponderations');
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
                                        $this->redirigerVers($this->direct.'ponderations/');
                                    }
                                    else{
                                        $this->datas['mdatas'] = $_POST;
                                        $this->datas['error']['notsaved'] =true;
                                        $this->chargerViewLayout($this->layout, $this->direct.'editponderation',$this->datas);
                                    }
                                }
                                else{
                                    $this->datas['mdatas'] = $_POST;
                                    $this->datas['error']['existe'] =true;
                                    $this->chargerViewLayout($this->layout, $this->direct.'editponderation',$this->datas);
                                    // $this->redirigerVers("admin/");
                                }
                            }
                            else{
                                if(empty($title)) 		$this->datas['error']['title'] 		= true;
                                $this->datas['error']['error'] =true;
                                $this->datas['mdatas'] = $_POST;
                                $this->chargerViewLayout($this->layout, $this->direct.'editponderation', $this->datas);
                                // $this->redirigerVers("admin/");
                            }
                            $_POST = array();
                        }
                        else{
                            $Agent = $this->chargerMyModel("User");
                            $Agent->useTable("ponderations");
                            $found = $Agent->trouver(array(
                                'conditions'	=> ' id= '.$idu));

                            if(isset($found[0]->id))
                            {
                                $this->datas['mdatas'] = get_object_vars($found[0]);

                                $Agent->useTable("ponderationslites");
                                $this->datas['criteres'] = $Agent->trouver(array(
                                'conditions'	=> ' idponderation= '.$idu));

                                if(count($this->datas['criteres'])>0){
                                    $i =0;
                                    foreach ($this->datas['criteres'] as $tempCritere) {
                                        $Agent->useTable("criteres");
                                        $temp = $Agent->trouver(array(
                                            'chmaps'=>'title',
                                            'conditions'	=> ' id= '.$tempCritere->idcriteres));
                                        $this->datas['criteres'][$i]->title=$temp[0]->title;
                                        $i++;
                                    }
                                }

                                $this->chargerViewLayout($this->layout, $this->direct.'editponderation',$this->datas);
                            }
                            else{
                                $this->redirigerVers("admin/ponderations/");
                            }
                        }
                    }
                    else{
                        $this->redirigerVers("admin/ponderations/");
                    }
            }
            break;

            // Ajouter
            case 'items':
            {
                if(isset($_GET['idu']) && preg_match("/^[0-9]+$/i", $_GET['idu']))
                {
                    $idu = $_GET['idu'];
                    $Agent = $this->chargerMyModel("User");
                    $Agent->useTable("ponderations");
                    $found = $Agent->trouver(array(
                        'conditions'	=> ' id= '.$idu));

                    if(isset($found[0]->id))
                    {
                        $this->datas['mdatas'] = get_object_vars($found[0]);

                        $Agent->useTable("ponderationslites");
                        $this->datas['criteres'] = $Agent->trouver(array(
                        'conditions'	=> ' idponderation= '.$idu));


                        $Agent->useTable("criteres");
                        $this->datas['allcriteres'] = $Agent->trouver(array(
                            'champs'=>'id, title',
                            'ordre'	=> ' title ASC'));


                        if(count($this->datas['criteres'])>0){
                            $i =0;
                            foreach ($this->datas['criteres'] as $tempCritere) {
                                $Agent->useTable("criteres");
                                $temp = $Agent->trouver(array(
                                    'chmaps'=>'title',
                                    'conditions'	=> ' id= '.$tempCritere->idcriteres));
                                $this->datas['criteres'][$i]->title=$temp[0]->title;
                                $i++;
                            }
                        }

                        $this->chargerViewLayout($this->layout, $this->direct.'ponderationslist',$this->datas);
                    }
                    else{
                        $this->redirigerVers("admin/ponderations/");
                    }
                }
                else{
                    $this->redirigerVers("admin/ponderations/");
                }
            }
            break;

            default:
                $this->redirigerVers("administrator/ponderations/");
            break;
        }
    }
    else
    {
        $Agent = $this->chargerMyModel('Model');
        $Agent->useTable("ponderations");
        $this->datas['ponderations'] = $Agent->trouver(array('ordre'=>' title ASC'));
        $this->chargerViewLayout($this->layout, $this->direct.'ponderations', $this->datas);

    }
}

?>
