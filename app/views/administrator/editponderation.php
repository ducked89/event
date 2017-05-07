 <?php  
    $mPonderation = (object)($datas['mdatas']);
    $mCritere =$datas['criteres'];
?>

 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2>Ponderations</h2>
        <small>Liste des ponderations d'évènements des organisateurs</small>
        <a href="<?php echo SITE;?>admin/ponderations/" class="btn btn-primary btn-sm floatR">Liste ponderations</a>
        
    </div>
</div>

<div class="row row-bg">
    <div class="clear20"></div>
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
        	    <div class="clear20"></div>
                    <h3>Modifier un profil de ponderation</h3>
                    <span>Cet objet va vous permettre de definir un pourcentage de la note de chaque criteres affectes.</span>
                </div>
                <div class="ibox-content col-lg-12">
                    <div class=" col-lg-6">
                        <?php

                            if(isset($datas['error']['error']))
                            echo "<div class='alert alert-danger'>Impossible d'effectuer cette operation. Veuillez verifier vos saisies.</div>
                                <div class='clear50'></div>";                           

                        ?>
                        <form class="form-horizontal" action="<?php echo SITE;?>admin/ponderations/edit/?idu=<?= $mPonderation->id;?>" method="POST"  >
                                <div class="clear50"></div>
                                <input type="hidden" name="idu" value="<?= $mPonderation->id;?>">

                                <div class="form-group"><label class="col-lg-2 control-label">Titre</label>
                                    <div class="col-lg-10"><input value="<?= $mPonderation->title;?>" name="title" placeholder="Titre du profil de ponderation" required class="form-control" type="text"> </div>
                                </div>
                                

                                <div class="form-group"><label class="col-lg-2 control-label">Description</label>
                                    <div class="col-lg-10"><textarea  name="description" class="form-control sm-textarea"><?= $mPonderation->description;?></textarea></div>
                                </div>

                				<div class="clear20"></div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button name="savePonderation" class="btn btn-w-m btn-success mgR20" type="submit">Modifier</button>

                                         <a href="<?= SITE;?>admin/ponderations/"><button type="button" class="btn btn-w-m btn-danger floatR">Annuler</button></a>
                                    </div>
                                </div>
                        </form>
                        <div class="clear50"></div>
                    </div>

                    <div class=" col-lg-5">
                        <div class="clear50"></div>
                        <h3>Liste des criteres affectes</h3>

                        <?php
                            if(count($mCritere)>0){
                                foreach ($mCritere as $mCrit) {
                                    echo '<ol class="dd-list" >
                                            <li class="dd-item" data-id="2">
                                                    <div class="dd-handle">
                                                        <span class="pull-right"> '.$mCrit->percent.' %</span>
                                                        <span class="label label-info mgR10"><i class="fa fa-angle-double-right "></i></span> '.$mCrit->title.'
                                                    </div>
                                                </li>
                                            </ol>
                                    ';
                                }
                            }
                            else echo'<div class="alert alert-warning">Aucun criteres affectes.</span>';
                        ?>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>

