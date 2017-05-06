 <?php     
 $myEvaluation = (object)($datas['evaluations'][0]);
 $myEvalue = (object)($myEvaluation->evalue);
 $myEvaluateur = (object)($myEvaluation->evaluateur);



 $progress = $myEvaluation->qteNotes+$myEvaluation->qteCommentaires;
// $myEvaluation = $datas['evalue'];


 ?>

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Evaluation</h2>
        <a class="btn btn-success pull-right" href="<?php echo SITE;?>members/evaluations">Mes évaluations</a>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">

    <!-- Profil header -->
    <div class="row m-b-lg m-t-lg">
        <div class="col-md-8">

            <div class="profile-image">
                <img src="<?php 
                echo SITE.'public/images/profiles/';
                if(!empty($myEvalue->photo)) echo $myEvalue->photo;
                else echo 'profile.jpg'; ?>" class="img-profile" alt="profile">
            </div>
            
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                            <?= $myEvalue->firstname.' '.$myEvalue->lastname;?>
                        </h2>
                    </div>
                </div>
            </div><br/>
            <?php
            if($myEvaluation->etat == 1) echo '<span class="label label-warning ">En cours</span>';
            elseif($myEvaluation->etat == 2)echo '<span class="label label-valid ">Finale</span>';
            else echo '<span class="label label-white ">En Attente</span>';


            echo'<span class="pull-right">'.$progress.'% Completer</span>';
            ?>
            <br/><br/>



            <?php 
                echo'

                    <div class="progress progress-striped active">            
                        <div style="width: '.$progress.'%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-';
                                if($progress<50) echo "danger";
                                    else if($progress>50 && $progress<80) echo "warning";
                                else echo'valid valid';
                            echo '">

                        </div> 
                        <div style="width: '.(100 - $progress).'%" class="progress-bar progress-bar-default">
                                    <span class="sr-only">40% Complete (danger)</span>
                                </div>


                    </div>
                   
                ';
            ?> 
           
        </div>
    </div>

    <!-- Formulaire d'evaluation -->
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title"><h2>Critères d'évaluation</h2></div>
                <div class="ibox-content">

                    <div class="panel-group payments-method" id="accordion">
                        <form action="<?= SITE;?>members/evaluations/saved/?idu=<?=$myEvaluation->id;?>" method="POST">
                            <input type="hidden" value="<?=$myEvaluation->id;?>" name="idevaluation">
                            <input type="hidden" value="<?=count($datas['criteres']);?>" name="nbcritere">
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
                                                         <button data-id="tooltip'. $data->id.'" type="button" class="btn btn-default pull-right mgL20 toolTipJs" title="Veuillez choisir une note et fournir un commentaire." > <i class="fa fa-info-circle text-danger"></i></button><br/> <span class="infored delete-data" id="tooltip'. $data->id.'">Veuillez choisir une note et fournir un commentaire.</span>';
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
                                                            <label class="col-sm-3 control-label">Critère</label>
                                                            <div class="col-sm-9">
                                                               <input type="hidden" name="critere'.$data->id.'" value="'.$data->id.'">
                                                               <input class="col-sm-12" type="text" value="'.$data->title.'" disabled /><br/>
                                                               <span class="small">'.$data->description.'</span>
                                                           </div>
                                                       </div>
                                                       <div class="clear20"></div>
                                                       <div class="form-group">
                                                        <label class="col-sm-3 control-label">Note</label>
                                                        <div class="col-sm-9">
                                                            <select  class="noteCritere form-control"  id="noteCritere'.$data->id.'" name="noteCritere'.$data->id.'" data-id="'.$data->id.'">
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
                                                    <textarea name="commentaire'.$data->id.'" class="form-control sm-textarea">';

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
                    <a class="btn btn-danger floatR" href="<?php echo SITE;?>members/evaluations/">Fermer</a>
                    <button name="saveEvaluation" type="submit" class="btn btn-info floatR mgR20">Sauvegarder</button>

                </form>
            </div>

        </div>

    </div>
</div>
</div>
</div>