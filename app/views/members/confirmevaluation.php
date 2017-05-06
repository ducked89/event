 <?php     
 $myEvaluation = (object)($datas['evaluations'][0]);
 $myEvalue = (object)($myEvaluation->evalue);
 $myEvaluateur = (object)($myEvaluation->evaluateur);
// $myEvaluation = $datas['evalue'];


 ?>

<!-- Header -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Evaluations</h2>
        <small>Valider mes évaluations</small>  

         <a class="btn btn-success pull-right" href="<?php echo SITE;?>members/evaluations">Mes évaluations</a>              
    </div>
</div>


<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-md-10">
        <div class="col-lg-offset-1 col-lg-12">
            <div class="ibox float-e-margins">
                <div class="clear20"></div>

                <div class="ibox-title">
                    <h3>Validation de l'évaluation</h3>
                </div>

                <div class="ibox-content">
                    <span class="alert alert-warning">
                        <i class="fa fa-info-circle mgR20"></i>
                        Après la soumission de l'évaluation, vous ne pourrez plus éffectuer aucune modifications.
                    </span> 
                    <div class="clear20"></div>

                      <!-- Profil header -->
                        <div class="row m-b-lg m-t-lg">
                            <div class="col-md-8">

                                <div class="profile-image">
                                    <img src="<?php echo SITE.'public/images/profiles/';
                                    if(!empty($myEvalue->photo)) echo $myEvalue->photo;
                                    else echo 'profile.jpg'; ?>" class="img-profile" alt="profile">
                                </div>
                                
                                <div class="profile-info">
                                    <div class="">
                                        <div>

                                            <h2 class="no-margins">
                                                <?= $myEvalue->firstname.' '.$myEvalue->lastname;?>
                                            </h2>
                                            <?php
                                                if($myEvaluation->etat == 1) echo '<span class="label label-warning  pull-right">En cours</span>';
                                                elseif($myEvaluation->etat == 2)echo '<span class="label label-valid  pull-right">Finale</span>';
                                                else echo '<span class="label label-white pull-right ">En Attente</span>';
                                                ?>
                                        </div>
                                    </div>
                                </div><br/>
                                Evaluateur : <?= $myEvaluateur->firstname.' '.$myEvaluateur->lastname;?><br/>
                                Date d'écheance : <?= date_format(date_create($myEvaluation->targetdate), "d M Y");?> 
                            </div>
                        </div>










                    <form class="form-horizontal" action="<?php echo SITE;?>members/evaluations/confirm/" method="POST"  >
                        <input type="hidden" id="idu" name="idu" value="<?=$myEvaluation->id;?>">                       
						
    						<div class="alert alert-danger">Etes-vous sûr de bien vouloir éffectuer cette opération ?</div>
		                <div class="clear20"></div>
                        <div class="form-group">
                           <button id="confirmEvaluation" name="confirmEvaluation" class="btn btn-primary floatL mgR20">Confirmer</button>
                           <a href="<?php echo SITE;?>members/evaluations/" class="btn btn-danger floatR">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
