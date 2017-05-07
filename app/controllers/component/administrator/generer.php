<?php
$Agent = $this->chargerMyModel('Model');
$Agent->useTable('employes');
$evalue = $Agent->trouver(array(
    'conditions'	=> 'iduser='.$idevalue,
    ));

$Agent->useTable('employes');
$evaluateur = $Agent->trouver(array(
    'conditions'	=> 'iduser='.$idevaluateur,
    ));

$Tools = $this->useUtility("Utilities");
$myMois = $Tools->nomMois($mois);

$result = 'Evaluation de '.$evalue[0]->firstname.' '.$evalue[0]->lastname.' ';
$result .= 'Par '.$evaluateur[0]->firstname.' '.$evaluateur[0]->lastname.'';
$result .= ' Période '.$myMois.' / '.$annee;

return $result;
?>
