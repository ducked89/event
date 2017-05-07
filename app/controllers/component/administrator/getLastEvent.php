<?php
$Agent = $this->chargerMyModel('Model');
$Agent->useTable("evaluations");
$tempEvaluations = $Agent->trouver(array('ordre'=>' datecreated DESC ', 'limit'=>' LIMIT 0, 10'));

if(count($tempEvaluations) && isset($tempEvaluations[0]->id))
{

    $Agent->useTable("ponderations");
    $tempPonderations = $Agent->trouver(array(
        'ordre'			=>' title ASC'));

    $Agent->useTable("users LEFT JOIN employes ON users.id = employes.iduser ");
    $tempUsers = $Agent->trouver(array(
        'champs'		=>'users.id, employes.lastname, employes.firstname, employes.photo',
        'ordre'			=>' employes.firstname ASC'));

    $i=0;
    $Tools = $this->useUtility("Utilities");
    foreach ($tempEvaluations as $tpEval ){

        foreach ($tempPonderations as $tpPond) {
            if($tpEval->idponderation == $tpPond->id)
                $tempEvaluations[$i]->ponder = $tpPond;
        }

        foreach ($tempUsers as $tpUser) {
            if($tpEval->idevalue == $tpUser->id)
                $tempEvaluations[$i]->evalue = $tpUser;

            if($tpEval->idevaluateur == $tpUser->id)
                $tempEvaluations[$i]->evaluateur = $tpUser;
        }
        $tempEvaluations[$i]->datediff = $Tools->dateDifference(date('Y-m-d'), date_format(date_create($tpEval->targetdate), 'Y-m-d'));
        $i++;

    }
    $this->datas['evaluations'] = $tempEvaluations;
}
else $this->datas['evaluations'] = null;

?>
