<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mNotifications";
    if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
    {
        $params = $this->datas['params'][0];

        switch ($params) {

            // Ajouter
            case 'add':
            {
                $Agent = $this->chargerMyModel('Model');
                $Agent->useTable("employes");
                $this->datas['employes'] = $Agent->trouver(array(
                    'ordre'=>'firstname ASC'));

                // Notification Recus
                if(isset($_POST["createNotification"])){

                    extract($_POST);
                    if(!empty($title) && !empty($content))
                    {
                        // Verifications des données
                        $Agent = $this->chargerMyModel('Model');
                        $Agent->useTable('notifications');
                        $check = $Agent->trouver(array(
                            'champs'		=> ' id ',
                            'conditions'	=> ' title="'.$title.'"',
                            'limit'			=> ' LIMIT 0, 1'
                            ));

                        // Verification de duplication
                        if(!isset($check[0]) && !isset($check[0]->id))
                        {

                            $saved = $Agent->ajouterContent(array(
                                'iduser'		=>$iduser,
                                'type'			=>'admin',
                                'title'			=>$title,
                                'content'		=>$content,
                                'datecreated'	=>date("Y-m-d H:i:s"),
                                'sent'			=>0,
                                'statut'		=>0
                            ));
                            // var_dump($saved);
                            // die();

                            // Enregistrement effectue
                            if($saved){
                                $this->redirigerVers($this->direct.'notifications/');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] =true;
                                $this->chargerViewLayout($this->layout, $this->direct.'notifications/add',$this->datas);
                            }
                        }
                        else{
                            $this->datas['mdatas'] = $_POST;
                            $this->datas['error']['existe'] =true;
                            $this->chargerViewLayout($this->layout, $this->direct.'notifications/add',$this->datas);
                            // $this->redirigerVers("admin/");
                        }
                    }
                    else{
                        if(empty($title)) 		$this->datas['error']['title'] 		= true;
                        if(empty($content)) 	$this->datas['error']['content'] 	= true;

                        $this->datas['error']['error'] =true;
                        $this->datas['mdatas'] = $_POST;
                        $this->chargerViewLayout($this->layout, $this->direct.'notifications/add', $this->datas);
                        // $this->redirigerVers("admin/");
                    }
                    $_POST = array();
                }
                else{
                    $this->chargerViewLayout($this->layout, $this->direct.'notifications/add',$this->datas);
                }
            }
            break;

            default:
                $this->redirigerVers("administrator/notifications/");
            break;
        }
    }
    else
    {
        $Tools = $this->useUtility("Utilities");
        $Agent = $this->chargerMyModel('Model');
        $Agent->useTable("notifications");
        $this->datas['nbNotificationsRecus'] = $Agent->trouver(array(
            'champs'=>' COUNT(*) as nb',
            'conditions'=>'  iduser ='.$this->iduser.' AND type="systeme"',
            'ordre'=>'datecreated DESC'));

        $parPage = 10;
        $nbPage = ceil($this->datas['nbNotificationsRecus'][0]->nb/$parPage);
        if(isset($_GET['action']) && $_GET['action']="recus" && isset($_GET['page']) && preg_match("/^[0-9]+$/", $_GET['page']) && $_GET['page']>0 && $_GET['page']<= $nbPage){
            $onPageRecus = $_GET['page'];
            $this->datas['section']="recus";
        }
        else if (isset($_GET['action']) && $_GET['action']="recus" && isset($_GET['mypage']) && preg_match("/^[0-9]+$/", $_GET['mypage']) && $_GET['mypage']>0 && $_GET['mypage']<= $nbPage)
        {
            $onPageRecus = $_GET['mypage'];
            $this->datas['section']="recus";
        }
        else{
            $onPageRecus = 1;
            $this->datas['section']="recus";
        }

        // Notification Recus
        $Agent->useTable("notifications");
        $this->datas['notificationsRecus'] = $Agent->trouver(array(
            'conditions'	=>' type="systeme"',
            'ordre'			=>' datecreated DESC',
            'limit'			=>' LIMIT '.($onPageRecus-1)*$parPage.', '.$parPage));


        if(isset($this->datas['notificationsRecus'][0]) && !empty($this->datas['notificationsRecus'][0]->id)){
            $i=0;
            foreach ($this->datas['notificationsRecus'] as $myNotification) {
                $this->datas['notificationsRecus'][$i]->datediff = $Tools->dateDifference(date_format(date_create($this->datas['notificationsRecus'][$i]->datecreated), 'Y-m-d'), date('Y-m-d'));

                $Agent->useTable("employes");
                $this->datas['nEmployes'] = $Agent->trouver(array(
                'champs'=>'id, firstname, lastname',
                'conditions'=>'iduser='.$this->datas['notificationsRecus'][$i]->iduser,
                'limit'=>' LIMIT 0,1'));

                if(isset($this->datas['nEmployes'][0]->id))
                    $this->datas['notificationsRecus'][$i]->employe=$this->datas['nEmployes'][0]->firstname.' '.$this->datas['nEmployes'][0]->lastname;
                else $this->datas['notificationsRecus'][$i]->employe="Admin";

                $i++;
            }
            $Agent->useTable("notifications");
            $Agent->modifierCondition(array(
                'statut'=>1,
                ),'iduser=1 OR iduser=0');
        }
        $this->datas['paginateRecus'] = $Tools->creerPaginationSimpleAction($onPageRecus, $nbPage, "messages", "recus");




        $Agent->useTable("notifications");
        $this->datas['nbNotificationsEnvoyes'] = $Agent->trouver(array(
            'champs'=>' COUNT(*) as nb',
            'conditions'=>'type="admin"',
            'ordre'=>'datecreated DESC'));

        $nbPage = ceil($this->datas['nbNotificationsEnvoyes'][0]->nb/$parPage);
        if(isset($_GET['action']) && $_GET['action']="sent" && isset($_GET['page']) && preg_match("/^[0-9]+$/", $_GET['page']) && $_GET['page']>0 && $_GET['page']<= $nbPage){
            $onPageEnvoyes = $_GET['page'];
            $this->datas['section']="sent";
        }
        else if (isset($_GET['action']) &&$_GET['action']="sent" && isset($_GET['mypage']) && preg_match("/^[0-9]+$/", $_GET['mypage']) && $_GET['mypage']>0 && $_GET['mypage']<= $nbPage)
        {
            $onPageEnvoyes = $_GET['mypage'];
            $this->datas['section']="sent";
        }
        else{
            $onPageEnvoyes = 1;
            $this->datas['section']="sent";
        }

        // Notification Envoyes
        $Agent->useTable("notifications");
        $this->datas['notificationsEnvoyes'] = $Agent->trouver(array(
            'conditions'	=>' type="admin"',
            'ordre'			=>' datecreated DESC',
            'limit'			=>' LIMIT '.($onPageEnvoyes-1)*$parPage.', '.$parPage));

        if(isset($this->datas['notificationsEnvoyes'][0]) && !empty($this->datas['notificationsEnvoyes'][0]->id)){
            $i=0;
            foreach ($this->datas['notificationsEnvoyes'] as $myNotification) {
                $this->datas['notificationsEnvoyes'][$i]->datediff = $Tools->dateDifference(date_format(date_create($this->datas['notificationsEnvoyes'][$i]->datecreated), 'Y-m-d'), date('Y-m-d'));

                $Agent->useTable("employes");
                $this->datas['nEmployes'] = $Agent->trouver(array(
                'champs'=>'id, firstname, lastname',
                'conditions'=>'iduser='.$this->datas['notificationsEnvoyes'][$i]->iduser,
                'limit'=>' LIMIT 0,1'));

                if(isset($this->datas['nEmployes'][0]->id))
                    $this->datas['notificationsEnvoyes'][$i]->employe=$this->datas['nEmployes'][0]->firstname.' '.$this->datas['nEmployes'][0]->lastname;
                else $this->datas['notificationsEnvoyes'][$i]->employe="Tous";
                $i++;
            }
        }
        $this->datas['paginateEnvoyes'] = $Tools->creerPaginationSimpleAction($onPageEnvoyes, $nbPage, "messages", "sent");
        $this->chargerViewLayout($this->layout, $this->direct.'notifications/index', $this->datas);

    }
}

?>
