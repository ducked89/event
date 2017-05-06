 <?php     
 $myEvaluation = (object)($datas['firstevaluations']);
 $myEvalue = (object)($myEvaluation->evalue);
 $myEvaluateur = (object)($myEvaluation->evaluateur);



 $progress = $myEvaluation->qteNotes+$myEvaluation->qteCommentaires;
// $myEvaluation = $datas['evalue']; Stats


 ?>

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Evènement</h2><br/>
        <?php            
            if($myEvaluation->statut==0) 
                echo '<a class="btn btn-warning pull-right floatR " 
                        href="'.SITE.'admin/evaluations/enable/?idu='.$myEvaluation->id.'">Activer</a>';
            else echo '<a class="btn btn-danger pull-right floatR " 
                        href="'.SITE.'admin/evaluations/disable/?idu='.$myEvaluation->id.'">Desactiver</a>';

            if($myEvaluation->etat<2)
            echo'<a class="btn btn-valid pull-right floatR mgR20" 
                href="'.SITE.'admin/evaluations/finalize/?idu='.$myEvaluation->id.'">Finaliser</a>';
            else
            echo'<a class="btn btn-valid pull-right floatR mgR20"
            href="'.SITE.'admin/evaluations/open/?idu='.$myEvaluation->id.'">Ouvrir</a>';

            echo' <a href="'.SITE.'admin/evaluations/overview/?idu='.$myEvalue->id.'" class="btn btn-info pull-right floatR mgR20"><i class="fa fa-bar-chart-o mgR10"></i>Stats</a>';
        ?>

       

        <a class="btn btn-success pull-right mgR20" href="<?php echo SITE;?>admin/evaluations">Liste évènements</a>
        <h3><?= $myEvaluation->title;?></h3>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
   
    <!-- Profil header -->
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-7">

            <div class="profile-image">
                <img src="<?php 
                echo SITE.'public/images/profiles/';
                if(!empty($myEvalue->photo)) echo $myEvalue->photo;
                else echo 'profile.jpg'; ?>" class="img-profile" alt="profile">
            </div>

            <div class="profile-info">
                <div class="">
                    <h2 class="no-margins"><?= $myEvalue->firstname.' '.$myEvalue->lastname;?></h2>
                    <?php 
                        if($myEvaluation->etat == 1) echo '<span class="label label-warning pull-right ">En cours</span>';
                        elseif($myEvaluation->etat == 2)echo '<span class="label label-valid  pull-right">Finale</span>';
                        else echo '<span class="label label-white  pull-right">En Attente</span>';
                        echo '<br/><span class="pull-right">'.$progress.'% Completer</span>';
                    ?>

                    Evaluateur: <strong><?= $myEvaluateur->firstname.' '.$myEvaluateur->lastname;?></strong>
                    <br/>Date creation : <strong><?= date_format(date_create($myEvaluation->datecreated), "d M Y"); ?></strong>
                    <br/>Date d'echeance : <strong><?= date_format(date_create($myEvaluation->targetdate), "d M Y"); ?></strong>
                </div>

                <?php

                    echo'
                    </div><div class="clear20"></div>
                    <div class="progress progress-striped active">            
                        <div style="width: '.ceil($progress).'%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-';
                                if($progress<50) echo "danger";
                                    else if($progress>50 && $progress<80) echo "warning";
                                else echo'valid valid';
                            echo '">

                        </div> 
                        <div style="width: '.ceil(100 - $progress).'%" class="progress-bar progress-bar-default">
                                    <span class="sr-only">40% Complete (danger)</span>
                                </div>


                    </div>
                       
                    ';
                ?> 
           
        </div>
        <div class="col-lg-4 pull-right">      
                <?php
                     if($myEvaluation->etat == 2)
                            echo '
                            <div class="alert alert-success "><strong>Cette evaluation a été completée et validée par l\'évaluateur.</strong></div>
                            <span class="infored pull-right">NB: Si des modifications sont necessaires, il faut reactiver l\'évaluation.</sapn> <br/>
                            <a class="btn btn-valid" href="'.SITE.'admin/evaluations/enable/?idu='.$myEvaluation->id.'">Réactiver cette évaluation</a>
                        ';
                ?>
            </div>
    </div>
   

    <!-- Formulaire d'evaluation -->
    <div class="row">
        <div class="col-lg-8">

            <div class="ibox">
                <div class="ibox-title"><h3>Criteres d'évènement</h3></div>
                <div class="ibox-content">                
                    <div class="panel-group payments-method" id="accordion">
                            <?php

                            foreach ($datas['criteres']as $data) {
                                echo '

                                <div class="panel panel-default';


                                    foreach ($datas['notes'] as $note) {
                                        if (($note->idcritere == $data->id) && ($note->notes == 100)) {
                                            echo ' panel-border-red';
                                         }
                                    }
                                echo'">
                                    <div class="panel-heading">
                                        <div class="pull-right col-sm-5">';
                                             foreach ($datas['notes'] as $note) {
                                                if (($note->idcritere == $data->id) && 
                                                    (($note->notes == 100) || empty($note->commentaire))
                                                    ) {
                                                        echo '
                                                         <button data-id="tooltip'. $data->id.'" type="button" class="btn btn-default pull-right mgL20 toolTipJs" title="Note ou commentaire non fourni ou invalide." > <i class="fa fa-info-circle text-danger"></i></button><br/> <span class="infored delete-data" id="tooltip'. $data->id.'">Note ou commentaire non fourni ou invalide.</span>';
                                                     }
                                                     
                                                }
                                           

                                           //  text-success
                                        echo'
                                        </div>
                                        <h3> 
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$data->id.'">
                                                <i class="btn btn-xs btn-info fa fa-angle-double-down mgR20"></i>'.$data->title.'</a>
                                            </h3>
                                        </div>
                                        <div id="collapse'.$data->id.'" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Critere</label>
                                                            <div class="col-sm-9">
                                                               <input class="col-sm-12" type="text" value="'.$data->title.'" disabled /><br/>
                                                               <span class="small">'.$data->description.'</span>
                                                           </div>
                                                       </div>
                                                       <div class="clear20"></div>
                                                       <div class="form-group">
                                                        <label class="col-sm-3 control-label">Note</label>
                                                        <div class="col-sm-9">
                                                            <select id="noteCritere'.$data->id.'" name="noteCritere'.$data->id.'" data-id="'.$data->id.'" class="noteCritere form-control" disabled>
                                                                <option value="100">Selectionner une note</option>';
                                                                foreach ($datas['mentions'] as $mdata) {
                                                                    echo '<option value="'.$mdata->level.'"';

                                                                    foreach ($datas['notes'] as $note) {
                                                                        if (($note->idcritere == $data->id) && ($note->notes == $mdata->level)) {
                                                                            echo ' selected = "selected"';
                                                                         }
                                                                    }

                                                                    echo'>'.$mdata->level.' :: '.$mdata->title.'</option>';
                                                             }

                                                             echo'
                                                         </select><br/>
                                                         <div id="noteDetail'.$data->id.'" class="info infoalert"></div>
                                                     </div>
                                                 </div>

                                             </div>

                                             <div class="col-md-6">

                                               <div class="form-group">
                                                <label class="col-sm-12 control-label">Commentaires</label>
                                                <div class="col-sm-12">
                                                    <textarea name="commentaire'.$data->id.'" class="form-control sm-textarea" disabled>';

                                                    foreach ($datas['notes'] as $note) {
                                                        if ($note->idcritere == $data->id) {
                                                            echo $note->commentaire;
                                                         }
                                                    }
                                                   echo'</textarea>
                                                </div>
                                            </div>


                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                        ';
                    }
                    ?>

                        <div class="clear50"></div>
                        <a class="btn btn-danger floatR" href="<?php echo SITE;?>admin/evaluations/">Revenir</a>
                    </div>

                </div>

            </div>
        </div>

        <!-- Autres evaluations -->
        <div class="col-lg-4">

            <div class="ibox">
                <div class="ibox-title"><h3>Autres évènements</h3></div>
                <div class="ibox-content">
                
                    <div class="panel-group payments-method" id="accordion">
                    <p>Liste des autres évènements, par évaluateur, disponibles pour cet employé.<br/><br/></p>
                            <?php
                                $total = 0; $br = 0;
                                if(count($datas['otherEvaluations'])>0 && isset($datas['otherEvaluations'][0]->id))
                                {
                                  foreach ($datas['otherEvaluations'] as $mEmpEvluation)
                                  {
                                    if($mEmpEvluation->id!=$myEvaluation->id)
                                        {
                                            echo'
                                                 <div class="team-members">';
                                                    if($mEmpEvluation->etat == 1)echo '<span class="label pull-right label-warning">En cours</span>';
                                                        elseif($mEmpEvluation->etat == 2)echo '<span class="label  pull-right label-valid">Finale</span>';
                                                        else echo '<span class="label  pull-right label-white">En Attente</span>';

                                                    echo'
                                                    <span class="mgR10 pull-right">'.ceil($mEmpEvluation->qteNotes+$mEmpEvluation->qteCommentaires).'%</span>
                                                    <a href="'.SITE.'admin/evaluations/view/?idu='.$mEmpEvluation->id.'">
                                                        <img alt="UTE" class="img-circle floatL mgR20" src="'.SITE.'public/images/profiles/';
                                                        if(empty($mEmpEvluation->evaluateur->photo)) echo 'profile.jpg';
                                                        else echo $mEmpEvluation->evaluateur->photo;
                                                        echo '">
                                                        <span>'.$mEmpEvluation->evaluateur->firstname.' '.$mEmpEvluation->evaluateur->lastname.'</span>
                                                    </a>
                                                    <div class="clear"><hr/></div>
                                                </div>
                                            ';
                                        }
                                    }
                                }
                                else
                                    echo'<div class="alert alert-info">Aucune autres évaluations n\'ont été trouvées pour cet employé.</div>';
                                    
                            ?>
                        <a class="btn btn-danger floatR" href="<?php echo SITE;?>admin/evaluations/">Revenir</a>
                        <div class="clear20"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>