<?php
$Tools = $this->useUtility("Utilities");
$Agent= $this->chargerMyModel("User");

// Get messages
$Agent->useTable("messagesadminrecus");
$this->datas['messages'] = $Agent->trouver(array('conditions'=>' statut=0', 'ordre'=>' datecreated DESC '));
if(isset($this->datas['messages'][0]) && !empty($this->datas['messages'][0]->id)){
    $i=0;
    $Agent->useTable("employes");
    foreach ($this->datas['messages'] as $tempMessage) {
        $employes = $Agent->trouver(array(
            'champs'=>'firstname, lastname',
            'conditions'=>' iduser='.$tempMessage->idsender));
        $this->datas['messages'][$i]->sender=$employes[0]->firstname." ".$employes[0]->lastname;
        $this->datas['messages'][$i]->datediff = $Tools->dateDifference(date_format(date_create($this->datas['messages'][$i]->datecreated), 'Y-m-d'), date('Y-m-d'));
        $i++;
    }
}

// Get notifications
$Agent->useTable("notifications");
$this->datas['notifications'] = $Agent->trouver(array(
    'conditions'	=> ' (iduser ='.$this->iduser.' OR iduser=0) AND statut=0',
    'ordre'=>' datecreated DESC '));
if(isset($this->datas['notifications'][0]) && !empty($this->datas['notifications'][0]->id)){
    $i=0;
    foreach ($this->datas['notifications'] as $myNotification) {
        $this->datas['notifications'][$i]->datediff = $Tools->dateDifference(date_format(date_create($this->datas['notifications'][$i]->datecreated), 'Y-m-d'), date('Y-m-d'));
        $i++;
    }
}

?>
