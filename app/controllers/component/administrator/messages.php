<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mMessages";
    $Agent = $this->chargerMyModel('Model');
    $Agent->useTable("messagesadminrecus");
    $this->datas['nbMessagesRecus'] = $Agent->trouverQuantite();

    if(isset($this->datas['params']) && !empty($this->datas['params'] ) && preg_match("/^[a-zA-Z]+$/i", $this->datas['params'][0]))
    {
        $params = $this->datas['params'][0];
        switch ($params) {

            // Envoyer un message
            case 'compose':
            {
                $this->datas['menuSubSection'] = "mCompose";
                $Agent = $this->chargerMyModel('User');
                $Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser");
                $found = $Agent->trouver(array(
                    'champs'	=>'users.id, employes.lastname, employes.firstname ',
                    'ordre'		=> ' lastname ASC'));

                if(count($found)>0 && isset($found[0]->id))
                {
                    $this->datas['employes'] = $found;
                    if(isset($_POST["sendMessage"])){
                        extract($_POST);
                        if(!empty($title) && !empty($content))
                        {
                            // Verifications des données
                            $Agent = $this->chargerMyModel('Model');
                            $Agent->useTable("messagesadminenvoyes");
                            $saved = $Agent->ajouterContent(array(
                                'idreceiver'=>$idreceiver,
                                'title'		=>$title,
                                'content'	=>$content
                            ));

                            // Enregistrement effectue
                            if($saved){
                                $Agent->useTable("messagesmembersrecus");
                                $saved = $Agent->ajouterContent(array(
                                    'idsender'	=>$this->iduser,
                                    'idreceiver'=>$idreceiver,
                                    'title'		=>$title,
                                    'content'	=>$content,
                                    'statut'	=>0
                                ));

                                // $this->sendMail();

                                $this->redirigerVers($this->direct.'messages/compose');
                            }
                            else{
                                $this->datas['mdatas'] = $_POST;
                                $this->datas['error']['notsaved'] =true;
                                $this->chargerViewLayout($this->layout, $this->direct.'events/add',$this->datas);
                            }
                        }
                        else{
                            if(empty($title)) 		$this->datas['error']['title'] 		= true;
                            if(empty($content)) $this->datas['error']['content'] 	= true;
                            $this->datas['mdatas'] = $_POST;
                            $this->chargerViewLayout($this->layout, $this->direct.'messages/compose', $this->datas);
                            // $this->redirigerVers("admin/");
                        }
                        $_POST = array();
                    }
                    else $this->chargerViewLayout($this->layout, $this->direct.'messages/compose', $this->datas);
                }
                else $this->redirigerVers("administrator/messages/issue/");
            }
            break;

            case 'envoyes':
                {
                    $Agent = $this->chargerMyModel('Model');
                    $Agent->useTable("messagesadminenvoyes");
                    $this->datas['nbMessagesEnvoyes'] = $Agent->trouverQuantite();

                    $parPage = 10;
                    $nbPage = ceil($this->datas['nbMessagesEnvoyes']/$parPage);
                    if(isset($_GET['page']) && preg_match("/^[0-9]+$/", $_GET['page']) && $_GET['page']>0 && $_GET['page']<= $nbPage){
                        $onPage = $_GET['page'];
                    }
                    else if (isset($_GET['mypage']) && preg_match("/^[0-9]+$/", $_GET['mypage']) && $_GET['mypage']>0 && $_GET['mypage']<= $nbPage)
                    {
                        $onPage = $_GET['mypage'];
                    }
                    else{
                        $onPage = 1;
                    }

                    $this->datas['mMessagesEnvoyes'] = $Agent->trouver(array(
                        'ordre'=>' datecreated DESC',
                        'limit'=>' LIMIT '.($onPage-1)*$parPage.', '.$parPage));

                    if(count($this->datas['mMessagesEnvoyes']>0)){
                        $i=0;
                        $Agent->useTable("employes");
                        foreach ($this->datas['mMessagesEnvoyes'] as $tempMessage) {
                            $employes = $Agent->trouver(array(
                                'champs'=>'firstname, lastname',
                                'conditions'=>' iduser='.$tempMessage->idreceiver));
                            $this->datas['mMessagesEnvoyes'][$i]->sender=$employes[0]->firstname." ".$employes[0]->lastname;
                            $i++;
                        }
                    }

                    $Tools = new Utilities();
                    $this->datas['paginate'] = $Tools->creerPaginationSimple($onPage, $nbPage, "messages");
                    $this->chargerViewLayout($this->layout, $this->direct.'messages/envoyer', $this->datas);
                }
                break;

            default: $this->redirigerVers("administrator/messages/"); break;
        }

    }
    else{
        $parPage = 10;
        $nbPage = ceil($this->datas['nbMessagesRecus']/$parPage);
        if(isset($_GET['page']) && preg_match("/^[0-9]+$/", $_GET['page']) && $_GET['page']>0 && $_GET['page']<= $nbPage){
            $onPage = $_GET['page'];
        }
        else if (isset($_GET['mypage']) && preg_match("/^[0-9]+$/", $_GET['mypage']) && $_GET['mypage']>0 && $_GET['mypage']<= $nbPage)
        {
            $onPage = $_GET['mypage'];
        }
        else{
            $onPage = 1;
        }

        $Agent->useTable("messagesadminrecus");
        $this->datas['mMessagesRecus'] = $Agent->trouver(array(
            'ordre'=>' datecreated DESC',
            'limit'=>' LIMIT '.($onPage-1)*$parPage.', '.$parPage));

        if(count($this->datas['mMessagesRecus']>0)){
            $i=0;
            $Agent->useTable("employes");
            foreach ($this->datas['mMessagesRecus'] as $tempMessage) {
                $employes = $Agent->trouver(array(
                    'champs'=>'firstname, lastname',
                    'conditions'=>' iduser='.$tempMessage->idsender));
                $this->datas['mMessagesRecus'][$i]->sender=$employes[0]->firstname." ".$employes[0]->lastname;
                $i++;
            }
        }

        $Tools = new Utilities();
        $this->datas['paginate'] = $Tools->creerPaginationSimple($onPage, $nbPage, "messages");
        $this->chargerViewLayout($this->layout, $this->direct.'messages/index', $this->datas);
    }
}

?>
