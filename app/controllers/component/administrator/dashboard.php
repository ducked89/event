<?php
if($this->isConnected())
{
    $this->datas['menuSection'] = "mDashboards";
    $this->datas['menuSection'] = "mDashboards";
    $Agent = $this->chargerMyModel('Model');

    $Agent->useTable("evaluations");
    $this->datas['nbElements']['nbEvaluations'] = $Agent->trouver(array('champs'=>'COUNT(*) as nb '));


    $Agent->useTable("employes");
    $this->datas['nbElements']['nbEmployes'] = $Agent->trouver(array('champs'=>'COUNT(*) as nb'));

    $Agent->useTable("users");
    $this->datas['nbElements']['nbUsers'] = $Agent->trouver(array(
        'champs'	=>' COUNT(*) as nb ',
        'conditions'=>' roleid != 1 '));
    // $this->getLastEvaluations();

    $this->chargerViewLayout($this->layout, $this->direct.'dashboard/index', $this->datas);
}

?>
