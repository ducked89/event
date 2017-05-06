<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Evaluations</h2>
        <small>Liste des  d'évènements des organisateurs</small>
        <h3><?=count($datas['evalues']);?> evalué(s)</h3>
        <a href="<?php echo SITE;?>admin/mentions/" class="btn btn-warning btn-sm floatR ">Mentions des notes</a>

        <a href="<?= SITE;?>admin/evaluations/desactivate/">
        <button class="btn btn-sm btn-danger floatR mgR20" type="button"><i class="fa fa-ban"></i> 
        <span class="bold">Desactiver tous</span></button></a>

        <a href="<?= SITE;?>admin/evaluations/activate/">
        <button type="button" class="btn btn-sm btn-info floatR mgR20"><i class="fa fa-check"></i> 
        <span class="bold">Activer tous</span></button></a>

        <a href="<?= SITE;?>admin/evaluations/">
        <button type="button" class="btn btn-sm btn-valid floatR mgR20"><i class="fa fa-list-ul "></i> 
        <span class="bold">Mode liste</span></button></a> 

        <a href="<?= SITE;?>admin/evaluations/add/">
        <button type="button" class="btn btn-sm btn-success floatR mgR20"><i class="fa fa-plus "></i> 
        <span class="bold">Creer</span></button></a>      


        <form action="<?=SITE;?>admin/evaluations/grid/">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-2 control-label mgR10">Periode (mois/annee)</label>
                    <div class="col-sm-8">
                        <div class="col-sm-5"><select class="select2_demo_1  form-control m-b col-lg-2" name="mois">
                            <option value="1" <?=(isset($datas['mois']) && $datas['mois']==1)?'selected="selected"':'';?>  >Janvier</option>
                                    <option value="2" <?=(isset($datas['mois']) && $datas['mois']==2)?'selected="selected"':'';?> >Fevrier</option>
                                    <option value="3" <?=(isset($datas['mois']) && $datas['mois']==3)?'selected="selected"':'';?> >Mars</option>
                                    <option value="4" <?=(isset($datas['mois']) && $datas['mois']==4)?'selected="selected"':'';?> >Avril</option>
                                    <option value="5" <?=(isset($datas['mois']) && $datas['mois']==5)?'selected="selected"':'';?> >Mai</option>
                                    <option value="6" <?=(isset($datas['mois']) && $datas['mois']==6)?'selected="selected"':'';?> >Juin</option>
                                    <option value="7" <?=(isset($datas['mois']) && $datas['mois']==7)?'selected="selected"':'';?> >Juillet</option>
                                    <option value="8" <?=(isset($datas['mois']) && $datas['mois']==8)?'selected="selected"':'';?> >Aout</option>
                                    <option value="9" <?=(isset($datas['mois']) && $datas['mois']==9)?'selected="selected"':'';?> >Septembre</option>
                                    <option value="10" <?=(isset($datas['mois']) && $datas['mois']==10)?'selected="selected"':'';?> >Octobre</option>
                                    <option value="11" <?=(isset($datas['mois']) && $datas['mois']==11)?'selected="selected"':'';?> >Novembre</option>
                                    <option value="12" <?=(isset($datas['mois']) && $datas['mois']==12)?'selected="selected"':'';?> >Decembre</option>
                                </select></div>
                                
                                <div class="col-sm-5"><select class="select2_demo_1  form-control m-b col-lg-6 pull-right" name="annee">
                                    <?php
                                    for($i=2017; $i<=2030; $i++)
                                    {
                                        echo'<option value="'.$i.'"';
                                        if(isset($datas['annee']) && $datas['annee']==$i)
                                            echo 'selected="selected"';
                                        echo'>'.$i.'</option>';
                                    }

                                    ?>
                         </select></div>
                        <div class="clear20"></div>
                        <div class="col-sm-5"><button type="submit" class="btn btn-valid" >Valider</button></div>
                    </div>
            </div>      
            </div>      
        </form>  
    </div>
</div>

<div class="clear20"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <?php if(isset($_GET['nf']) && $_GET['nf']=="yes")
        echo '<div class="clear20"></div><div class="alert alert warning">Aucun évènement trouvé pour cette periode.</a><div class="clear20"></div>';?>
        
       <?php echo '<div class="col-lg-12">';
            
                    $total = 0; $br = 0; $nbeval = 0;
                    foreach ($datas['evalues']  as $myEvalues) {
                        $mesPeriodes = $myEvalues;
                        $mEmploye = $myEvalues[0]->userEvaluations[0]->evalue;

                         
                         if($br%3==0) echo '<div class="clear20"></div>';
                         echo'
                            <div class="col-lg-4">
                                <div class="ibox-title">
                                    <h3><a href="'.SITE.'admin/employes/view/?idu='.$mEmploye->empid.'">'.$mEmploye->firstname.' '.$mEmploye->lastname.'</a></h3>
                                    <span>'.$mEmploye->position.'</span>
                                </div>
                                
                                <div class="ibox-content">
                                    <h5>Liste des evaluations par année:</h5>';

                                    foreach ($mesPeriodes  as $myAnnee) {
                                        echo '
                                        <div class="faq-item nopadding">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-center padding10 btn-white" >
                                                        <a href="'.SITE.'admin/evaluations/overview/?idu='.$mEmploye->id.'&annee='.$myAnnee->annee.'" class="btn btn-info btn-xs pull-right"><i class="fa fa-bar-chart-o mgR10"></i>Stats</a>
                                                        <a data-toggle="collapse" href="#faq'.$mEmploye->id.$myAnnee->annee.'" class="faq-question ">'.$myAnnee->annee.'</a>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-12">';

                                                    echo'
                                                    <div id="faq'.$mEmploye->id.$myAnnee->annee.'" class="panel-collapse collapse ">';
                                                
                                                    $myEvaluations = $myAnnee->userEvaluations;
                                                    foreach ($myEvaluations as $mEmpEvluation) 
                                                    {
                                                        echo'
                                                        <div class="faq-answer">
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
                                                            <div class="clear"></div>
                                                        </div>
                                                        </div>';
                                                    }

                                                    echo '</div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                
                                    echo '
                                </div>
                            </div>';
                        $br++;
                    }

            ?>

        <div class="clear50"></div>
        </div>
    </div>
</div>