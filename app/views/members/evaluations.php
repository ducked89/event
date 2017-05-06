<?php  $mEvaluations =(isset($datas['evaluations'])? (object)($datas['evaluations']): array()); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
     <h2>Evaluations</h2>
     <small>Liste des évaluations qui vous ont été affectées</small>

     <button type="button" class="btn btn-sm btn-info floatR mgR20" data-toggle="modal" data-target="#myModalNote"><i class="fa fa-sticky-note"></i> 
        <span class="bold">Mentions des notes</span></button>     
    </div>
</div>


<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Employé</th>
                        <th>Progression</th>
                        <th>Etat</th>
                        <th>Echéance</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                        <tbody>
                         <?php 
                        if(count($mEvaluations) > 0){
                         foreach ($mEvaluations as $mEvaluation) {
                                  $progress = $mEvaluation->qteNotes+$mEvaluation->qteCommentaires;
                                    echo '<tr class="gradeU odd" role="row">
                                        <td class="">';

                                         if($mEvaluation->etat!=2)
                                          echo'<a href="'.SITE.'members/evaluations/launch/?idu='.$mEvaluation->id.'">'.$mEvaluation->title.'</a>';
                                        else echo'<a href="'.SITE.'members/evaluations/view/?idu='.$mEvaluation->id.'">'.$mEvaluation->title.'</a>';

                                        echo'</td>

                                        <td class="sorting_1">'.$mEvaluation->evalue->firstname.' '.strtoupper($mEvaluation->evalue->lastname).'</td>
                                        
                                        <td class="">
                                          <span >'.$progress.' %</span>
                                          <div class="progress progress-mini">
                                              <div style="width: '.$progress.'%;" class="progress-bar progress-bar-';

                                                if($progress<50) echo "danger";
                                                else if($progress>50 && $progress<80) echo "warning";
                                                else echo'valid valid';

                                              echo'">
                                              </div>
                                          </div>
                                        </td>

                                        <td class="center">';

                                        if($mEvaluation->etat == 1)echo '<span class="label label-warning">En cours</span>';
                                        elseif($mEvaluation->etat == 2)echo '<span class="label label-valid">Finale</span>';
                                        else echo '<span class="label label-white">En Attente</span>';

                                        echo '</td>

                                        <td class=""><span class="';

                                        if($mEvaluation->datediff<=0) echo 'inforedlarge';

                                        echo'">'.date_format(date_create($mEvaluation->targetdate), "d M Y").'</sapn>

                                        </td>

                                        <td class="center">';
                                        if($progress==100 && $mEvaluation->etat!=2)
                                          echo'<a class="btn btn-valid" href="'.SITE.'members/evaluations/confirm/?idu='.$mEvaluation->id.'">Valider</a>';
                                        else if($mEvaluation->etat!=2) echo'<a class="btn btn-xm btn-info" href="'.SITE.'members/evaluations/launch/?idu='.$mEvaluation->id.'">Lancer</a>';
                                        else echo'<a class="btn btn-xm btn-white" href="'.SITE.'members/evaluations/view/?idu='.$mEvaluation->id.'">Consulter</a>';

                                        echo'</td>
                                        
                                    </tr>';
                                }
                            }
                            else
                                echo '    <tr> <td colspan="10"><div class="row"> <div class="col-lg-12">
                            <div class="alert alert-warning">Aucune évaluation trouvée.</div></div>
                        </div></td></tr>';
                        ?>
                       
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Titre</th>
                        <th>Employé</th>
                        <th>Progression</th>
                        <th>Etat</th>
                        <th>Echéance</th>
                        <th>Options</th>
                    </tr>
                    </tfoot>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>
    </div>
</div>


<?php  require_once 'app/views/includes/mentionnote.php';?>